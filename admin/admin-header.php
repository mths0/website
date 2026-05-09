<header class="parent">
    <h3 class="div1"><?php echo $pageTitle ?? "لوحة تحكم المشرف"; ?></h3>
    <nav class="site-nav" aria-label="Admin navigation">
        <a class="site-nav-link" href="/admin/admin-dashboard.php">لوحة التحكم</a>
    </nav>
    <form method="POST" action="/admin/logout.php">
        <button type="submit" name="logout">تسجيل الخروج</button>
    </form>
    <?php include("../public/includes/dark-theme-button.php"); ?>
</header>
