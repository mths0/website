<?php
include "../public/includes/admin-auth.php";
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $query = "DELETE FROM places WHERE id = $id ";
    if (mysqli_query($connection, $query)) {
        header("Location: /admin/admin-dashboard.php?msg=deleted");
        exit();

    } else {
        header("Location: /admin/admin-dashboard.php?msg=delete-error");
        exit();
    }
}
?>