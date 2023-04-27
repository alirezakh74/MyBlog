<?php
require_once("admin/include/functions.php");
$post = getPostInfoById($_GET['post_id']);
?>

<main class="single_post">
    <h1><?php echo $post['title']; ?></h1>
    <img src="<?php echo "admin/upload/photos/posts/" . $post['photo']; ?>" alt="" title="">
    <p><?php echo $post['body']; ?></p>
</main>