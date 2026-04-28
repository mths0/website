<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/website/public/style.css" rel="stylesheet">
    <script type="text/javascript" src="/website/darkmode.js" defer></script>
    <title>Admin Login</title>
</head>

<body>
    <?php
    include("../public/home-header.php") ?>
    <h1>تسجيل دخول المشرف </h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <label>اسم المستخدم</label><br>
        <input type="text" name="username" required>
        <br>
        <label>كلمة المرور</label><br>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="دخول">
        <hr>
    </form>


    <?php

    include("../config/db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $request = $_POST;
        if (!empty($request["username"]) && !empty($request["password"])) {

            $user = $request["username"];
            $password = $request["password"];

            $sql = "SELECT * FROM admins WHERE name = '$user' and password = '$password' ";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id = $row["id"];

                //! save session
                session_start();
                $_SESSION["admin_logged_in"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["name"] = $user;
                $_SESSION["password"] = $password;
                header("Location: /website/admin/admin-dashboard.php"); // go to admin dashboard
                exit();
            } else {
                echo "You are not admin";
                exit();
            }

        }
    }

    ?>
    <script src="/website/script.js"></script>
</body>

</html>