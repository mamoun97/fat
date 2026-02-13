<?php
$base_url = "/fat/"; 
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : ""; ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles/css.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles/global.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>ذوي الاحتياجات الخاصة</h1>
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo $base_url; ?>">الرئيسية</a></li>
                <li><a href="#">عنا</a></li>
                <li><a href="#">الخدمات</a></li>
                <li><a href="#">اتصل بنا</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="<?php echo $base_url; ?>register" class="btn btn-secondary">تسجيل</a>
            <a href="<?php echo $base_url; ?>login" class="btn btn-primary">تسجيل الدخول</a>
        </div>
    </header>

    <main id="main-content">
       
    
