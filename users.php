<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin.html');
    exit;
}
require 'api/db_config.php';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['status'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->execute([$status, $user_id]);
    header('Location: users.php');
    exit;
}

// Fetch all users
$stmt = $pdo->query("SELECT id, full_name, email, phone, gender, disability_type, disability_file, birth_date, status FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين - الإدمن</title>
    <link rel="stylesheet" href="styles/css.css">
    <link rel="stylesheet" href="styles/global.css">
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .status-form { display: inline; }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>لوحة الأدمن</h1>
        </div>
        <nav>
            <ul>
                <li><a href="users.php">المستخدمون</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>قائمة المستخدمين</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>الاسم الكامل</th>
                        <th>البريد الإلكتروني</th>
                        <th>الهاتف</th>
                        <th>الجنس</th>
                        <th>نوع الإعاقة</th>
                        <th>ملف الإعاقة</th>
                        <th>تاريخ الميلاد</th>
                        <th>الحالة</th>
                        <th>تحديث الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td><?php echo htmlspecialchars($user['gender']=="male"?"ذكر":"انثى"); ?></td>
                            <td><?php echo htmlspecialchars($user['disability_type']); ?></td>
                            <td><a href="uploads/<?php echo htmlspecialchars($user['disability_file']); ?>" target="_blank">عرض الملف</a></td>
                            <td><?php echo htmlspecialchars($user['birth_date']); ?></td>
                            <td><?php echo $user['status'] == 1 ? 'محقق' : 'غير محقق'; ?></td>
                            <td>
                                <form method="post" class="status-form">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="status">
                                        <option value="0" <?php if ($user['status'] == 0) echo 'selected'; ?>>غير محقق</option>
                                        <option value="1" <?php if ($user['status'] == 1) echo 'selected'; ?>>محقق</option>
                                    </select>
                                    <button type="submit">تحديث</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 موقع ذوي الاحتياجات الخاصة. جميع الحقوق محفوظة.</p>
    </footer>
</body>
</html>
