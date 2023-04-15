<?php

require_once("globals.php");

date_default_timezone_set("Asia/Tehran");

function makeDatabase()
{
    try{
        $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "CREATE DATABASE IF NOT EXISTS " .DATABASE_NAME. " CHARACTER SET utf8 COLLATE utf8_persian_ci";
        $db->exec($query);
        //echo "database created successfully";
        // select database
        $db->query("use ".DATABASE_NAME);
        // create tables
        // create users table
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(60) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            password VARCHAR(200) NOT NULL,
            admin_status TINYINT(1) DEFAULT 0,
            photo VARCHAR(100),
            join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_seen TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        $db->exec($query);
        // create categories table
        $query = "CREATE TABLE IF NOT EXISTS category (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(50) NOT NULL
            )";
        $db->exec($query);
        // create posts table
        $query = "CREATE TABLE IF NOT EXISTS posts (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(300) NOT NULL,
            body TEXT NOT NULL,
            photo VARCHAR(100),
            post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_edit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user_id INT(11) UNSIGNED NOT NULL,
            category_id INT(11) UNSIGNED NOT NULL,
            CONSTRAINT FK_UserPost FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT FK_CategoryPost FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE RESTRICT ON UPDATE RESTRICT
            )";
        $db->exec($query);
        // create comments table
        $query = "CREATE TABLE IF NOT EXISTS comments (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            body TEXT NOT NULL,
            status TINYINT(1) DEFAULT 0,
            comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user_id INT(11) UNSIGNED NOT NULL,
            CONSTRAINT FK_UserComment FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT
            )";
        $db->exec($query);
        // create replies table
        $query = "CREATE TABLE IF NOT EXISTS replies (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            body TEXT NOT NULL,
            status TINYINT(1) DEFAULT 0,
            comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            user_id INT(11) UNSIGNED NOT NULL,
            comment_id INT(11) UNSIGNED NOT NULL,
            CONSTRAINT FK_UserReply FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT FK_CommentReply FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE RESTRICT ON UPDATE RESTRICT
            )";
        $db->exec($query);
        // create subscribers table
        $query = "CREATE TABLE IF NOT EXISTS subscribers (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(60) NOT NULL,
            name TINYINT(1) DEFAULT 0,
            save_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        $db->exec($query);
        // create tags table
        $query = "CREATE TABLE IF NOT EXISTS tags (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(60) NOT NULL
            )";
        $db->exec($query);
        // create visits table
    }
    catch(PDOException $e) {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}

function getPosts($current_start_num, $limit_post_num)
{
    try
    {
        $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->query("use " . DATABASE_NAME);

        $query = "SELECT * FROM posts ORDER BY id DESC LIMIT :count_num OFFSET :start_num";

        $data = array(
            ":start_num" => $current_start_num,
            ":count_num" => $limit_post_num
        );

        $prepared = $db->prepare($query);
        $prepared->bindValue(":start_num", $current_start_num, PDO::PARAM_INT);
        $prepared->bindValue(":count_num", $limit_post_num, PDO::PARAM_INT);
        if($prepared->execute())
        {
            $result = $prepared->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        return NULL;

    }
    catch (PDOException $e) {
        die("DB ERROR: " . $query . "<br>" . $e->getMessage());
    }
}

?>
