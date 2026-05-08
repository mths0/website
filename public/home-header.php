<header class="parent">
    <link href="/public/style.css" rel="stylesheet">

    <h2 class="div1"><?php echo $pageTitle ?? "اكتشف السعودية"; ?></h2>
    <form action="/public/index.php" method="get">
        <button type="submit" class="div2">الرئيسية</button>
    </form>
    <form action="/public/gallery.php" method="get">
        <button type="submit" class="div3">معرض المناطق</button>
    </form>
    <form action="/admin/login.php" method="get">
        <button type="submit" class="div4">دخول المشرف</button>
    </form>
   <?php include __DIR__ . "/includes/dark-theme-button.php"; ?>
    <script src="website/script.js"></script>
</header>