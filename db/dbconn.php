<?php

// localhost
$dbhost = "localhost";
$dbname = "tsf-netbanking";
$dbusername = "root";
$dbpassword = "";

// remotehost
// $dbhost = "remotemysql.com";
// $dbname = "u54j1egpnP";
// $dbusername = "u54j1egpnP";
// $dbpassword = "mTN6TSVoPS";

// AwardSpace
// $dbhost = "fdb34.awardspace.net";
// $dbusername = "3894080_netbanking";
// $dbpassword = "[tFh3Ztd3+?%P+;/";
// $dbname = "3894080_netbanking";

$charset = "utf8mb4";
$dns = "mysql:host=$dbhost; dbname=$dbname; charset=$charset";

try {
    $pdo = new PDO($dns, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);

    // echo "connected";
} catch (PDOException $th) {
    echo $th->getMessage();
}
