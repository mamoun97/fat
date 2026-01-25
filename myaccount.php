<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
require 'api/db_config.php';

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo 'User not found';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حسابي - ذوي الاحتياجات الخاصة</title>
    <link rel="stylesheet" href="styles/css.css">
    <link rel="stylesheet" href="styles/global.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>ذوي الاحتياجات الخاصة</h1>
        </div>
        <nav>
            <ul>
                <li><a href="myaccount.php">حسابي</a></li>
                <li><a href="logout-user.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="account-section" >
            <div class="form-container" style="margin:24px  auto;">
                <h2>معلوماتي الشخصية</h2>
                <p><strong>حالة التحقق:</strong> <?php echo $user['status'] == 1 ? 'محقق' : 'غير محقق'; ?></p>
                <form action="api/update-profile.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label for="full_name">الاسم الكامل</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس</label>
                        <select id="gender" name="gender" required>
                            <option value="male" <?php if ($user['gender'] == 'male') echo 'selected'; ?>>ذكر</option>
                            <option value="female" <?php if ($user['gender'] == 'female') echo 'selected'; ?>>أنثى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="disability_type">نوع الإعاقة</label>
                        <select id="disability_type" name="disability_type" required>
                            <option value="physical" <?php if ($user['disability_type'] == 'physical') echo 'selected'; ?>>إعاقة جسدية</option>
                            <option value="mental" <?php if ($user['disability_type'] == 'mental') echo 'selected'; ?>>إعاقة ذهنية</option>
                            <option value="sensory" <?php if ($user['disability_type'] == 'sensory') echo 'selected'; ?>>إعاقة حسية</option>
                            <option value="learning" <?php if ($user['disability_type'] == 'learning') echo 'selected'; ?>>إعاقة تعلم</option>
                            <option value="other" <?php if ($user['disability_type'] == 'other') echo 'selected'; ?>>أخرى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="disability_file">ملف الإعاقة (اتركه فارغاً إذا لم تريد تغييره)</label>
                        <input type="file" id="disability_file" name="disability_file" accept=".pdf,.jpg,.png">
                        <?php if ($user['disability_file']): ?>
                            <p>الملف الحالي: <a href="uploads/<?php echo htmlspecialchars($user['disability_file']); ?>" target="_blank">عرض</a></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">تاريخ الميلاد</label>
                        <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($user['birth_date']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">تحديث المعلومات</button>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 موقع ذوي الاحتياجات الخاصة. جميع الحقوق محفوظة.</p>
    </footer>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('api/update-profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                if (response.status === 200) {
                    location.reload(); // Reload to show updated data
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
