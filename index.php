<?php
$pageTitle = "الصفحة الرئيسية - ذوي الاحتياجات الخاصة";
include "header.php"
    ?>

<style>
    .bg-img {
        background-image: url("styles/cover.jpg");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;
        color: white;
    }

    .cover-img {
        position: absolute;
        inset: 0;
        background-color: #0049;
    }
</style>

<div class="directorate-header min-vh-100 bg-img absolute">
    <div class="cover-img"></div>
    <div
        class="definition vh-80 d-flex justify-content-center  flex-column align-items-center text-center position-relative">
        <h2 style="text-size:44px;font-weight: 900;">
            <span>
                مديرية ذوي
            </span>
            <span class="text-primary">
                الاحتياجات الخاصة
            </span>
        </h2>
        <p class="mt-4" style="max-width:540px;">مديرية ذوي الاحتياجات الخاصة هي الجهة المسؤولة عن تقديم الدعم والخدمات
            للأشخاص ذوي الاحتياجات
            الخاصة في المجتمع، لضمان حياة كريمة ومتكاملة لهم. تهدف إلى تعزيز الاندماج الاجتماعي وتوفير فرص
            متساوية.</p>
    </div>
</div>
<div class="container px-4">
    <section class="">



        <div class="role">
            <h3>دور المديرية</h3>
            <p>تعمل المديرية على تنسيق الجهود بين الجهات المختلفة لتقديم خدمات شاملة تشمل الرعاية الصحية، التعليمية،
                والاجتماعية. كما تساهم في تطوير السياسات والبرامج الداعمة للأشخاص ذوي الاحتياجات الخاصة.</p>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="services">
                <h3>الخدمات التي تقدمها</h3>
                <ul>
                    <li>برامج تأهيل وتدريب مهني</li>
                    <li>مساعدات مالية ومعدات طبية</li>
                    <li>دعم نفسي واجتماعي مستمر</li>
                    <li>تسهيل الوصول إلى التعليم والعمل</li>
                    <li>ورش عمل وأنشطة ترفيهية</li>
                    <li>استشارات قانونية واجتماعية</li>
                </ul>
            </div>
            <div class="conditions">
                <h3>شروط الاستفادة</h3>
                <ul>
                    <li>تقديم طلب رسمي مع الوثائق الطبية المعتمدة</li>
                    <li>الانطباق على معايير الاحتياجات الخاصة المعترف بها</li>
                    <li>الالتزام بالبرامج والمتابعات المحددة</li>
                    <li>متابعة دورية للتقييم والتطوير</li>
                    <li>الالتزام بالقوانين والأنظمة المعمول بها</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="stats-section">
        <h2>إحصائيات وأرقام</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <h3>5000+</h3>
                <p>مستفيد من الخدمات</p>
            </div>
            <div class="stat-item">
                <h3>200+</h3>
                <p>برنامج تأهيلي</p>
            </div>
            <div class="stat-item">
                <h3>50+</h3>
                <p>شريك استراتيجي</p>
            </div>
            <div class="stat-item">
                <h3>95%</h3>
                <p>رضا المستفيدين</p>
            </div>
        </div>
    </section>
    <section class="testimonials-section">
        <h2>شهادات المستفيدين</h2>
        <div class="testimonials">
            <div class="testimonial">
                <p>"المديرية ساعدتني في الحصول على فرصة عمل مناسبة. شكراً لجهودهم."</p>
                <cite>- أحمد، مستفيد</cite>
            </div>
            <div class="testimonial">
                <p>"الدعم النفسي الذي تلقيته غير حياتي تماماً."</p>
                <cite>- فاطمة، مستفيدة</cite>
            </div>
            <div class="testimonial">
                <p>"برامج التأهيل ممتازة وفعالة."</p>
                <cite>- محمد، مستفيد</cite>
            </div>
        </div>
    </section>
    <section class="news-section">
        <h2>أخبار وتحديثات</h2>
        <div class="news-grid">
            <div class="news-item">
                <img src="styles/learn-image.jpeg" alt="خبر 1" width="300" height="200">
                <h4>إطلاق برنامج جديد للتعليم عن بعد</h4>
                <p>تفاصيل البرنامج الجديد...</p>
                <a href="#">اقرأ المزيد</a>
            </div>
            <div class="news-item">
                <img src="styles/school.jpeg" alt="خبر 2" width="300" height="200">
                <h4>فعالية توعوية في المدارس</h4>
                <p>حول أهمية الاندماج...</p>
                <a href="#">اقرأ المزيد</a>
            </div>
        </div>
    </section>
    <section class="faq-section">
        <h2>الأسئلة الشائعة</h2>
        <div class="faq">
            <details>
                <summary>كيف أتقدم بطلب للاستفادة؟</summary>
                <p>يمكنك تقديم الطلب عبر الموقع أو زيارة المكتب المحلي.</p>
            </details>
            <details>
                <summary>ما هي أنواع الاحتياجات الخاصة المغطاة؟</summary>
                <p>تشمل الإعاقات الجسدية، الذهنية، والحسية.</p>
            </details>
            <details>
                <summary>هل الخدمات مجانية؟</summary>
                <p>معظم الخدمات مجانية، لكن بعضها قد يتطلب رسوماً رمزية.</p>
            </details>
        </div>
    </section>
</div>
<?php
include "footer.php"
    ?>