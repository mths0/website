<?php
include("../public/includes/admin-auth.php");
include("../config/db.php");


function uploadImageIfExists($inputName, $oldPath, $serverPath)
{
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]["error"] == 0) {
        $imageName = basename($_FILES[$inputName]["name"]);
        move_uploaded_file($_FILES[$inputName]["tmp_name"], $serverPath . $imageName);

        return "/uploads/places/" . $imageName;
    }

    return $oldPath;
}

/*
    POST = update the place
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $city = $_POST["city"];
    $description = $_POST["description"];
    $region = $_POST["region"];
    $features = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["features"]));
    $activities = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["activities"]));
    $landmarks = str_replace(["\r\n", "\n", "\r"], ",", trim($_POST["landmarks"]));

    /*
        First get old images.
        This is important because images are optional in edit.
        If admin does not upload a new image, we keep the old one.
    */
    $oldQuery = "SELECT * FROM places WHERE id = $id";
    $oldResult = mysqli_query($connection, $oldQuery);
    $oldPlace = mysqli_fetch_assoc($oldResult);

    $serverPath = __DIR__ . "/../public/uploads/places/";

    $mainImagePath = $oldPlace["main_image"];
    $imageOnePath = $oldPlace["gallery_image_one"];
    $imageTwoPath = $oldPlace["gallery_image_two"];
    $imageThreePath = $oldPlace["gallery_image_three"];

    $mainImagePath = uploadImageIfExists("galleryMainImage", $mainImagePath, $serverPath);
    $imageOnePath = uploadImageIfExists("galleryImageOne", $imageOnePath, $serverPath);
    $imageTwoPath = uploadImageIfExists("galleryImageTwo", $imageTwoPath, $serverPath);
    $imageThreePath = uploadImageIfExists("galleryImageThree", $imageThreePath, $serverPath);

    $query = "UPDATE places SET 
        city = '$city',
        region = '$region',
        description = '$description',
        features = '$features',
        activities = '$activities',
        landmarks = '$landmarks',
        main_image = '$mainImagePath',
        gallery_image_one = '$imageOnePath',
        gallery_image_two = '$imageTwoPath',
        gallery_image_three = '$imageThreePath'
        WHERE id = $id";

    if (mysqli_query($connection, $query)) {
        header("Location: /admin/admin-dashboard.php?msg=updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}



$formId = $_GET["id"];
$query = "SELECT * FROM places WHERE id = $formId";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: /admin/admin-dashboard.php?msg=not-found");
    exit();
}

$id = $row["id"];
$city = $row["city"];
$mainImage = $row["main_image"];
$region = $row["region"];
$description = $row["description"];
$features = $row["features"];
$activities = $row["activities"];
$landmarks = $row["landmarks"];
$galleryImageOne = $row["gallery_image_one"];
$galleryImageTwo = $row["gallery_image_two"];
$galleryImageThree = $row["gallery_image_three"];

$featuresLines = str_replace(",", "\n", $features);
$activitiesLines = str_replace(",", "\n", $activities);
$landmarksLines = str_replace(",", "\n", $landmarks);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/darkmode.js" defer></script>
    <link rel="stylesheet" href="/style.css">
    <title>تعديل معرض الصور</title>
</head>

<body>
    <?php
    $pageTitle = "تعديل المحتوى";
    include("admin-header.php"); ?>

    <form class="add-form" action="/admin/edit-gallery.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="detail-card">
            <div class="detail-hero add-hero">
                <img id="galleryMainImagePreview" class="cover-img add-cover-preview"
                    src="/public<?php echo $mainImage; ?>" alt="<?php echo htmlspecialchars($city); ?>">
                <div class="add-cover-placeholder" style="display:none;">اضغط لاستبدال صورة الغلاف</div>
                <input type="file" name="galleryMainImage" accept="image/*"
                    class="add-cover-input"
                    onchange="previewImage(event, 'galleryMainImagePreview')">
                <select name="region" required class="add-region-select detail-region">
                    <?php
                    $regions = ["وسطى", "غربية", "جنوبية", "شرقية", "شمالية"];
                    foreach ($regions as $r) {
                        $sel = ($r === $region) ? " selected" : "";
                        echo "<option value=\"$r\"$sel>$r</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="detail-body">
                <input type="text" name="city" required value="<?php echo htmlspecialchars($city); ?>"
                    placeholder="اسم المكان *" class="add-city-input">
                <textarea name="description" required rows="4" placeholder="وصف قصير عن المكان *"
                    class="add-desc-input"><?php echo htmlspecialchars($description); ?></textarea>

                <div class="info-boxes">
                    <div class="info-box info-box-green">
                        <h3>المميزات <span class="req-star">*</span></h3>
                        <textarea name="features" required rows="3" placeholder="كل سطر يصبح نقطة"
                            class="add-info-input"><?php echo htmlspecialchars($featuresLines); ?></textarea>
                    </div>
                    <div class="info-box info-box-gold">
                        <h3>الأنشطة <span class="req-star">*</span></h3>
                        <textarea name="activities" required rows="3" placeholder="كل سطر يصبح نقطة"
                            class="add-info-input"><?php echo htmlspecialchars($activitiesLines); ?></textarea>
                    </div>
                </div>

                <div class="landmarks">
                    <h3>المعالم <span class="req-star">*</span></h3>
                    <textarea name="landmarks" required rows="3" placeholder="كل سطر يصبح نقطة"
                        class="add-info-input"><?php echo htmlspecialchars($landmarksLines); ?></textarea>
                </div>

                <h3 class="gallery-title">معرض الصور</h3>
                <div class="gallery add-gallery">
                    <label class="add-gallery-slot">
                        <img id="galleryImageOnePreview" class="gallery-img"
                            src="/public<?php echo $galleryImageOne; ?>" alt="">
                        <input type="file" name="galleryImageOne" accept="image/*" hidden
                            onchange="previewImage(event, 'galleryImageOnePreview')">
                    </label>
                    <label class="add-gallery-slot">
                        <img id="galleryImageTwoPreview" class="gallery-img"
                            src="/public<?php echo $galleryImageTwo; ?>" alt="">
                        <input type="file" name="galleryImageTwo" accept="image/*" hidden
                            onchange="previewImage(event, 'galleryImageTwoPreview')">
                    </label>
                    <label class="add-gallery-slot">
                        <img id="galleryImageThreePreview" class="gallery-img"
                            src="/public<?php echo $galleryImageThree; ?>" alt="">
                        <input type="file" name="galleryImageThree" accept="image/*" hidden
                            onchange="previewImage(event, 'galleryImageThreePreview')">
                    </label>
                </div>

                <div class="add-actions">
                    <button type="submit" class="add-submit-btn">تطبيق التعديلات</button>
                    <button type="submit" class="delete-btn-large"
                        formaction="/admin/delete-gallery.php" formnovalidate
                        onclick="return confirm('هل أنت متأكد من حذف هذا العنصر؟');">حذف المكان</button>
                </div>
            </div>
        </div>
    </form>

    <script src="/script.js"></script>
</body>

</html>