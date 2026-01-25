<?php
session_start();
require 'db_config.php';

// Data validation and login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    $errors = [];
    if (empty($email)) $errors[] = 'Email is required';
    if (empty($password)) $errors[] = 'Password is required';

    if (empty($errors)) {
        // Check if admin exists
        $stmt = $pdo->prepare("SELECT id, password FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && ($password== $admin['password'])) {
            // Login successful
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $email;
            http_response_code(200);
            echo 'Login successful';
            header('Location: ../users.php');
            exit;
        } else {
            http_response_code(400);
            echo 'Invalid email or password';
        }
    } else {
        http_response_code(400);
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>