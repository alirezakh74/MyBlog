<?php
session_start();
require_once("include/functions.php");

// get post values for sing_in and check user
if(isset($_POST['login_submit']) and isset($_POST['login_email']) and isset($_POST['login_password']))
{
    checkAdminUser($_POST['login_email'], $_POST['login_password']);
}

if (isset($_SESSION["user_email"]))
{
    header("Location:dashboard.php?m=index&p=index");
    exit;
}

if(isset($_POST['register_submit']) and isset($_POST['fname']) and isset($_POST['lname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['r_password']) )
{
    if($_POST['password'] == $_POST['r_password'])
    {
        addAdminUser($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);
        addAdminPhoto();
        header("Location:dashboard.php");
        exit;
    }
    else
    {
        echo("تکرار رمز عبور مطابقت ندارد");
    }
}

?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ورود | ثیت نام</title>
</head>

<body class="form-body">
    <div class="login_register_wrapper">
        <div class="sign_in">
            <form action="" method="post" enctype="application/x-www-form-urlencoded">
                <input type="text" name="login_email" id="login_email" placeholder="ایمیل" required>
                <input type="password" name="login_password" id="login_password" placeholder="رمز عبور" required>
                <input type="submit" name="login_submit" value="ورود">
            </form>
        </div>
        <div class="sign_up">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="fname" id="fname" placeholder="نام" required>
                <input type="text" name="lname" id="lname" placeholder="نام حانوادگی" required>
                <input type="text" name="email" id="email" placeholder="ایمیل" required>
                <input type="password" name="password" id="password" placeholder="رمز عبور" required>
                <input type="password" name="r_password" id="r_password" placeholder="تکرار رمز عبور" required>
                <input type="file" name="admin_photo" id="photo">
                <input type="submit" name="register_submit" value="ثبت نام">
            </form>
        </div>
    </div>
</body>

</html>