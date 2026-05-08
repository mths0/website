<header class="parent">
    <h2 class="div1"><?php echo $pageTitle ?? "اكتشف السعودية"; ?></h2>
    <form action="/public/index.php" method="get">
        <button type="submit">الرئيسية</button>
    </form>
    <form action="/public/gallery.php" method="get">
        <button type="submit">معرض المناطق</button>
    </form>
    <form action="/admin/login.php" method="get">
        <button type="submit">دخول المشرف</button>
    </form>
   <?php include __DIR__ . "/includes/dark-theme-button.php"; ?>
    <script src="website/script.js"></script>
</header>