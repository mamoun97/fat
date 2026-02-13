<?php
$pageTitle = "التسجيل - ذوي الاحتياجات الخاصة";
include "../header.php";
include "../api/const.php";
?>

<section class="register-section">
    <div class="form-container">
        <h2>التسجيل</h2>
        <form action="../api/register" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="full_name">الاسم الكامل</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="gender">الجنس</label>
                <select id="gender" name="gender" required>
                    <option value="">اختر الجنس</option>
                    <option value="male">ذكر</option>
                    <option value="female">أنثى</option>
                </select>
            </div>
            <div class="form-group">
                <label for="disability_type">نوع الإعاقة</label>
                <select id="disability_type" name="disability_type" required>
                    <option value="">اختر نوع الإعاقة</option>
                    <?php
                    foreach ($handicap_type as $value => $label) {
                        printf(
                            '<option value=%d >%s</option>',
                            $value,
                            $label
                        );
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="disability_file">ملف الإعاقة</label>
                <input type="file" id="disability_file" name="disability_file" accept=".pdf,.jpg,.png" required>
            </div>
            <div class="form-group">
                <label for="birth_date">تاريخ الميلاد</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <button type="submit" class="btn btn-primary">تسجيل</button>
        </form>
        <p>لديك حساب بالفعل؟ <a href="../login">سجل الدخول</a></p>
    </div>
</section>

<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('../api/register.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data); // أو عرض في div
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>


<?php
include "../footer.php"
    ?>