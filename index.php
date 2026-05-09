<?php
include("/config/db.php");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/darkmode.js" defer></script>
    <link rel="stylesheet" href="/style.css">
    <title>Discover Saudi</title>
</head>

<body>
    <?php include("./public/home-header.php"); ?>
    <main>
        <section class="cards-row" aria-labelledby="welcome-heading">
            <article class="card-index card-welcome">
                <p>اكتشف المملكة العربية السعودية</p>
                <h1 id="welcome-heading">مرحبــــــــــــــــــــــــــــاً بكم</h1>
            </article>
        </section>
        <section class="cards-row bottom-row" aria-label="Website overview">
            <article class="card-index">
                <h2>موقع لتعرف على المملكة</h2>
                <p>استكشف المملكة</p>
                <div>
                    <a href="/public/gallery.php" class="card-btn">اكتشف</a>
                </div>
            </article>
            <section class="cards-grid" aria-label="Highlights">
                <article class="card-index">
                    <h3>الهدف</h3>
                    <p></p>
                </article>
                <article class="card-index">
                    <h3>المناطق</h3>
                    <p></p>
                </article>
                <article class="card-index">
                    <h3>التفاصيل</h3>
                    <p></p>
                </article>
            </section>
        </section>
    </main>
    <?php include __DIR__ . "/public/includes/footer.php"; ?>

</body>

</html>
