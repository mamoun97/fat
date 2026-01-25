<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo 'Unauthorized';
    exit;
}
require 'db_config.php';

$user_id = $_SESSION['user_id'];
$full_name = trim($_POST['full_name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$gender = $_POST['gender'];
$disability_type = $_POST['disability_type'];
$birth_date = $_POST['birth_date'];

// Validation
$errors = [];
if (empty($full_name)) $errors[] = 'Full name is required';
if (empty($phone)) $errors[] = 'Phone is required';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email';
if (empty($gender)) $errors[] = 'Gender is required';
if (empty($disability_type)) $errors[] = 'Disability type is required';
if (empty($birth_date)) $errors[] = 'Birth date is required';

// Check if email already exists for another user
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
$stmt->execute([$email, $user_id]);
if ($stmt->fetch()) $errors[] = 'Email already exists';

if (empty($errors)) {
    $disability_file = null;
    // Handle file upload if provided
    if (isset($_FILES['disability_file']) && $_FILES['disability_file']['error'] == 0) {
        $targetDir = '../uploads/';
        if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
        $fileName = basename($_FILES['disability_file']['name']);
        $targetFile = $targetDir . time() . '_' . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (in_array($fileType, ['pdf', 'jpg', 'png'])) {
            if (move_uploaded_file($_FILES['disability_file']['tmp_name'], $targetFile)) {
                $disability_file = basename($targetFile);
            } else {
                $errors[] = 'File upload failed';
            }
        } else {
            $errors[] = 'Invalid file type';
        }
    }

    if (empty($errors)) {
        // Update database
        if ($disability_file) {
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, phone = ?, email = ?, gender = ?, disability_type = ?, disability_file = ?, birth_date = ?, updated_at = NOW() WHERE id = ?");
            $result = $stmt->execute([$full_name, $phone, $email, $gender, $disability_type, $disability_file, $birth_date, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, phone = ?, email = ?, gender = ?, disability_type = ?, birth_date = ?, updated_at = NOW() WHERE id = ?");
            $result = $stmt->execute([$full_name, $phone, $email, $gender, $disability_type, $birth_date, $user_id]);
        }
        if ($result) {
            http_response_code(200);
            echo 'Profile updated successfully';
        } else {
            http_response_code(400);
            echo 'Update failed';
        }
    } else {
        http_response_code(400);
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
} else {
    http_response_code(400);
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}
?>