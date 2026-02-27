<?php

function showHeader($page)
{
    echo '
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين - الإدمن</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">


    <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            font-family: "Cairo";
        }
    </style>
    <link rel="stylesheet" href="../styles/css.css">
    <link rel="stylesheet" href="../styles/global.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .status-form {
            display: inline;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>لوحة الأدمن</h1>
        </div>
        <nav>
            <ul>

                <li><a href="users.php" class="' . ($page == "users" ? "active" : "") . '">طلبات الاستفادة من المنحة</a></li>
                <li><a href="services.php" class="' . ($page == "services" ? "active" : "") . '">طلبات خدمة</a></li>
                <li><a href="logout.php">تسجيل الخروج</a></li>
            
            </ul>
        </nav>
    </header>
    <main>
';
}

function showFooter()
{
    echo '</main>
    <footer>
        <p>&copy; 2026 موقع ذوي الاحتياجات الخاصة. جميع الحقوق محفوظة.</p>
    </footer>
</body>

</html>';
}
?>

<!-- <li>
  
    <div class="dropdown">
    
       <div class="dropdown">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
  <img src="../styles/bell.png"  style="width:24px;height:24px;cursor:pointer"> '.($count!=0?"<span class='badge bg-danger'>".$count."</span>":"").'
</button>
        
   
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Link 1</a></li>
        <li><a class="dropdown-item" href="#">Link 2</a></li>
        <li><a class="dropdown-item" href="#">Link 3</a></li>
    </ul>
</div>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Link 1</a></li>
        <li><a class="dropdown-item" href="#">Link 2</a></li>
        <li><a class="dropdown-item" href="#">Link 3</a></li>
    </ul>
</div>

</li> -->