<?php

// localhost
// $dbhost = "localhost";
// $dbname = "tsf-netbanking";
// $dbusername = "root";
// $dbpassword = "";
// $charset = "utf8mb4";

// remotehost
$dbhost = "remotemysql.com";
$dbname = "u54j1egpnP";
$dbusername = "u54j1egpnP";
$dbpassword = "mTN6TSVoPS";
$charset = "utf8mb4";

$dns = "mysql: host=$dbhost; dbname=$dbname; charset=$charset";


try {
    $pdo = new PDO($dns,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);

    echo "connected";
    
} catch (PDOException $th) {
    echo $th->getMessage();
}

?>