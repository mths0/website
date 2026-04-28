<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
//     session_start();
//     session_destroy();
//     header("Location: /website/public/index.php");
//     exit();
// }
?>
<header class="parent">
    <link href="/website/public/style.css" rel="stylesheet">
    <h3 class="div1">لوحة تحكم المشرف</h3>
    <form method="get" action="/website/admin/admin-dashboard.php">
        <button type="submit" class="div2">لوحة التحكم</button>
    </form>

    <form method="POST" action="/website/admin/logout.php">
        <button type="submit" name="logout" class="div3">تسجيل الخروج</button>
    </form>
    <?php include("../public/includes/dark-theme-button.php"); ?>
    <script src="/website/public/darkmode.js"></script>
</header>