<?php
// if(isset($_GET['id']))
// {
//     editPost($_GET['id']);
// }
?>

<?php
// edit post
if (isset($_POST['submit']) and isset($_POST['post_title']) and isset($_POST['post_body'])) {
    if(!empty($_POST['post_title']) and !empty($_POST['post_body']))
    {
        if(isset($_GET['id']))
        {
            if (editPost($_GET['id'])) {
                // if add new photo save and delete old photo
                uploadNewPostPhoto($_GET['id']);
                header("Location:dashboard.php?m=post&p=index");
                exit;
            }
        }
    }
}

// get post info and get it ready for edit in form
if(!isset($_GET['submit']) and isset($_GET['id']))
{
    $postInfo = getPostInfoById($_GET['id']);
}
?>
<form action="<?php if(isset($_GET['id'])) { echo 'dashboard.php?m=post&p=edit&id=' . $_GET['id'] ; } else { echo 'dashboard.php?m=post&p=edit'; } ?>" method="post" enctype="multipart/form-data" class="post-form">
    <input type="text" name="post_title" id="post_title" value="<?php if(isset($postInfo) and is_array($postInfo)) echo $postInfo['title'] ?>">
    <textarea name="post_body" id="post_body" cols="30" rows="30"><?php if(isset($postInfo) and is_array($postInfo)) echo $postInfo['body'] ?></textarea>
    
    <?php
    if(isset($postInfo['photo']) and $postInfo['photo'] != null)
    {
        echo "<img src='" . "upload/photos/posts/" . $postInfo['photo'] . "'>";
    }
    ?>
    <p>میتوانید تصویر جدیدی بارگذاری کنید</p>
    <input type="file" name="post_image" id="post_image">
    <input type="submit" name="submit" id="submit" value="بروز رسانی">
</form>
