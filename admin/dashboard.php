<?php
session_start();

if(!isset($_SESSION['user_email']))
{
    header("Location:index.php");
    exit;
}

require_once("include/functions.php");
require_once("include/header.php");
require_once("include/sidebar.php");
?>

<!-- (B) main --> 
<div id="pgmain">

<?php
/* add module and action(page) */
if (isset($_GET['m']) and isset($_GET['p'])) {
    $m = $_GET['m'];
    $p = $_GET['p'];
    require_once($m . "/" . $p . ".php"); // for example: "post/add.php"
}
else {
    require_once("index/index.php");
}

require_once("include/footer.php");
?>

<!-- end of main -->
</div>
