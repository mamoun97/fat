<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الإدمن - ذوي الاحتياجات الخاصة</title>
    <link rel="stylesheet" href="../styles/css.css">
    <link rel="stylesheet" href="../styles/global.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    *{font-family: "Cairo";}
</style>
</head>

<?php
session_start();
require '../api/db_config.php';
$error = '';
// Data validation and login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email)) $error= 'Email is required';
    if (empty($password)) $error = 'Password is required';

    if (empty($error)) {
        // Check if admin exists
        $stmt = $pdo->prepare("SELECT id, password FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && ($password== $admin['password'])) {
            // Login successful
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $email;
            http_response_code(200);
            header('Location: users.php');
            exit;
        } else {
             $error = 'البريد إلكتروني أو كلمة مرور غير صحيحة';
        }
    } 
}
?>

<body>
   
    <main >
        <section class="login-section">
            <div class="form-container" style="margin-top:34px;max-width: 420px;">
                <h2>تسجيل دخول الإدمن</h2>
                <form action="./" method="post" >
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <?php
                    if(!empty($error))
                        echo '<div style="color:red">'.$error.'</div>';
                    ?>
                    <button type="submit" class="btn btn-primary">دخول</button>
                </form>
            </div>
        </section>
    </main>


</body>
</html>