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
    $features = $_POST["features"];
    $activities = $_POST["activities"];
    $landmarks = $_POST["landmarks"];

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
        header("Location: /website/admin/admin-dashboard.php?msg=updated");
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
    header("Location: /website/admin/admin-dashboard.php?msg=not-found");
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
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/website/darkmode.js" defer></script>
    <link rel="stylesheet" href="/website/public/style.css">
    <title>تعديل معرض الصور</title>
</head>

<body>
    <?php include("admin-header.php"); ?>

    <form action="/website/admin/edit-gallery.php" method="POST" enctype="multipart/form-data">
        <h2>تعديل المكان</h2>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="city">اسم المكان</label>
        <br>
        <input type="text" value="<?php echo $city; ?>" name="city" id="city" required>
        <br>

        <label for="galleryMainImage">الصورة الرئيسية الحالية</label>
        <br>
        <img src="/website/public<?php echo $mainImage; ?>" alt="<?php echo $city; ?>"
            style="max-width: 200px; margin-top: 10px;">
        <br>
        <input type="file" onchange="previewImage(event, 'galleryMainImagePreview')" accept="image/*"
            name="galleryMainImage" id="galleryMainImage">
        <br>
        <img id="galleryMainImagePreview" src="#" alt="معاينة الصورة الرئيسية"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>

        <label for="description">الوصف</label>
        <br>
        <input type="text" value="<?php echo $description; ?>" name="description" id="description" required>
        <br>

        <label for="region">المنطقة</label>
        <br>
        <select name="region" id="region" required>
            <option value="الرياض" <?php if ($region == "الرياض")
                echo "selected"; ?>>الرياض</option>
            <option value="مكة" <?php if ($region == "مكة")
                echo "selected"; ?>>مكة</option>
            <option value="المدينة" <?php if ($region == "المدينة")
                echo "selected"; ?>>المدينة</option>
            <option value="الشرقية" <?php if ($region == "الشرقية")
                echo "selected"; ?>>الشرقية</option>
            <option value="عسير" <?php if ($region == "عسير")
                echo "selected"; ?>>عسير</option>
            <option value="تبوك" <?php if ($region == "تبوك")
                echo "selected"; ?>>تبوك</option>
            <option value="حائل" <?php if ($region == "حائل")
                echo "selected"; ?>>حائل</option>
            <option value="الجوف" <?php if ($region == "الجوف")
                echo "selected"; ?>>الجوف</option>
            <option value="الحدود الشمالية" <?php if ($region == "الحدود الشمالية")
                echo "selected"; ?>>الحدود الشمالية
            </option>
            <option value="جازان" <?php if ($region == "جازان")
                echo "selected"; ?>>جازان</option>
            <option value="نجران" <?php if ($region == "نجران")
                echo "selected"; ?>>نجران</option>
            <option value="القصيم" <?php if ($region == "القصيم")
                echo "selected"; ?>>القصيم</option>
            <option value="الباحة" <?php if ($region == "الباحة")
                echo "selected"; ?>>الباحة</option>
        </select>
        <br>

        <label for="features">المميزات</label>
        <br>
        <input type="text" value="<?php echo $features; ?>" name="features" id="features" required>
        <br>

        <label for="activities">الأنشطة</label>
        <br>
        <input type="text" value="<?php echo $activities; ?>" name="activities" id="activities" required>
        <br>

        <label for="landmarks">أبرز المعالم</label>
        <br>
        <input type="text" value="<?php echo $landmarks; ?>" name="landmarks" id="landmarks" required>
        <br>


        <label for="galleryImageOne">صورة المعرض الحالية 1</label>
        <br>
        <img src="/website/public<?php echo $galleryImageOne; ?>" alt="صورة المعرض 1"
            style="max-width: 200px; margin-top: 10px;">
        <br>
        <input type="file" onchange="previewImage(event, 'galleryImageOnePreview')" accept="image/*"
            name="galleryImageOne" id="galleryImageOne">
        <br>
        <img id="galleryImageOnePreview" src="#" alt="معاينة صورة المعرض 1"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>

        <label for="galleryImageTwo">صورة المعرض الحالية 2</label>
        <br>
        <img src="/website/public<?php echo $galleryImageTwo; ?>" alt="صورة المعرض 2"
            style="max-width: 200px; margin-top: 10px;">
        <br>
        <input type="file" onchange="previewImage(event, 'galleryImageTwoPreview')" accept="image/*"
            name="galleryImageTwo" id="galleryImageTwo">
        <br>
        <img id="galleryImageTwoPreview" src="#" alt="معاينة صورة المعرض 2"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>

        <label for="galleryImageThree">صورة المعرض الحالية 3</label>
        <br>
        <img src="/website/public<?php echo $galleryImageThree; ?>" alt="صورة المعرض 3"
            style="max-width: 200px; margin-top: 10px;">
        <br>
        <input type="file" onchange="previewImage(event, 'galleryImageThreePreview')" accept="image/*"
            name="galleryImageThree" id="galleryImageThree">
        <br>
        <img id="galleryImageThreePreview" src="#" alt="معاينة صورة المعرض 3"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>

        <input type="submit" value="تحديث المكان">
    </form>

    <script src="/website/script.js"></script>
</body>

</html>