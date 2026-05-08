<?php
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style.css">
    <script type="text/javascript" src="/darkmode.js" defer></script>
</head>

<body>
    <?php include __DIR__ . "/home-header.php"; ?>
    <main>
    <nav class="gallery-nav">
        <form class="search-form" action="/public/gallery.php" method="GET">
            <input type="text" id="search" name="search" placeholder="مثال: خميس مشيط">
            <input type="submit" value="ابحث">
        </form>
        <form class="region-form" action="/public/gallery.php" method="GET">
            <select name="region" id="region" onchange="this.form.submit()">
                <?php
                $currentRegion = $_GET["region"] ?? "all";
                $regions = ["وسطى", "غربية", "جنوبية", "شرقية", "شمالية"];
                ?>
                <option value="all" <?php if ($currentRegion === "all") echo "selected"; ?>>كل المناطق</option>
                <?php foreach ($regions as $r): ?>
                    <option value="<?php echo $r; ?>" <?php if ($currentRegion === $r) echo "selected"; ?>><?php echo $r; ?></option>
                <?php endforeach; ?>
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
            ?>
            <div class="gallery-grid">
            <?php
            for ($i = 0; $i < $numberOfRows; $i++) {
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $id = $row["id"];
                    $city = $row["city"];
                    $mainImage = $row["main_image"];
                    $region = $row["region"];
                    $description = $row["description"];
                    ?>
                    <a class="card-link" href="/public/place-details.php?id=<?php echo $id; ?>">
                        <div class="card">
                            <img class="card-img" src="/public<?php echo $mainImage; ?>" alt="<?php echo $city; ?>">
                            <div class="card-body">
                                <h3 class="card-city"><?php echo $city; ?></h3>
                                <p class="card-desc"><?php echo $description; ?></p>
                            </div>
                            <div class="card-region"><?php echo $region; ?></div>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
            </div>
            <?php
        } else {
            echo "No Data Found.";
        }
    }

    ?>

    </main>
    <?php include __DIR__ . "/includes/footer.php"; ?>
</body>

</html>