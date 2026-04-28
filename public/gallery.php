<?php
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/website/style.css">
    <script type="text/javascript" src="/website/darkmode.js" defer></script>
</head>

<body>
    <?php include __DIR__ . "/home-header.php"; ?>
    <nav>

        <form action="/website/public/gallery.php" method="GET">
            <input type="text" id="search" name="search" placeholder="مثال: خميس مشيط">
            <input type="submit" value="ابحث">
        </form>
        <br>
        <form action="/website/public/gallery.php" method="GET">
            <label for="region">اختر المنطقة</label>

            <select name="region" id="region" onchange="this.form.submit()">
                <option value="all">كل المناطق</option>
                <option value="الرياض">الرياض</option>
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
        </form>
    </nav>
    <?php
    $query;
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //comes from drop menu 
        if (isset($_GET["region"]) && $_GET["region"] != "all") {
            $region = $_GET["region"];
            $query = "SELECT * FROM places WHERE region = '$region'";
        } else {
            $query = "SELECT * FROM places";
        }
        if (!empty($_GET["search"])) {
            $city = $_GET["search"];
            $query = "SELECT * FROM places WHERE city = '$city'";
        }
        $result = mysqli_query($connection, $query);
        $numberOfRows = mysqli_num_rows($result);
        if ($numberOfRows > 0) {
            for ($i = 0; $i < $numberOfRows; $i++) {
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $id = $row["id"];
                    $city = $row["city"];
                    $mainImage = $row["main_image"];
                    $region = $row["region"];
                    $description = $row["description"];
                    $features = $row["features"];
                    $activities = $row["activities"];
                    $landmarks = explode(",", $row["Landmarks"]);
                    $galleryImageOne = $row["galleryImageOne"];
                    $galleryImageTwo = $row["galleryImageTwo"];
                    $galleryImageThree = $row["galleryImageThree"];
                    ?>


                    <a class='card-link' href='/website/public/place-details.php?id=<?php echo $id; ?>'>
                        <div class='card'>
                            <img class='card-img' src='/website/public<?php echo $mainImage; ?>' alt='<?php echo $city; ?>'>

                            <p><?php echo $region; ?></p>

                            <h3><?php echo $city; ?></h3>

                            <p><?php echo $description; ?></p>
                        </div>
                    </a>
                    <?php
                }
                ?>
                <?php
            }
        } else {
            echo "No Data Found.";
        }
    }

    ?>

    <?php include __DIR__ . "/includes/footer.php"; ?>
</body>

</html>