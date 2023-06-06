<?php
define('security', true);
include 'db_connect.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
session_start();
include 'header.php';
if (isset($_GET['sayfa'])) {
    $sayfa = $_GET['sayfa'];
    switch ($sayfa) {
        case 'Anasayfa';
            include 'anasayfa.php';
            break;
        case 'Ilanlar';
            include "ilanlar.php";
            break;
        case 'Hakkimizda';
            include "hakkimizda.php";
            break;
        case 'Iletisim';
            include "iletisim.php";
            break;
        case 'Ilandetay';
            include "ilandetay.php";
            break;
        default;
            include 'anasayfa.php';
            break;
    }
}
else{
    include 'anasayfa.php';
}
include 'footer.php';
?>
