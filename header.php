<?php
$base_url = "/fat/";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo isset($pageTitle) ? $pageTitle : ""; ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles/css.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>styles/global.css">
<style>
    *{font-family: "Cairo";}
</style>
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
        <div >
            <a href="<?php echo $base_url; ?>register"  class="btn btn-secondary  rounded-5 px-4">
                <!-- <button class="btn btn-secondary  rounded-5 px-4"> -->
                    تسجيل
                <!-- </button> -->
            </a>
            <a href="<?php echo $base_url; ?>login" class="btn btn-primary  rounded-5 px-4">
                <!-- <button class="btn btn-primary rounded-5 px-4"> -->
                    تسجيل الدخول
                <!-- </button> -->
            </a>
        </div>
    </header>

    <main id="main-content">