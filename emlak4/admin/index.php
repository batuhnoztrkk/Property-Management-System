<?php
define('security', true);
include '../db_connect.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
session_start();
include "../db_connect.php";
if(isset($_SESSION['logged'])){
    include "header.php";
    if (isset($_GET['sayfa'])) {
        $sayfa = $_GET['sayfa'];
        switch ($sayfa) {
            case 'Anasayfa';
                include 'anasayfa.php';
                break;
            case 'Yeni_Ilan_Ekle';
                include 'ilanekle.php';
                break;
            case 'Ilan_Duzenle';
                include 'ilanduzenle.php';
                break;
            case 'YedekAl';
                include 'yedekal.php';
                break;
            case 'duzenle';
                include 'duzenle.php';
                break;
            case 'yayindankaldir';
                if (isset($_GET['ilanno'])){
                    $status = "0";
                    $id = $_GET['ilanno'];
                    $register = $DB_connect->prepare("UPDATE ilanlar SET status = :status WHERE id = :id");
                    $register->bindParam(':status', $status);
                    $register->bindParam(':id', $id);
                    if ($register->execute()) {
                        echo "<h2>İlan başarıyla yayından kaldırıldı! 2 saniye için ilan düzenleme sayfasına yönlendiriliyorsunuz!</h2>";
                        header("Refresh:2; url=Ilan_Duzenle");
                    } else {
                        echo "<h2>Beklenmeyen bir hata meydana geldi. Lütfen 0507 569 1340 ile iletişime geçiniz!</h2>";
                    }
                }
                else{
                    header("Refresh:2; url=Ilan_Duzenle");
                    die("İlan bulunamadı veya zaten yayından kaldırılmış.");
                }
                break;
            case 'yayinla';
                if (isset($_GET['ilanno'])){
                    $updatedate = date("y-m-d H:i:s");
                    $status = "1";
                    $id = $_GET['ilanno'];
                    $register = $DB_connect->prepare("UPDATE ilanlar SET status = :status, tarih = :tarih WHERE id = :id");
                    $register->bindParam(':status', $status);
                    $register->bindParam(':id', $id);
                    $register->bindParam(':tarih', $updatedate);
                    if ($register->execute()) {
                        echo "<h2>İlan başarıyla yayınlandı ve ilan tarihi güncellendi! 2 saniye için ilan düzenleme sayfasına yönlendiriliyorsunuz!</h2>";
                        header("Refresh:2; url=Ilan_Duzenle");
                    } else {
                        echo "<h2>Beklenmeyen bir hata meydana geldi. Lütfen 0507 569 1340 ile iletişime geçiniz!</h2>";
                    }
                }
                else{
                    header("Refresh:2; url=Ilan_Duzenle");
                    die("İlan bulunamadı veya zaten ilan yayında.");
                }
                break;
            default;
                include 'anasayfa.php';
                break;
        }
    }
    else{
        include 'anasayfa.php';
    }
    include "footer.php";
}
else{
    include "giris.php";
}
?>
<head>
    <style>
        .alert {
            padding: 20px;
            border-radius: 30px;
            background-color: #f44336;
            color: white;
        }

        .basari {
            padding: 20px;
            border-radius: 30px;
            background-color: green;
            color: white;
        }
    </style>
</head>
