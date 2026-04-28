<?php
session_start();
session_destroy();
header("Location: /website/admin/login.php");
exit();
?>