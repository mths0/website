<?php

include("../public/includes/admin-auth.php");
include("../config/db.php");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/website/public/style.css">
    <script type="text/javascript" src="/website/darkmode.js" defer></script>
</head>

<body>

    <?php
    include("admin-header.php");

    if (isset($_GET["msg"])): ?>
        <!--TODO make it function -->
        <?php if ($_GET["msg"] == "deleted"): ?>
            <p class="success-message">تم حذف العنصر بنجاح</p>
        <?php elseif ($_GET["msg"] == "delete-error"): ?>
            <p class="error-message">حدث خطأ أثناء الحذف</p>
        <?php elseif ($_GET["msg"] == "updated"): ?>
            <p class="success-message">تم تعديل العنصر بنجاح</p>
        <?php elseif ($_GET["msg"] == "update-error"): ?>
            <p class="error-message">حدث خطأ أثناء التعديل</p>
        <?php elseif ($_GET["msg"] == "created"): ?>
            <p class="success-message">تم إنشاء العنصر بنجاح</p>
        <?php elseif ($_GET["msg"] == "create-error"): ?>
            <p class="error-message">حدث خطأ أثناء إنشاء العنصر</p>
        <?php endif ?>


    <?php endif ?>

    <h1>إدارة المحتوى</h1>
    <p>مرحبًا بك في لوحة تحكم الإدارة. هنا يمكنك إدارة موقعك على الويب.</p>

    <form method="get" action="/website/admin/add-gallery.php">
        <button type="submit"> إضافة محتوى جديد</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>المنطقة</th>
            <th>التصنيف</th>
            <th>الوصف</th>
            <th colspan="2">الإجراءات</th>
        </tr>

        <?php
        $query = "SELECT * FROM places";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $city = $row["city"];
                $region = $row["region"];
                $description = $row["description"];
                ?>

                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $city; ?></td>
                    <td><?php echo $region; ?></td>
                    <td><?php echo $description; ?></td>
                    <td>
                        <form method="get" action="/website/admin/edit-gallery.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="edit-btn">تعديل</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="/website/admin/delete-gallery.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" onclick="return confirm('هل أنت متأكد من حذف هذا العنصر؟');"
                                class="delete-btn">حذف</button>
                        </form>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "<tr><td colspan='6'>No Data Found.</td></tr>";
        }
        ?>
    </table>
    <script src="/website/script.js"></script>
</body>

</html>