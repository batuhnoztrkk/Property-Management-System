<?php
!defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
if (isset($_GET['ilanno'])){
    $item = $DB_connect->prepare('SELECT * FROM ilanlar WHERE id = :id');
    $item->execute(array(':id' => $_GET['ilanno']));
    $itemcount = $item->rowCount();
    if (!$itemcount){
        header("Refresh:2; url=Ilanlar");
        die("İlan bulunamadı veya yayından kaldırılmış.");
    }
    $itemresult = $item->fetch(PDO::FETCH_ASSOC);
    $resimler = $itemresult['resim'];
    $anaresim = explode(",", $resimler);

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
        if ($_FILES['resim']['name'][0] != "") {
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
            $resim = implode(",", $resimdizi);
        }
        else{
            $resim = $itemresult['resim'];
        }
        $register = $DB_connect->prepare("UPDATE `ilanlar` SET `ekategori`= :ekategori,`edurum`=:edurum,`baslik`=:baslik,`htmlcode`=:htmlcode,`fiyat`=:fiyat,`brutm2`=:brutm2,`netm2`=:netm2,`odasayi`=:odasayi,`binayasi`=:binayasi,`bulundugukat`=:bulundugukat,`katsayisi`=:katsayisi,`isitma`=:isitma,`banyosayisi`=:banyosayisi,`balkon`=:balkon,`esyali`=:esyali,`aidat`=:aidat,`il`=:il,`ilce`=:ilce,`mahalle`=:mahalle,`sokak`=:sokak,`resim`=:resim,`googleharita`=:googleharita WHERE id = :id");
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
        $register->bindParam(':id', $_GET['ilanno']);
        if ($register->execute()){
            if (isset($yuklenemeyenler)){
                if (count($yuklenemeyenler) > 0) {
                    echo "Aşağıdaki Resimler Yüklenemedi. <br />";
                    var_dump($yuklenemeyenler);
                    echo "İlan güncellendi";
                    header('refresh:2');
                }
                else {
                    echo "İlan Başarıyla Yayınlandı!";
                    header('refresh:2');
                }
            }
            else{
                echo "İlan Başarıyla Yayınlandı!";
                header('refresh:2');
            }

        }
        else{
            echo "İlan yüklenirken bir sorun oluştu daha sonra tekrar deneyiniz ve 0507 569 1340 ile iletişime geçiniz!";
            header('refresh:2');
        }
    }

}
else{
    header("Refresh:2; url=Ilan_Duzenle");
    die("İlan bulunamadı veya zaten yayından kaldırılmış.");
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

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
                            Emlak Kategori
                            <select class="form-control" name="ekategori" id="ekategori" required>
                                <option
                                    <?php
                                    if ($itemresult['ekategori'] == "Konut"){
                                        echo "selected";
                                    }
                                    ?>
                                        value="Konut">Konut</option>
                                <option <?php
                                        if ($itemresult['ekategori'] == "İş Yeri"){
                                            echo "selected";
                                        }
                                        ?>value="İş Yeri">İş Yeri</option>
                                <option <?php
                                        if ($itemresult['ekategori'] == "Arsa"){
                                            echo "selected";
                                        }
                                        ?>value="Arsa">Arsa</option>
                                <option <?php
                                        if ($itemresult['ekategori'] == "Bina"){
                                            echo "selected";
                                        }
                                        ?>value="Bina">Bina</option>
                                <option <?php
                                        if ($itemresult['ekategori'] == "Turistik Tesis"){
                                            echo "selected";
                                        }
                                        ?>value="Turistik Tesis">Turistik Tesis</option>
                            </select>
                        </div>
                        <div class="card-body">
                            Emlak Durum
                            <select class="form-control" name="edurum" id="edurum" required>
                                <option <?php
                                if ($itemresult['edurum'] == "Satılık"){
                                    echo "selected";
                                }
                                ?> value="Satılık">Satılık</option>
                                <option <?php
                                if ($itemresult['edurum'] == "Kiralık"){
                                    echo "selected";
                                }
                                ?> value="Kiralık">Kiralık</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test" hidden>
                <?=$itemresult['htmlcode']?>
            </div>
            <strong>İlan Detayları</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            İlan Başlığı
                            <input type="text" class="form-control" id="baslik" name="baslik" value="<?=$itemresult['baslik']?>" required>
                        </div>
                        <div class="card-body">
                                <div class="text-center">
                                    <h5>Açıklama</h5>

                                        <input name="htmlcode" id="inp_htmlcode" type="hidden" />


                                        <div id="div_editor1" class="richtexteditor" style="width: 960px;margin:0 auto;">
                                        </div>

                                        <script type="text/javascript">
                                            var test = $(".test").html();
                                            var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
                                            editor1.attachEvent("change", function () {
                                                document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
                                            });
                                            editor1.setHTMLCode(test);
                                        </script>
                                </div>
                        </div>
                        <div class="card-body">
                            Fiyat
                            <input type="text" class="form-control" id="fiyat" name="fiyat" value="<?=$itemresult['fiyat']?>" required>
                        </div>
                        <div class="card-body">
                            m² (Brüt)
                            <input type="text" class="form-control" id="brütm2" name="brütm2" value="<?=$itemresult['brutm2']?>" required>
                        </div>
                        <div class="card-body">
                            m² (Net)
                            <input type="text" class="form-control" id="netm2" name="netm2" value="<?=$itemresult['netm2']?>" required>
                        </div>
                        <div class="card-body">
                            Oda Sayısı
                            <input type="text" class="form-control" id="odasayi" name="odasayi" value="<?=$itemresult['odasayi']?>" required>
                        </div>
                        <div class="card-body">
                            Bina Yaşı
                            <input type="text" class="form-control" id="binayasi" name="binayasi" value="<?=$itemresult['binayasi']?>" required>
                        </div>
                        <div class="card-body">
                            Bulunduğu Kat
                            <input type="text" class="form-control" id="bulundugukat" name="bulundugukat" value="<?=$itemresult['bulundugukat']?>" required>
                        </div>
                        <div class="card-body">
                            Kat Sayısı
                            <input type="text" class="form-control" id="katsayisi" name="katsayisi" value="<?=$itemresult['katsayisi']?>" required>
                        </div>
                        <div class="card-body">
                            Isıtma
                            <input type="text" class="form-control" id="isitma" name="isitma" value="<?=$itemresult['isitma']?>" required>
                        </div>
                        <div class="card-body">
                            Banyo Sayısı
                            <input type="text" class="form-control" id="banyosayisi" name="banyosayisi" value="<?=$itemresult['banyosayisi']?>" required>
                        </div>
                        <div class="card-body">
                            Balkon
                            <input type="text" class="form-control" id="balkon" name="balkon" value="<?=$itemresult['balkon']?>" required>
                        </div>
                        <div class="card-body">
                            Eşyalı
                            <input type="text" class="form-control" id="esyali" name="esyali" value="<?=$itemresult['esyali']?>" required>
                        </div>
                        <div class="card-body">
                            Aidat (TL)
                            <input type="text" class="form-control" id="aidat" name="aidat" value="<?=$itemresult['aidat']?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <strong>Adres Bilgisi</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            İl
                            <select name="il" id="il" class="form-control"required>
                                <option value="<?=$itemresult['il']?>" selected ><?=$itemresult['il']?></option>
                            </select>
                        </div>
                        <div class="card-body">
                            İlçe
                            <select name="ilce" id="ilce" class="form-control" required>
                                <option value="<?=$itemresult['ilce']?>" selected><?=$itemresult['ilce']?></option>
                            </select>
                        </div>
                        <div class="card-body">
                            Mahalle
                            <select name="mahalle" id="mahalle" class="form-control" required>
                                <option value="<?=$itemresult['mahalle']?>" selected hidden><?=$itemresult['mahalle']?></option>
                            </select>
                        </div>
                        <div class="card-body">
                            Sokak, Dış kapı no, İç kapı no
                            <input type="text" class="form-control" id="sokak" name="sokak" value="<?=$itemresult['sokak']?>" required>
                        </div>
                        <div class="card-body">
                            Google harita üzerindeki konumu
                            <input type="text" class="form-control" id="googleharita" name="googleharita" value='<?=$itemresult['googleharita']?>' required>
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
            <strong>Fotoğraf Düzenleyin</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            Yeni bir resim eklerseniz diğer tüm resimler otomatik olarak silinir. Ekleme veya çıkarma yapmak için tüm resimleri yükleyiniz. Düzenleme yapmak istemiyorsanız boş bırakınız.
                            <input class="form-control" type="file" name="resim[]" multiple="multiple" accept="image/*"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <input type="submit" name="ekle" id="ekle" class="form-control" value="İlanı Düzenle">
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
            ajaxFunc("ilce", $(il).val(), "#ilce");
            ajaxFunc("mahalle", $(ilce).val(), "#mahalle");

            $("#il").on("change", function(){

                $("#ilce").attr("disabled", false).html("<option value='' selected hidden>İlçe Seçiniz..</option>");
                $("#mahalle").attr("disabled", false).html("<option value='' selected hidden>Mahalle Seçiniz..</option>");
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























