<?php
!defined('security') ? die(header("Location: 404.php")) : null;
//EasyNFT
/*$DB_host = "localhost";
$DB_name = "easynftc_crypto";
$DB_username = "easynftc_admin";
$DB_password = "a77FB#giIuO*57";*/

//localhost
$DB_host = "localhost";
$DB_name = "emlakveritabani";
$DB_username = "root";
$DB_password = "";


try {
    $DB_connect = new PDO("mysql:host={$DB_host};dbname={$DB_name};charset=utf8", $DB_username, $DB_password);
    $DB_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
