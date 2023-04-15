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

        // $query = "SELECT * FROM users WHERE email ='".$email. " ' AND password ='".$pass. " ' ";
        // if($result = $db->query($query)->fetch())
        // {
        //     $_SESSION['user_email'] = $result['email'];
        //     $_SESSION['user_first_name'] = $result['first_name'];
        //     $_SESSION['user_last_name'] = $result['last_name'];
        //     header("Location:dashboard.php");
        // }

        $query = "SELECT * FROM users WHERE email = :email AND password = :pass";
        $prepared = $db->prepare($query);
        $data = array(
            ':email' => $email,
            ':pass' => $pass
        );
        //$prepared->bindParam(':email', $email);
        //$prepared->bindParam(':pass', $pass);
        if($prepared->execute($data))
        {
            $row = $prepared->fetch(PDO::FETCH_ASSOC);
            if($row)
            {
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_first_name'] = $row['first_name'];
                $_SESSION['user_last_name'] = $row['last_name'];
                header("Location:dashboard.php");
                exit;
            }
        }
        else
        {
            $prepared->errorInfo();
        }
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
        $data = array(
            ':email' => $email,
            ':fname' => $fname,
            ':lname' => $lname,
            ':pass' => $pass
        );
        // first ceck is not user registered already
        $query_check = "SELECT * FROM users WHERE email = :email";
        $prepared_check = $db->prepare($query_check);
        $prepared_check->execute([":email" => $email]);
        if( !$prepared_check->fetch(PDO::FETCH_ASSOC) )
        {
            $prepared = $db->prepare($query);
            $result = $prepared->execute($data);
            if($result)
            {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_first_name'] = $fname;
                $_SESSION['user_last_name'] = $lname;
                //echo("ثبت نام شدید");
                header("Location:dashboard.php");
                exit;
            }
        }
        else
        {
            echo("شما قبلا ثبت نام کرده اید");
        }
    }
    catch(PDOException $e) 
    {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}

function addPost($post_title, $post_body/*, $post_image*/)
{
    try
    {
        $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("use ".DATABASE_NAME);

        $email = $_SESSION['user_email'];
        $query = "SELECT id FROM users WHERE email = :email";
        $prepared = $db->prepare($query);
        $prepared->execute([":email" => $email]);
        $user = $prepared->fetch(PDO::FETCH_ASSOC);
        $user_id = $user['id'];

        $query = "INSERT INTO posts (title, body, user_id, category_id) VALUES (:post_title, :post_body, $user_id, 1)";
        $prepared = $db->prepare($query);
        $result = $prepared->execute([
            ":post_title" => $post_title,
            ":post_body" => $post_body
        ]);

        if ($result) {
            $query = "SELECT id FROM posts WHERE title = :post_title AND body = :post_body";
            $prepared = $db->prepare($query);
            $result = $prepared->execute([
                ":post_title" => $post_title,
                ":post_body" => $post_body
            ]);
            if($result and ($row = $prepared->fetch(PDO::FETCH_ASSOC)) and (isset($_FILES['post_image'])))
            {
                uploadPostImage($row['id']/*, $post_image*/);
            }
        }
    }
    catch(PDOException $e) 
    {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}

function uploadPostImage($id/*, $post_image*/)
{
    $array = explode(".", $_FILES['post_image']['name']);
    $extension = end($array);
    if (!move_uploaded_file($_FILES['post_image']['tmp_name'], "upload/photos/posts/" . $id . "." . $extension)) {
        // move photo have a problem
    } else {

        try {
            $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->query("use " . DATABASE_NAME);

            $query = "UPDATE posts SET photo = :photo_name  WHERE id = :id";
            $prepared = $db->prepare($query);
            $photoName = $id . "." . $extension;
            $prepared->execute([":photo_name" => $photoName ,":id" => $id]);
        } catch (PDOException $e) {
            die("DB ERROR: " . $query . "<br>" . $e->getMessage());
        }
    }
}
?>