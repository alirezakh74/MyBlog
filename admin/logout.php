<?php
session_start();
unset($_SESSION['user_email']);
session_unset();
session_destroy();
?>