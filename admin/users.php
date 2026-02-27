<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.html');
    exit;
}
require '../api/db_config.php';
include '../api/const.php';
include 'header-footer.php';
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
$stmt = $pdo->query("SELECT id, full_name, email, phone, gender, 
intellectual_disability,
hearing_impairment,
visual_impairment,
motor_disability, disability_file, birth_date,note, status FROM users where `type`='benefit'");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->query("SELECT count(*) as n FROM users where `type`='subvention' and status in (0, 3)" );
$count = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<?php showHeader(page: "users"); ?>
<section class="container-fuild">
    <div class="mt-4 p-5 bg-white  rounded">
        <h1>طلبات الاستفادة</h1>
    </div>
    <div class="table-responsive">
        <table class="table">
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
                    <th>اسباب الطعن</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($user['id']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user['full_name']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user['email']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user['phone']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($user['gender'] == "male" ? "ذكر" : "انثى"); ?>
                        </td>
                        <td>


                            <?php

                            foreach ($handicap_type as $value => $label) {
                                if ($user[$value] == 1)
                                    echo '
                                        <div class="badge bg-primary">
                                        ' . $label . '
                                        </div>';
                            }
                            ?>

                        </td>
                        <td><a href="uploads/<?php echo htmlspecialchars($user['disability_file']); ?>" target="_blank">عرض
                                الملف</a></td>
                        <td>
                            <span style="font-size: 13px;white-space: nowrap;">
                                <?php echo htmlspecialchars($user['birth_date']); ?>
                            </span>
                        </td>

                        <td>
                            <form method="post" class="status-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <?php
                                    foreach ($statusOptions as $value => $label) {
                                        printf(
                                            '<option value=%d %s>%s</option>',
                                            $value,
                                            ($user['status'] == $value ? 'selected' : ''),
                                            $label
                                        );
                                    }
                                    ?>
                                </select>
                            </form>
                        </td>
                        <td>
                            <?php echo $user['note'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>
<?php showFooter(); ?>