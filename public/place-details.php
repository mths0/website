<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اكتشف السعودية | محتوى المكان</title>
    <link rel="stylesheet" href="/style.css">
    <script type="text/javascript" src="/darkmode.js" defer></script>
</head>

<body>
    <?php
    include("home-header.php");
    include("../config/db.php");
    ?>
    <main>
        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $query = "SELECT * FROM places WHERE id = $id";
            $result = mysqli_query($connection, $query);
            if ($result) {

                $place = mysqli_fetch_assoc($result);
                if ($place) {
                    $city = $place["city"];
                    $mainImagePath = $place["main_image"];
                    $region = $place["region"];
                    $description = $place["description"];
                    $features = explode(",", $place["features"]);
                    $activities = explode(",", $place["activities"]);
                    $landmarks = explode(",", $place["landmarks"]);
                    $galleryImageOnePath = $place["gallery_image_one"];
                    $galleryImageTwoPath = $place["gallery_image_two"];
                    $galleryImageThreePath = $place["gallery_image_three"];
                    ?>
                    <article class="detail-card">
                        <section class="detail-hero">
                            <img class="cover-img" src="/public<?php echo $mainImagePath; ?>" alt="<?php echo $city; ?>">
                            <span class="detail-region"><?php echo $region; ?></span>
                        </section>

                        <section class="detail-body">
                            <h1 class="detail-city"><?php echo $city; ?></h1>
                            <p class="detail-desc"><?php echo $description; ?></p>

                            <section class="info-boxes" aria-label="Place details">
                                <section class="info-box info-box-green">
                                    <h2>المميزات</h2>
                                    <ul>
                                        <?php foreach ($features as $feature): ?>
                                            <li><?php echo $feature; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                                <section class="info-box info-box-gold">
                                    <h2>الأنشطة</h2>
                                    <ul>
                                        <?php foreach ($activities as $activity): ?>
                                            <li><?php echo $activity; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                            </section>

                            <section class="landmarks">
                                <h2>المعالم</h2>
                                <ul>
                                    <?php foreach ($landmarks as $landmark): ?>
                                        <li><?php echo $landmark; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </section>

                            <section aria-labelledby="place-gallery-title">
                                <h2 class="gallery-title" id="place-gallery-title">معرض الصور</h2>
                                <div class="gallery">
                                    <img class="gallery-img" src="/public<?php echo $galleryImageOnePath; ?>" alt="<?php echo $city; ?>">
                                    <img class="gallery-img" src="/public<?php echo $galleryImageTwoPath; ?>" alt="<?php echo $city; ?>">
                                    <img class="gallery-img" src="/public<?php echo $galleryImageThreePath; ?>" alt="<?php echo $city; ?>">
                                </div>
                            </section>
                        </section>
                    </article>
                    <?php
                } else {
                    echo "لم نجد المكان.";
                }
            } else {
                echo "خطأ في استدعاء معلومات المكان.";
            }
        } else {
            echo "لا يوجد مكان برقم التعريفي هذا.";
        }
        ?>
    </main>
    <?php include __DIR__ . "/includes/footer.php"; ?>
</body>

</html>
