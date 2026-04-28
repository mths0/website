<?php
include("../public/includes/admin-auth.php");
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST["city"];
    $description = $_POST["description"];
    $region = $_POST["region"];
    $features = $_POST["features"];
    $activities = $_POST["activities"];
    $landmarks = $_POST["landmarks"];

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
        header("Location: /website/admin/admin-dashboard.php?msg=created");
        mysqli_close($connection);
        exit();

    } else {
        header("Location: /website/admin/admin-dashboard.php?msg=create-error");
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
    <link rel="stylesheet" href="/website/public/style.css">
    <script type="text/javascript" src="/website/darkmode.js" defer></script>
    <title>إضافة صور جديدة إلى المعرض</title>
</head>

<body>
    <?php include("admin-header.php") ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <h2>إضافة صور جديدة إلى المعرض</h2>

        <label for="city">اسم المكان*</label>
        <br>
        <input type="text" name="city" id="city" required>
        <br>
        <label for="galleryMainImage">الصورة الرئيسية للمكان*</label><br>
        <input type="file" onchange="previewImage(event, 'galleryMainImagePreview')" accept="image/*"
            name="galleryMainImage" id="galleryMainImage" required>
        <img id="galleryMainImagePreview" src="#" alt="معاينة الصورة الرئيسية"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>
        <label for="description">الوصف*</label><br>
        <input type="text" name="description" id="description" required>
        <br>
        <label for="region">المنطقة</label><br>
        <select name="region" id="region" required>
            <option value="الرياض" selected>الرياض</option>
            <option value="مكة">مكة</option>
            <option value="المدينة">المدينة</option>
            <option value="الشرقية">الشرقية</option>
            <option value="عسير">عسير</option>
            <option value="تبوك">تبوك</option>
            <option value="حائل">حائل</option>
            <option value="الجوف">الجوف</option>
            <option value="الحدود الشمالية">الحدود الشمالية</option>
            <option value="جازان">جازان</option>
            <option value="نجران">نجران</option>
            <option value="القصيم">القصيم</option>
            <option value="الباحة">الباحة</option>
        </select>
        <br>
        <label for="features">المميزات*</label><br>
        <input type="text" name="features" id="features" required>
        <br>
        <label for="activities">الانشطة (افصل بين الانشطة بفاصلة)*</label><br>
        <input type="text" name="activities" id="activities" required>
        <br>
        <label for="landmarks">ابرز المعالم (افصل بين المعالم بفاصلة)*</label><br>
        <input type="text" name="landmarks" id="landmarks" required>
        <br>
        <label for="galleryImageOne">صورة المعرض 1:* </label><br>
        <input type="file" onchange="previewImage(event, 'galleryImageOnePreview')" accept="image/*"
            name="galleryImageOne" id="galleryImageOne" required>
        <img id="galleryImageOnePreview" src="#" alt="معاينة صورة المعرض 1"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>
        <label for="galleryImageTwo">صورة المعرض 2:* </label><br>
        <input type="file" onchange="previewImage(event, 'galleryImageTwoPreview')" accept="image/*"
            name="galleryImageTwo" id="galleryImageTwo" required>
        <img id="galleryImageTwoPreview" src="#" alt="معاينة صورة المعرض 2"
            style="display: none; max-width: 200px; margin-top: 10px;">
        <br>
        <label for="galleryImageThree">صورة المعرض 3:* </label><br>
        <input type="file" onchange="previewImage(event, 'galleryImageThreePreview')" accept="image/*"
            name="galleryImageThree" id="galleryImageThree" required>

        <img id="galleryImageThreePreview" src="#" alt="معاينة صورة المعرض 3"
            style="display: none; max-width: 200px; margin-top: 10px;" req><br>
        <input type="submit" value="اضافة مكان جديد">
    </form>

    <script src="/website/script.js"></script>
</body>

</html>