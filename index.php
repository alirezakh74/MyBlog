<?php
require_once("include/header.php");
require_once("include/posts.php");
require_once("include/footer.php");
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>وبلاگ من</title>
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="menu-icon">
                <button><span class="material-symbols-outlined">menu</span></button>
                <div class="mobile-menu"></div>
            </div>
            <div class="logo">
                وبلاگ برنامه نویس
            </div>
            <div class="nav-items">
                <a href="#">صفحه اصلی</a>
                <a href="#">درباره ما</a>
                <a href="#">تماس با ما</a>
            </div>
            <div class="search-icon">
                <button class="search-close-btn"><span class="material-symbols-outlined">search</span></button>
                <div class="mobile-search"></div>
            </div>
            <div class="search-container">
                <form action="search.php" class="search-form">
                    <input type="search" name="search" id="search" placeholder="جستجو ..." required>
                    <button type="search"><span class="material-symbols-outlined">search</span></button>
                </form>
            </div>
        </nav>
        <main>
            <article>پست 1</article>
            <article>پست 2</article>
        </main>
        <footer>
            <p><address>آدرس: شیراز فرگاز</address></p>
            <p>&nbsp;تمام حقوق محفوظ است &copy; 1402</p>
        </footer>
    </div>
    <script src="js/app.js"></script>
</body>

</html>