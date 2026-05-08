<?php 
    $db_server = "localhost";
    $db_user = "discover_saudi";
    $db_pass = "pass";
    $db_name = "discover_saudi_db";
    $connection = "";
    $port = 3306;

    try {
        $connection = mysqli_connect($db_server,
                                     $db_user,
                                     $db_pass,
                                     $db_name,
                                     $port
                                    );
        
    } catch (mysqli_sql_exception) {
        echo "<br> Could not connect <br>";
    }

?>