<?php
require 'db_config.php';

// Data validation and login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    $errors = [];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email';
    if (empty($password)) $errors[] = 'Password is required';

    if (empty($errors)) {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && ($password==$user['password'])) {
            // Login successful, start session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            http_response_code(200);
            echo 'Login successful';
            header('Location: ../myaccount.php');
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