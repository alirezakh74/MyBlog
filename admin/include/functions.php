<?php

require_once("consts.php");

function checkAdminUser($email, $pass)
{
    try
    {
        $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("use ".DATABASE_NAME);
        $pass = md5($pass);

        $query = "SELECT * FROM users WHERE email ='".$email. " ' AND password ='".$pass. " ' ";
        if($db->query($query))
        {
            $_SESSION['user_email'] = $email;
            header("Location:dashboard.php");
        }

        // $query = "SELECT * FROM users WHERE email = :email AND password = :pass";
        // $prepared = $db->prepare($query);
        // $data = array(
        //     ':email' => $email,
        //     ':pass' => $pass
        // );
        // $prepared->bindParam(':email', $email);
        // $prepared->bindParam(':pass', $pass);
        // if($prepared->execute())
        // {
        //     $row = $prepared->fetch(PDO::FETCH_ASSOC);
        //     if($row)
        //     {
        //         $_SESSION['user_email'] = $row['email'];
        //         header("Location:dashboard.php");
        //     }
        // }
        // else
        // {
        //     $prepared->errorInfo();
        // }
    }
    catch(PDOException $e) 
    {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}

function addAdminUser($fname, $lname, $email, $pass)
{
    $pass = md5($pass);
    $data = array(
        ':email' => $email,
        ':fname' => $fname,
        ':lname' => $lname,
        ':pass' => $pass
    );

    try{
        $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("use ".DATABASE_NAME);
        //INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `admin_status`, `photo`, `join_date`, `last_seen`) VALUES (NULL, 'alirezakhodabande74@gmail.com', 'ali', 'kh', '123', '1', NULL, current_timestamp(), current_timestamp());
        $query = "INSERT INTO users VALUES (NULL, :email, :fname, :lname, :pass, '1', NULL, NULL, NULL)";
    
        $prepared = $db->prepare($query);
        $result = $prepared->execute($data);

        if($result)
        {
            $_SESSION['user_email'] = $email;
            header("Location:dashboard.php");
        }
    }
    catch(PDOException $e) 
    {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}
?>