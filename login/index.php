<?php
$pageTitle = "تسجيل الدخول - ذوي الاحتياجات الخاصة";
include "../header.php"
    ?>
<?php
require '../api/db_config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    $error = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error = 'Invalid email';
    if (empty($password))
        $error = 'Password is required';

    if (empty($error)) {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && ($password == $user['password'])) {
            // Login successful, start session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            http_response_code(200);
            echo 'Login successful';
            header('Location: ../myaccount.php');
            exit;
        } else {
            $error = 'البريد إلكتروني أو كلمة مرور غير صحيحة';
        }
    }
}
?>


<section class="login-section">
    <div class="form-container">
        <h2>تسجيل الدخول</h2>
        <form action="./" method="post">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php
            if (!empty($error))
                echo '<div style="color:red">' . $error . '</div>';
            ?>
            <button type="submit" class="btn btn-primary">دخول</button>
        </form>
        <p>ليس لديك حساب؟ <a href="../register">سجل الآن</a></p>
    </div>
</section>

<?php
include "../footer.php"
    ?>