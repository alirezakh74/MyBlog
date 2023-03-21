<?php 
require_once("include/header.php");
require_once("include/sidebar.php");


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
