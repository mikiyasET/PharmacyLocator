<?php
if ($_GET['logout']) {
    session_start();
    unset($_SESSION['user']);
    session_destroy();
}
header('Location: user.php');
die();
?>