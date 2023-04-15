<?php
if(isset($_POST['submit']) and isset($_POST['post_title']) and isset($_POST['post_body']))
{
addPost($_POST['post_title'], $_POST['post_body']/*, $_FILES['post_image']*/);
}
?>
<form action="dashboard.php?m=post&p=add" method="post" enctype="multipart/form-data" class="post-form">
    <input type="text" name="post_title" id="post_title" placeholder="عنوان مطلب">
    <textarea name="post_body" id="post_body" cols="30" rows="30" placeholder="مطلب پست"></textarea>
    <input type="file" name="post_image" id="post_image">
    <input type="submit" name="submit" id="submit" value="ذخیره">
</form>