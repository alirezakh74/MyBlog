<?php
require_once("../include/consts.php");
//require_once("../include/functions.php");

$active = ($_REQUEST['active'] == "true") ? 1 : 0;
$id = (int)$_REQUEST['id'];
$query = "UPDATE posts SET active = :post_active WHERE id = :post_id";
$bind_array = [":post_active" => $active, ":post_id" => $id];

try {
    $db = new PDO(DSN, DB_USER_NAME, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("use " . DATABASE_NAME);
    $prepared = $db->prepare($query);
    $result = $prepared->execute($bind_array);
} catch (PDOException $e) {
    die("DB ERROR: " . "<br>" . $e->getMessage());
}

if($result)
{
    echo "activation updated";
}
else
{
    echo "activation failed";
}
