<?php !defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
if (isset($_GET['ilanno'])){
    $item = $DB_connect->prepare('SELECT * FROM ilanlar WHERE id = :id');
    $item->execute(array(':id' => $_GET['ilanno']));
    $itemcount = $item->rowCount();
    if (!$itemcount){
        header("Refresh:2; url=Ilanlar");
        die("İlan bulunamadı veya yayından kaldırılmış.");
    }
    $itemresult = $item->fetch(PDO::FETCH_ASSOC);
    if ($itemresult['status'] == 0){
        header("Refresh:2; url=Ilanlar");
        die("Bu ilan satılmış veya yayından kaldırılmış!");
    }
    $newDate = date("d/m/Y", strtotime($itemresult['tarih']));

    $resimler = $itemresult['resim'];
    $anaresim = explode(",", $resimler);
}
else{
    header("Refresh:2; url=Ilanlar");
    die("İlan bulunamadı veya yayından kaldırılmış.");
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
            <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span><a href="Ilanlar">İlanlar</a> </li>
            <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> İlan Detayı</li>
        </ul>
    </div>
</section>
<!--/blog-post-->
<section class="w3l-blog post-content py-5">
    <div class="container py-lg-4 py-md-3 py-2">
        <div class="inner mb-4">
            <ul class="blog-single-author-date align-items-center">
                <li>
                    <div class="listing-category"><span><?=$itemresult['edurum']?></span></div>
                </li>
                <li><span class="fa fa-clock-o"></span><?=" ".$newDate?></li>
            </ul>
        </div>
        <div class="post-content">
            <h2 class="title-single"><?=$itemresult['baslik']?></h2>
        </div>
        <div class="blo-singl mb-4">
            <ul class="blog-single-author-date align-items-center">
                <li>
                    <p><?=$itemresult['mahalle'].", ".$itemresult['ilce'].", ".$itemresult['il']?></p>
                </li>
                <li><span class="fa-solid fa-house"></span><?="  ".$itemresult['odasayi']?></li>
                <li><span class="fa-solid fa-share-from-square"></span><?="  ".$itemresult['netm2']?> m²</li>
                <li><span class="fa-solid fa-calendar"></span><?="  ".$newDate?></li>
            </ul>
            <ul class="share-post">
                <a href="#url" class="cost-estate m-o"><?=$itemresult['fiyat']?> TL</a>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-8 w3l-news">
                <div class="blog-single-post">
                    <div class="single-post-image mb-5">
                        <div class="owl-blog owl-carousel owl-theme">
                            <?php
                            $arraysize = count($anaresim);
                            for ($i = 0; $i < $arraysize; $i++){
                                ?>
                                <div class="item">
                                    <div class="card">
                                        <img src="assets/ilanresim/<?=$anaresim[$i]?>" class="img-fluid radius-image" alt="image" style="height: 500px;">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="single-post-content">
                        <h3 class="post-content-title mb-3">Açıklama</h3>
                        <?=$itemresult['htmlcode']?>
                        <br>
                    </div>

                    <div class="single-bg-white">
                        <h3 class="post-content-title mb-4">Konumu</h3>
                        <div class="agent-map">
                            <?=$itemresult['googleharita']?>
                        </div>
                    </div>

                    <div class="single-bg-white">
                        <h3 class="post-content-title mb-4">Daha Fazla Detay İçin Bizi Arayabilirsiniz!</h3>
                        0507 569 1340
                    </div>

                    <!--<div class="single-bg-white mb-0">
                        <h3 class="post-content-title mb-4">Video</h3>
                        <div class="post-content">
                            <iframe src="https://www.youtube.com/embed/jqP3m3ElcxA" frameborder="0"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
                <aside class="sidebar">

                    <!-- Popular Post Widget-->
                    <div class="sidebar-widget popular-posts">
                        <ul >
                            <li class="form-control"><strong>İlan No :</strong> <?=$itemresult['id']?> </li>
                            <li class="form-control"><strong>İlan Tarihi :</strong> <?=$newDate?> </li>
                            <li class="form-control"><strong>Emlak Tipi :</strong> <?=$itemresult['edurum']." ".$itemresult['ekategori']?> </li>
                            <li class="form-control"><strong>m² (Brüt) :</strong> <?=$itemresult['brutm2']?> </li>
                            <li class="form-control"><strong>m² (Net) :</strong> <?=$itemresult['netm2']?> </li>
                            <li class="form-control"><strong>Oda Sayısı :</strong> <?=$itemresult['odasayi']?> </li>
                            <li class="form-control"><strong>Bina Yaşı :</strong> <?=$itemresult['binayasi']?> </li>
                            <li class="form-control"><strong>Bulunduğu Kat :</strong> <?=$itemresult['bulundugukat']?> </li>
                            <li class="form-control"><strong>Kat Sayısı :</strong> <?=$itemresult['katsayisi']?> </li>
                            <li class="form-control"><strong>Isıtma :</strong> <?=$itemresult['isitma']?> </li>
                            <li class="form-control"><strong>Banyo Sayısı :</strong> <?=$itemresult['banyosayisi']?> </li>
                            <li class="form-control"><strong>Balkon :</strong> <?=$itemresult['balkon']?> </li>
                            <li class="form-control"><strong>Eşyalı :</strong> <?=$itemresult['esyali']?> </li>
                            <li class="form-control"><strong>Aidat (TL) :</strong> <?=$itemresult['aidat']?> </li>
                        </ul>
                    </div>


                </aside>
            </div>
        </div>
    </div>
</section>
<!--//blog-posts-->
