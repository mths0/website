<!DOCTYPE html>
<html lang="ar" dir="rtl" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/style.css" rel="stylesheet">
    <script type="text/javascript" src="/darkmode.js" defer></script>
    <title>Admin Login</title>
</head>

<body>
    <?php
    $pageTitle = "دخول المشرف";
    include("../public/home-header.php");
    ?>
    <main class="login-page">
        <section class="login-card">
            <h1 class="login-title">تسجيل دخول المشرف</h1>
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input class="login-input" type="text" name="username" placeholder="اسم المستخدم" required>
                <input class="login-input" type="password" name="password" placeholder="كلمة المرور" required>
                <input class="login-submit" type="submit" value="دخول">
            </form>
        </section>
    </main>


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
                header("Location: /admin/admin-dashboard.php"); // go to admin dashboard
                exit();
            } else {
                echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة'); window.location.href='/admin/login.php';</script>";
                exit();
            }

        }
    }

    ?>
    <script src="/script.js"></script>
</body>

</html>
