<?php
$pageTitle = "التسجيل - ذوي الاحتياجات الخاصة";
include "../header.php";
include "../api/const.php";
?>

<section class="register-section">
    <div class="card" style="max-width: 820px;">
        <div class="card-body p-6">

            <h2>التسجيل</h2>
            <form action="../api/register" class="row" method="post" enctype="multipart/form-data">
                <div class="form-group col-sm-6">
                    <label for="full_name">الاسم الكامل</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="gender">الجنس</label>
                    <select id="gender" name="gender" required>
                        <option value="">اختر الجنس</option>
                        <option value="male">ذكر</option>
                        <option value="female">أنثى</option>
                    </select>
                </div>
                <div>
                    <div class="mt-3"></div>
                    <div class="form-check">
                        <input type="radio" onchange="type_change('benefit')" class="form-check-input" id="radio1"
                            name="type" value="benefit" checked>طلب
                        استفادة من المنحة
                        <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" onchange="type_change('subvention')" class="form-check-input" id="radio2"
                            name="type" value="subvention">طلب اعانة
                        <label class="form-check-label" for="radio2"></label>
                    </div>
                    <div class="mt-3"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">نوع الإعاقة</label>
                    </div>
                    <div class="list-group">
                        <?php
                        foreach ($handicap_type as $value => $label) {
                            echo '
                        <label class="list-group-item d-flex gap-2">
                        
                            <input class="form-check-input flex-shrink-0"
                                type="checkbox"
                                onchange="disa_change(this)"
                                name="disabilities[]"
                                value="' . $value . '">
                                
                            ' . $label . '
                        </label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-sm-6" id="services" style="display: none;">
                    <div class="form-group">
                        <label for="">الخددمة المطلوبة</label>
                    </div>

                    <div class="list-group">


                        <?php
                        foreach ($handicap_helps as $item => $labels) {
                            foreach ($labels as $value => $label) {

                                echo '
                            <label class="list-group-item d-flex gap-2">
                            
                                <input class="form-check-input flex-shrink-0"
                                    type="checkbox"
                                    name="handicap_helps[]"
                                    value="' . $value . '">
                                    
                                ' . $label . '
                              </label>';
                            }
                        }
                        ?>
                    </div>
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
    function disa_change(event) {
        console.log(event.value)
    }
    function type_change(type) {
        if (type == "subvention")
            document.getElementById("services").style.display = "block"
        else
            document.getElementById("services").style.display = "none"
    }
</script>


<?php
include "../footer.php"
    ?>