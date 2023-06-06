<?php !defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Öztürk Emlak - Kütahya En İyi Emlak Danışmanı/Gayrimenkül Sitesi</title>

    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/b289c49d7e.js" crossorigin="anonymous"></script>
</head>
<body>

<!--header-->
<header id="site-header" class="fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg stroke px-0">
            <h1> <a class="navbar-brand" href="Anasayfa">
                    <span class="fa fa-home"></span> Öztürk Emlak
                </a></h1>
            <!-- if logo is image enable this
    <a class="navbar-brand" href="#index.html">
        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
    </a> -->
            <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-lg-5 mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="Anasayfa">Anasayfa <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown @@pages__active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            İlanlar <span class="fa fa-angle-down"></span>
                        </a>
                        <?php
                        $item = $DB_connect->prepare('SELECT * FROM ilanlar');
                        $item->execute();
                        $itemcount = $item->rowCount();
                        $tum = 0;
                        $konut = 0;
                        $isyeri = 0;
                        $arsa = 0;
                        $bina = 0;
                        $tesis = 0;
                        if ($itemcount) {
                            while ($itemresult = $item->fetch(PDO::FETCH_ASSOC)) {
                                if ($itemresult['ekategori'] == "Konut") {
                                    $konut = $konut + 1;
                                }
                                elseif ($itemresult['ekategori'] == "İş Yeri"){
                                    $isyeri = $isyeri + 1;
                                }
                                elseif ($itemresult['ekategori'] == "Arsa"){
                                    $arsa = $arsa + 1;
                                }
                                elseif ($itemresult['ekategori'] == "Bina"){
                                    $bina = $bina + 1;
                                }
                                elseif ($itemresult['ekategori'] == "Turistik Tesis"){
                                    $tesis = $tesis + 1;
                                }
                            }
                        }
                        $tum = $konut + $isyeri + $arsa + $bina + $tesis;
                        ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @@contact__active" href="Ilanlar">Tüm İlanlar [<?=$tum?>]</a>
                            <a class="dropdown-item @@contact__active" href="Ilanlar?ekategori=Konut">Konut [<?=$konut?>]</a>
                            <a class="dropdown-item @@contact__active" href="Ilanlar?ekategori=Is_Yeri">İş Yeri [<?=$isyeri?>]</a>
                            <a class="dropdown-item @@about__active" href="Ilanlar?ekategori=Arsa">Arsa [<?=$arsa?>]</a>
                            <a class="dropdown-item @@about__active" href="Ilanlar?ekategori=Bina">Bina [<?=$bina?>]</a>
                            <a class="dropdown-item @@about__active" href="Ilanlar?ekategori=Turistik_Tesis">Turistik Tesis [<?=$tesis?>]</a>
                        </div>
                    </li>
                    <li class="nav-item @@listing__active">
                        <a class="nav-link" href="Hakkimizda">Hakkımızda</a>
                    </li>
                    <li class="nav-item @@listing__active">
                        <a class="nav-link" href="Iletisim">İletişim</a>
                    </li>

                </ul>

            </div>

            <!-- toggle switch for light and dark theme -->
            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>
            <!-- //toggle switch for light and dark theme -->
        </nav>
    </div>
</header>
<!--/header-->