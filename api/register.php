<?php
require 'db_config.php';

// Data validation and registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $disability_type = $_POST['disability_type'];
    $birth_date = $_POST['birth_date'];

    // Validation
    $errors = [];
    if (empty($full_name)) $errors[] = 'Full name is required';
    if (empty($phone)) $errors[] = 'Phone is required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email';
    if (empty($password)) $errors[] = 'Password is required';
    if (empty($gender)) $errors[] = 'Gender is required';
    if (empty($disability_type)) $errors[] = 'Disability type is required';
    if (empty($birth_date)) $errors[] = 'Birth date is required';

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) $errors[] = 'الايميل موجود يرجى ادخال ايميل اخر';

    if (empty($errors)) {
        // Handle file upload
        $disability_file = '';
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
        } else {
            $errors[] = 'Disability file is required';
        }

        if (empty($errors)) {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO users (full_name, phone, email, password, gender, disability_type, disability_file, birth_date, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, NOW(), NOW())");
            if ($stmt->execute([$full_name, $phone, $email, $password, $gender, $disability_type, $disability_file, $birth_date])) {
                http_response_code(200);
                echo 'Registration successful';
            } else {
                http_response_code(400);
                echo 'Registration failed';
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
}
?>