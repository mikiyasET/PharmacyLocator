<?php
include_once '../mvc/connect.php';
$_SESSION['admin'] = 0;
unset($_SESSION['admin']);
session_destroy();
?>
<script>
    window.location.href = 'index.php'
</script>
