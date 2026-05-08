<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
//     session_start();
//     session_destroy();
//     header("Location: /public/index.php");
//     exit();
// }
?>
<header class="parent">
    <link href="/public/style.css" rel="stylesheet">
    <h3 class="div1"><?php echo $pageTitle ?? "لوحة تحكم المشرف"; ?></h3>
    <form method="get" action="/admin/admin-dashboard.php">
        <button type="submit" class="div2">لوحة التحكم</button>
    </form>

    <form method="POST" action="/admin/logout.php">
        <button type="submit" name="logout" class="div3">تسجيل الخروج</button>
    </form>
    <?php include("../public/includes/dark-theme-button.php"); ?>
    <script src="/public/darkmode.js"></script>
</header>