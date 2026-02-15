<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
require 'api/db_config.php';
require 'api/const.php';

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo 'User not found';
    exit;
}
$msg="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'];
    $status = $_POST['status'];
    $disability_type = $_POST['disability_type'];
    $birth_date = $_POST['birth_date'];
    $note = $_POST['note'];

    // Validation
    $errors = [];
    if (empty($full_name))
        $errors[] = 'Full name is required';
    if (empty($phone))
        $errors[] = 'Phone is required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = 'Invalid email';
    if (empty($gender))
        $errors[] = 'Gender is required';
    if (empty($disability_type))
        $errors[] = 'Disability type is required';
    if (empty($birth_date))
        $errors[] = 'Birth date is required';

    // Check if email already exists for another user
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $user_id]);
    if ($stmt->fetch())
        $errors[] = 'Email already exists';

    if (empty($errors)) {
        $disability_file = null;
        // Handle file upload if provided
        if (isset($_FILES['disability_file']) && $_FILES['disability_file']['error'] == 0) {
            $targetDir = 'uploads/';
            if (!is_dir($targetDir))
                mkdir($targetDir, 0755, true);
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
                $stmt = $pdo->prepare("UPDATE users SET full_name = ?,`status`=?, note= ?, phone = ?, email = ?, gender = ?, disability_type = ?, disability_file = ?, birth_date = ?, updated_at = NOW() WHERE id = ?");
                $result = $stmt->execute([$full_name,isset($note)?3:$status, $note, $phone, $email, $gender, $disability_type, $disability_file, $birth_date, $user_id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET full_name = ?,`status`=?, note= ?, phone = ?, email = ?, gender = ?, disability_type = ?, birth_date = ?, updated_at = NOW() WHERE id = ?");
                $result = $stmt->execute([$full_name,isset($note)?3:$status, $note, $phone, $email, $gender, $disability_type, $birth_date, $user_id]);
            }
            if ($result) {
                http_response_code(200);
                $msg= '<div style="padding:14px;text-align:center;background-color:green;color:white">تم ارسال التغييرات بنجاح</div>';
            } else {
                http_response_code(400);
                $msg= '<div style="padding:14px;text-align:center;background-color:green;color:white">حدث خطأ</div>';
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
    <?php echo $msg;?>
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
        
        <form action="myaccount.php" method="post" enctype="multipart/form-data">
            <section class="account-section grid grid-cols-2 gap-4" style="padding: 24px;">
                <div>
                    <div class="form-container" style="max-width:100%!important">
                        <p><strong>حالة التحقق :</strong>
                            <?php echo $statusOptions[$user['status']]; ?>
                        </p>
                        <div style="text-align: center;">
                            <img src="<?php echo $statusOptionsImages[$user['status']]; ?>"
                                style="width:64px;heiht:64px" alt="">
                        </div>
                    </div>
                    <?php if ($user['status'] == 2): ?>

                        <div class="form-container" style="max-width:100%!important;margin-top:24px">

                            <h2>نموذج الطعن لإعادة دراسة الملف</h2>

                            <div class="form-group">
                                <label for="note">أسباب الطعن:</label>
                                <textarea id="note" name="note" rows="6"
                                value="<?php echo htmlspecialchars($user['note']); ?>"
                                    style="width:100%; padding:8px; font-family:Arial; border:1px solid #ccc; border-radius:3px;"
                                    placeholder="الرجاء كتابة أسباب طعنك لإعادة دراسة الملف..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:10px;">إرسال
                                الطعن</button>

                        </div>
                    <?php endif; ?>


                </div>
                <input type="hidden" name="status" value="<?php echo $user['status']; ?>">
                <div class="form-container" style="max-width:100%!important">
                    <h2>معلوماتي الشخصية</h2>





                    <div>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="appeal_reason" id="appeal_reason" value="">
                        <div class="form-group">
                            <label for="full_name">الاسم الكامل</label>
                            <input type="text" id="full_name" name="full_name"
                                value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone"
                                value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">الجنس</label>
                            <select id="gender" name="gender" required>
                                <option value="male" <?php if ($user['gender'] == 'male')
                                    echo 'selected'; ?>>ذكر</option>
                                <option value="female" <?php if ($user['gender'] == 'female')
                                    echo 'selected'; ?>>أنثى
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="disability_type">نوع الإعاقة</label>
                            <select id="disability_type" name="disability_type" required>
                                <option value="physical" <?php if ($user['disability_type'] == 'physical')
                                    echo 'selected'; ?>>إعاقة جسدية</option>
                                <option value="mental" <?php if ($user['disability_type'] == 'mental')
                                    echo 'selected'; ?>>
                                    إعاقة ذهنية</option>
                                <option value="sensory" <?php if ($user['disability_type'] == 'sensory')
                                    echo 'selected'; ?>>
                                    إعاقة حسية</option>
                                <option value="learning" <?php if ($user['disability_type'] == 'learning')
                                    echo 'selected'; ?>>إعاقة تعلم</option>
                                <option value="other" <?php if ($user['disability_type'] == 'other')
                                    echo 'selected'; ?>>أخرى
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="disability_file">ملف الإعاقة (اتركه فارغاً إذا لم تريد تغييره)</label>
                            <input type="file" id="disability_file" name="disability_file" accept=".pdf,.jpg,.png">
                            <?php if ($user['disability_file']): ?>
                                <p>الملف الحالي: <a href="uploads/<?php echo htmlspecialchars($user['disability_file']); ?>"
                                        target="_blank">عرض</a></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">تاريخ الميلاد</label>
                            <input type="date" id="birth_date" name="birth_date"
                                value="<?php echo htmlspecialchars($user['birth_date']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">تحديث المعلومات</button>
                    </div>
                </div>
            </section>
        </form>
    </main>
    <footer>
        <p>&copy; 2026 موقع ذوي الاحتياجات الخاصة. جميع الحقوق محفوظة.</p>

    </footer>
    <script>


        // Handle main form submission
        form.addEventListener('submit', function (e) {
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