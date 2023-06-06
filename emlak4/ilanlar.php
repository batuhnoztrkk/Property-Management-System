<?php !defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
$ekategori = "";
$edurum = "";
if (isset($_GET['ekategori'])){
    if ($_GET['ekategori'] == "Konut"){
        $ekategori = "Konut";
    }
    elseif ($_GET['ekategori'] == "Is_Yeri"){
        $ekategori = "İş Yeri";
    }
    elseif ($_GET['ekategori'] == "Arsa"){
        $ekategori = "Arsa";
    }
    elseif ($_GET['ekategori'] == "Bina"){
        $ekategori = "Bina";
    }
    elseif ($_GET['ekategori'] == "Turistik_Tesis"){
        $ekategori = "Turistik Tesis";
    }
}
if (isset($_GET['edurum'])){
    if ($_GET['edurum'] == "Satilik"){
        $edurum = "Satılık";
    }
    elseif ($_GET['edurum'] == "Kiralik"){
        $edurum = "Kiralık";
    }
}
?>
<section class="w3l-about-breadcrumb">
    <div class="breadcrumb-bg breadcrumb-bg-about pt-5">
        <div class="container pt-lg-5 py-3">
        </div>
    </div>
</section>
<section class="w3l-breadcrumb">
    <div class="container">
        <ul class="breadcrumbs-custom-path">
            <li><a href="Anasayfa">Anasayfa</a></li>
            <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> İlanlar</li>
        </ul>
    </div>
</section>
<section class="locations-1" id="locations">
    <div class="locations py-5">
        <div class="container py-lg-5 py-md-4 py-2">
            <div class="row">
                <?php
                if ($ekategori == "" && $edurum == ""){
                    $item = $DB_connect->prepare('SELECT * FROM ilanlar ORDER BY tarih DESC');
                    $item->execute();
                }
                elseif (!$ekategori == "" && $edurum == ""){
                    $item = $DB_connect->prepare('SELECT * FROM ilanlar WHERE ekategori = :ekategori ORDER BY tarih DESC');
                    $item->execute(array(':ekategori' => $ekategori));
                }
                elseif ($ekategori == "" && !$edurum == ""){
                    $item = $DB_connect->prepare('SELECT * FROM ilanlar WHERE edurum = :edurum ORDER BY tarih DESC');
                    $item->execute(array(':edurum' => $edurum));
                }
                elseif (!$ekategori == "" && !$edurum == ""){
                    $item = $DB_connect->prepare('SELECT * FROM ilanlar WHERE edurum = :edurum AND ekategori = :ekategori ORDER BY tarih DESC');
                    $item->execute(array(':edurum' => $edurum, ':ekategori' => $ekategori));
                }

                $itemcount = $item->rowCount();
                if ($itemcount){
                    while ($itemresult = $item->fetch(PDO::FETCH_ASSOC)){
                        if ($itemresult['status'] == 1){
                            $resimler = $itemresult['resim'];
                            $anaresim = explode(",", $resimler);
                            $newDate = date("d/m/Y", strtotime($itemresult['tarih']));
                            ?>
                <div class="col-lg-4 col-md-6 listing-img">
                    <a href="Ilandetay?ilanno=<?=$itemresult['id']?>">
                        <div class="box16">
                            <div class="rentext-listing-category"><span><?=$itemresult['edurum']?></span></div>
                            <img class="img-fluid" src="assets/ilanresim/<?=$anaresim[0]?>" alt="">
                            <div class="box-content">
                                <h3 class="title"><?=$itemresult['fiyat']?> TL</h3>
                            </div>
                        </div>
                    </a>
                    <div class="listing-details blog-details align-self">
                        <h4 class="user_title agent">
                            <a href="Ilandetay?ilanno=<?=$itemresult['id']?>"><?=$itemresult['baslik']?></a>
                        </h4>
                        <p class="user_position"><?=$itemresult['mahalle'].", ".$itemresult['ilce'].", ".$itemresult['il']?></p>
                        <ul class="mt-3 estate-info">
                            <li><span class="fa-solid fa-house"></span><?="  ".$itemresult['odasayi']?></li>
                            <li><span class="fa-solid fa-share-from-square"></span><?="  ".$itemresult['netm2']?> m²</li>
                            <li><span class="fa-solid fa-calendar"></span><?="  ".$newDate?></li>

                        </ul>
                        <div class="author align-items-center mt-4">
                            <a href="Ilandetay?ilanno=<?=$itemresult['id']?>" class="comment-img">
                                <img src="assets/images/team1.jpg" alt="" class="img-fluid">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <a href="Ilandetay?ilanno=<?=$itemresult['id']?>">Öztürk Emlak</a>
                                </li>
                                <li class="meta-item blog-lesson">
                                    <span class="meta-value">Emlak Ofisi</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                }
                else{
                    ?>
                    <p class="form-control">Aradığınız kriterlere uygun ilan bulunamamıştır!</p>
                    <?php
                }
                ?>

            </div>

            <!-- //pagination -->
        </div>
    </div>
</section>