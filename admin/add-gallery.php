<?php
include("../public/includes/admin-auth.php");
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST["city"];
    $description = $_POST["description"];
    $region = $_POST["region"];
    $features = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["features"]));
    $activities = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["activities"]));
    $landmarks = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["landmarks"]));

    $galleryMainImage = $_FILES["galleryMainImage"];
    $galleryImageOne = $_FILES["galleryImageOne"];
    $galleryImageTwo = $_FILES["galleryImageTwo"];
    $galleryImageThree = $_FILES["galleryImageThree"];

    $serverPath = __DIR__ . "/../public/uploads/places/";

    move_uploaded_file($galleryMainImage["tmp_name"], $serverPath . basename($galleryMainImage["name"]));
    move_uploaded_file($galleryImageOne["tmp_name"], $serverPath . basename($galleryImageOne["name"]));
    move_uploaded_file($galleryImageTwo["tmp_name"], $serverPath . basename($galleryImageTwo["name"]));
    move_uploaded_file($galleryImageThree["tmp_name"], $serverPath . basename($galleryImageThree["name"]));

    $mainImagePath = "/uploads/places/" . $galleryMainImage["name"];
    $imageOnePath = "/uploads/places/" . $galleryImageOne["name"];
    $imageTwoPath = "/uploads/places/" . $galleryImageTwo["name"];
    $imageThreePath = "/uploads/places/" . $galleryImageThree["name"];

    $query = "INSERT INTO places (city, region, description, features, activities, landmarks, main_image, gallery_image_one, gallery_image_two, gallery_image_three) VALUES ('$city', '$region', '$description', '$features', '$activities', '$landmarks', '$mainImagePath', '$imageOnePath', '$imageTwoPath', '$imageThreePath')";

    if (mysqli_query($connection, $query)) {
        header("Location: /admin/admin-dashboard.php?msg=created");
        mysqli_close($connection);
        exit();

    } else {
        header("Location: /admin/admin-dashboard.php?msg=create-error");
        mysqli_close($connection);
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <script type="text/javascript" src="/darkmode.js" defer></script>
    <title>اكتشف السعودية | إضافة محتوى</title>
</head>

<body>
    <?php
    $pageTitle = "محتوى جديد";
    include("admin-header.php");
    ?>
    <main>
        <form class="add-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <article class="detail-card">
                <section class="detail-hero add-hero">
                    <img id="galleryMainImagePreview" class="cover-img add-cover-preview" src="#" alt="" style="display:none;">
                    <div class="add-cover-placeholder">اضغط لاختيار صورة الغلاف *</div>
                    <input type="file" name="galleryMainImage" accept="image/*" required
                        class="add-cover-input"
                        onchange="previewImage(event, 'galleryMainImagePreview')">
                    <select name="region" required class="add-region-select detail-region">
                        <option value="" disabled selected>المنطقة</option>
                        <?php
                        $regions = ["وسطى", "غربية", "جنوبية", "شرقية", "شمالية"];
                        foreach ($regions as $r) {
                            echo "<option value=\"$r\">$r</option>";
                        }
                        ?>
                    </select>
                </section>

                <section class="detail-body">
                    <input type="text" name="city" required placeholder="اسم المكان *" class="add-city-input">
                    <textarea name="description" required rows="4" placeholder="وصف قصير عن المكان *" class="add-desc-input"></textarea>

                    <section class="info-boxes" aria-label="Place details form">
                        <section class="info-box info-box-green">
                            <h2>المميزات <span class="req-star">*</span></h2>
                            <textarea name="features" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                        </section>
                        <section class="info-box info-box-gold">
                            <h2>الأنشطة <span class="req-star">*</span></h2>
                            <textarea name="activities" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                        </section>
                    </section>

                    <section class="landmarks">
                        <h2>المعالم <span class="req-star">*</span></h2>
                        <textarea name="landmarks" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                    </section>

                    <section aria-labelledby="add-gallery-title">
                        <h2 class="gallery-title" id="add-gallery-title">معرض الصور <span class="req-star">*</span></h2>
                        <div class="gallery add-gallery">
                            <label class="add-gallery-slot">
                                <img id="galleryImageOnePreview" class="gallery-img" src="#" alt="" style="display:none;">
                                <span class="add-gallery-placeholder">صورة 1 *</span>
                                <input type="file" name="galleryImageOne" accept="image/*" required hidden
                                    onchange="previewImage(event, 'galleryImageOnePreview')">
                            </label>
                            <label class="add-gallery-slot">
                                <img id="galleryImageTwoPreview" class="gallery-img" src="#" alt="" style="display:none;">
                                <span class="add-gallery-placeholder">صورة 2 *</span>
                                <input type="file" name="galleryImageTwo" accept="image/*" required hidden
                                    onchange="previewImage(event, 'galleryImageTwoPreview')">
                            </label>
                            <label class="add-gallery-slot">
                                <img id="galleryImageThreePreview" class="gallery-img" src="#" alt="" style="display:none;">
                                <span class="add-gallery-placeholder">صورة 3 *</span>
                                <input type="file" name="galleryImageThree" accept="image/*" required hidden
                                    onchange="previewImage(event, 'galleryImageThreePreview')">
                            </label>
                        </div>
                    </section>

                    <input type="submit" value="إضافة المكان" class="add-submit-btn">
                </section>
            </article>
        </form>
    </main>

    <script src="/script.js"></script>
</body>

</html>
