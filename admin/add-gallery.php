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

    // Handle file uploads
    $galleryMainImage = $_FILES["galleryMainImage"];
    $galleryImageOne = $_FILES["galleryImageOne"];
    $galleryImageTwo = $_FILES["galleryImageTwo"];
    $galleryImageThree = $_FILES["galleryImageThree"];

    // Upload to server
    $serverPath = __DIR__ . "/../public/uploads/places/";

    move_uploaded_file($galleryMainImage["tmp_name"], $serverPath . basename($galleryMainImage["name"]));
    move_uploaded_file($galleryImageOne["tmp_name"], $serverPath . basename($galleryImageOne["name"]));
    move_uploaded_file($galleryImageTwo["tmp_name"], $serverPath . basename($galleryImageTwo["name"]));
    move_uploaded_file($galleryImageThree["tmp_name"], $serverPath . basename($galleryImageThree["name"]));

    // Save to database
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
    <title>إضافة صور جديدة إلى المعرض</title>
</head>

<body>
    <?php
    $pageTitle = "محتوى جديد";
    include("admin-header.php"); ?>
    <form class="add-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="detail-card">
            <div class="detail-hero add-hero">
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
            </div>

            <div class="detail-body">
                <input type="text" name="city" required placeholder="اسم المكان *" class="add-city-input">
                <textarea name="description" required rows="4" placeholder="وصف قصير عن المكان *" class="add-desc-input"></textarea>

                <div class="info-boxes">
                    <div class="info-box info-box-green">
                        <h3>المميزات <span class="req-star">*</span></h3>
                        <textarea name="features" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                    </div>
                    <div class="info-box info-box-gold">
                        <h3>الأنشطة <span class="req-star">*</span></h3>
                        <textarea name="activities" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                    </div>
                </div>

                <div class="landmarks">
                    <h3>المعالم <span class="req-star">*</span></h3>
                    <textarea name="landmarks" required rows="3" placeholder="كل سطر يصبح نقطة" class="add-info-input"></textarea>
                </div>

                <h3 class="gallery-title">معرض الصور <span class="req-star">*</span></h3>
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

                <input type="submit" value="إضافة المكان" class="add-submit-btn">
            </div>
        </div>
    </form>

    <script src="/script.js"></script>
</body>

</html>