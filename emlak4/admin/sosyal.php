<?php
!defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
if (isset($_POST['degistir'])){
    $telnosu = $_POST['telno'];
    $mail = $_POST['mail'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $adres = $_POST['adres'];

    $register = $DB_connect->prepare("UPDATE sitesettings SET telno = :telno, mail = :mail, facebook = :facebook, twitter = :twitter, instagram = :instagram, linkedin = :linkedin, adres = :adres WHERE id = 8");
    $register->bindParam(':telno', $telnosu);
    $register->bindParam(':mail', $mail);
    $register->bindParam(':facebook', $facebook);
    $register->bindParam(':twitter', $twitter);
    $register->bindParam(':instagram', $instagram);
    $register->bindParam(':linkedin', $linkedin);
    $register->bindParam(':adres', $adres);
    if ($register->execute()) {
        echo "<h2>Başarılı</h2>";
        header("refresh: 2");
    } else {
        echo "<h2>Hata</h2>";
    }
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">

                <?php
                $item = $DB_connect->prepare('SELECT * FROM sitesettings');
                $item->execute();
                $itemresult = $item->fetch(PDO::FETCH_ASSOC);
                $telnosu = $itemresult['telno'];
                $mail = $itemresult['mail'];
                $facebook = $itemresult['facebook'];
                $twitter = $itemresult['twitter'];
                $instagram = $itemresult['instagram'];
                $linkedin = $itemresult['linkedin'];
                $adres = $itemresult['adres'];
                ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sosyal Medya & Telefon & Mail Değiştir</h4>
                        <form  method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Telefon Numarası:</label>
                                <input type="text" name="telno" value="<?=$telnosu?>">
                            </div>
                            <div class="form-group">
                                <label>Mail Adres:</label>
                                <input type="text" name="mail" value="<?=$mail?>">
                            </div>
                            <div class="form-group">
                                <label>Facebook:</label>
                                <input type="text" name="facebook" value="<?=$facebook?>">
                            </div>
                            <div class="form-group">
                                <label>Twitter:</label>
                                <input type="text" name="twitter" value="<?=$twitter?>">
                            </div>
                            <div class="form-group">
                                <label>İnstagram:</label>
                                <input type="text" name="instagram" value="<?=$instagram?>">
                            </div>
                            <div class="form-group">
                                <label>Linkedin:</label>
                                <input type="text" name="linkedin" value="<?=$linkedin?>">
                            </div>
                            <div class="form-group">
                                <label>Adres:</label>
                                <input type="text" name="adres" value="<?=$adres?>">
                            </div>
                    </div>
                    <input type="submit" class="btn btn-primary mr-2" name="degistir" id="degistir" value="Değiştir">
                    </form>
                </div>
            </div>
        </div>
    </div>