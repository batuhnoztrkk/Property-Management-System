<?php
!defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
if (isset($_POST['ekle'])){
    $ekategori = $_POST['ekategori'];
    $edurum = $_POST['edurum'];
    $baslik = $_POST['baslik'];
    $htmlcode = $_POST['htmlcode'];
    $fiyat = $_POST['fiyat'];
    $brütm2 = $_POST['brütm2'];
    $netm2 = $_POST['netm2'];
    $odasayi = $_POST['odasayi'];
    $binayasi = $_POST['binayasi'];
    $bulundugukat = $_POST['bulundugukat'];
    $katsayisi = $_POST['katsayisi'];
    $isitma = $_POST['isitma'];
    $banyosayisi = $_POST['banyosayisi'];
    $balkon = $_POST['balkon'];
    $esyali = $_POST['esyali'];
    $aidat = $_POST['aidat'];
    $il = $_POST['il'];
    $ilce = $_POST['ilce'];
    $mahalle = $_POST['mahalle'];
    $sokak = $_POST['sokak'];
    $googleharita = $_POST['googleharita'];
    $resimdizi = array();
    $status = 1;
    if (isset($_FILES['resim'])) {
        $yuklenemeyenler = array(); //yüklenemeyen ve hatası dönen resimleri bu dizide tutacağız.
        $klasor = "../assets/ilanresim"; //yükleyeceğimiz klasörü belirledik.
        $resim_sayisi = count($_FILES['resim']['name']); //kaç tane resim geldiğini öğrendik.
        for ($i = 0; $i < $resim_sayisi; $i++) {
            //resim sayısı kadar döngüye soktuk.
            $resimBoyutu = $_FILES['resim']['size'][$i]; //döngü içerisindeki resmin boyutunu öğrendik.
            if ($resimBoyutu > (1024 * 1024 * 20)) {
                $yuklenemeyenler[] = $_FILES['resim']['name'][$i] . " - BOYUT SEBEBİYLE YÜKLENMEDİ";
            } else {
                $dosyaUzantisi = substr($_FILES["resim"]["name"][$i], -4, 4);
                $dosyaAdi = rand(1, 99999999999999) . $dosyaUzantisi;
                $tip = $_FILES['resim']['type'][$i]; //resim tipini öğrendik.
                $resimAdi = $_FILES['resim']['name'][$i]; //resmin adını öğrendik.

                if ($tip == 'image/jpeg' || $tip == 'image/jpg' || $tip == 'image/png') { //uzantısnın kontrolünü sağladık. sadece .jpg ve .png yükleyebilmesi için.
                    if (move_uploaded_file($_FILES["resim"]["tmp_name"][$i], $klasor . "/" . $dosyaAdi)) {
                        array_push($resimdizi, $dosyaAdi);
                    } else $yuklenemeyenler[] = $_FILES['resim']['name'][$i] . " BİLİNMEYEN SEBEPLERDEN DOLAYI YÜKLENMEDİ";
                } else {
                    $yuklenemeyenler[] = $_FILES['resim']['name'][$i] . " JPEG/JPG/PNG FORMATINDA DEĞİL";
                }
            }
        }
    }
    $resim = implode(",", $resimdizi);
    $register = $DB_connect->prepare("INSERT INTO ilanlar (`status`, `ekategori`, `edurum`, `baslik`, `htmlcode`, `fiyat`, `brutm2`, `netm2`, `odasayi`, `binayasi`, `bulundugukat`, `katsayisi`, `isitma`, `banyosayisi`, `balkon`, `esyali`, `aidat`, `il`, `ilce`, `mahalle`, `sokak`, `resim`, `googleharita`) VALUES
                                                           (:status, :ekategori, :edurum, :baslik, :htmlcode, :fiyat, :brutm2, :netm2, :odasayi, :binayasi, :bulundugukat, :katsayisi, :isitma, :banyosayisi, :balkon, :esyali, :aidat, :il, :ilce, :mahalle, :sokak, :resim, :googleharita)");
    $register->bindParam(':status', $status);
    $register->bindParam(':ekategori', $ekategori);
    $register->bindParam(':edurum', $edurum);
    $register->bindParam(':baslik', $baslik);
    $register->bindParam(':htmlcode', $htmlcode);
    $register->bindParam(':fiyat', $fiyat);
    $register->bindParam(':brutm2', $brütm2);
    $register->bindParam(':netm2', $netm2);
    $register->bindParam(':odasayi', $odasayi);
    $register->bindParam(':binayasi', $binayasi);
    $register->bindParam(':bulundugukat', $bulundugukat);
    $register->bindParam(':katsayisi', $katsayisi);
    $register->bindParam(':isitma', $isitma);
    $register->bindParam(':banyosayisi', $banyosayisi);
    $register->bindParam(':balkon', $balkon);
    $register->bindParam(':esyali', $esyali);
    $register->bindParam(':aidat', $aidat);
    $register->bindParam(':il', $il);
    $register->bindParam(':ilce', $ilce);
    $register->bindParam(':mahalle', $mahalle);
    $register->bindParam(':sokak', $sokak);
    $register->bindParam(':resim', $resim);
    $register->bindParam(':googleharita', $googleharita);
    if ($register->execute()){
        if (count($yuklenemeyenler) > 0) {
            echo "Aşağıdaki Resimler Yüklenemedi. <br />";
            var_dump($yuklenemeyenler);
            echo "İlan Yayınlandı!";
        }
        else {
            echo "İlan Başarıyla Yayınlandı!";
        }
    }
    else{
        echo "İlan yüklenirken bir sorun oluştu daha sonra tekrar deneyiniz!";
    }
}
?>
<link rel="stylesheet" href="../assets/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../assets/richtexteditor/rte.js"></script>
<script type="text/javascript" src='../assets/richtexteditor/plugins/all_plugins.js'></script>
<div class="main-panel">
    <form method="post" enctype="multipart/form-data">
        <div class="content-wrapper">
            <strong>İlan Kategori</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <select class="form-control" name="ekategori" id="ekategori" required>
                                <option selected="" disabled>Emlak Kategorisi</option>
                                <option value="Konut">Konut</option>
                                <option value="İş Yeri">İş Yeri</option>
                                <option value="Arsa">Arsa</option>
                                <option value="Bina">Bina</option>
                                <option value="Turistik Tesis">Turistik Tesis</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <select class="form-control" name="edurum" id="edurum" required>
                                <option selected="" disabled>Emlak Durumu</option>
                                <option value="Satılık">Satılık</option>
                                <option value="Kiralık">Kiralık</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <strong>İlan Detayları</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control" id="baslik" name="baslik" placeholder="İlan Başlığı" required>
                        </div>
                        <div class="card-body">
                                <div class="text-center">
                                    <h5>Açıklama</h5>

                                        <input name="htmlcode" id="inp_htmlcode" type="hidden" />


                                        <div id="div_editor1" class="richtexteditor" style="width: 960px;margin:0 auto;">
                                        </div>

                                        <script>
                                            var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
                                            editor1.attachEvent("change", function () {
                                                document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
                                            });
                                        </script>
                                </div>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="fiyat" name="fiyat" placeholder="Fiyat" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="brütm2" name="brütm2" placeholder="m² (Brüt)" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="netm2" name="netm2" placeholder="m² (Net)" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="odasayi" name="odasayi" placeholder="Oda Sayısı (x+x)" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="binayasi" name="binayasi" placeholder="Bina Yaşı" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="bulundugukat" name="bulundugukat" placeholder="Bulunduğu Kat" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="katsayisi" name="katsayisi" placeholder="Kat Sayısı" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="isitma" name="isitma" placeholder="Isıtma" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="banyosayisi" name="banyosayisi" placeholder="Banyo Sayısı" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="balkon" name="balkon" placeholder="Balkon" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="esyali" name="esyali" placeholder="Eşyalı?" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="aidat" name="aidat" placeholder="Aidat" required>
                        </div>
                    </div>
                </div>
            </div>
            <strong>Adres Bilgisi</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <select name="il" id="il" class="form-control"required>
                                <option value="" selected hidden>İl Seçiniz..</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <select name="ilce" id="ilce" class="form-control" disabled="disabled" required>
                                <option value="" selected hidden>İlçe Seçiniz..</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <select name="mahalle" id="mahalle" class="form-control" disabled="disabled" required>
                                <option value="" selected hidden>Mahalle Seçiniz..</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="sokak" name="sokak" placeholder="Sokak, Dış Kapı no, İç Kapı no" required>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" id="googleharita" name="googleharita" placeholder="Google Harita Üzerindeki Konumu" required>
                        </div>
                        Google Harita Üzerinden Konum Nasıl Alınır? Eğitici video için izleyin=>
                        <center>
                        <video width="560" height="420" controls="controls">
                            <source src="../assets/emlakharitaekleme.mp4" type="video/mp4" />
                        </video>
                        </center>
                    </div>
                </div>
            </div>
            <strong>Fotoğraf Ekleyin</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <input class="form-control" type="file" name="resim[]" multiple="multiple" accept="image/*"/ required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <input type="submit" name="ekle" id="ekle" class="form-control" value="İlanı Ekle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>

        $(document).ready(function(){
            ajaxFunc("il", "", "#il");

            $("#il").on("change", function(){

                $("#ilce").attr("disabled", false).html("<option value='' selected hidden>İlçe Seçiniz..</option>");
                console.log($(this).val());
                ajaxFunc("ilce", $(this).val(), "#ilce");

            });

            $("#ilce").on("change", function(){

                $("#mahalle").attr("disabled", false).html("<option value='' selected hidden>Mahalle Seçiniz..</option>");
                console.log($(this).val());
                ajaxFunc("mahalle", $(this).val(), "#mahalle");

            });

            function ajaxFunc(action, name, id ){
                $.ajax({
                    url: "ajax.php",
                    type: "POST",
                    data: {action:action, name:name},
                    success: function(sonuc){
                        $.each($.parseJSON(sonuc), function(index, value){
                            var row="";
                            row +='<option value="'+value+'">'+value+'</option>';
                            $(id).append(row);
                        });
                    }});
            }
        });
    </script>























