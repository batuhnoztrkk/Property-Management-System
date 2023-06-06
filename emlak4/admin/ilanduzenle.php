<?php
!defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
?>
<link rel="stylesheet" href="../assets/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="../assets/richtexteditor/rte.js"></script>
<script type="text/javascript" src='../assets/richtexteditor/plugins/all_plugins.js'></script>
<div class="main-panel">
    <form method="post" enctype="multipart/form-data">
        <div class="content-wrapper">
            <strong>İlan Düzenle</strong>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">İlan No</th>
                                    <th scope="col">Mini Resim</th>
                                    <th scope="col">İlan Başlığı</th>
                                    <th scope="col">Fiyat</th>
                                    <th scope="col">İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $item = $DB_connect->prepare('SELECT * FROM ilanlar');
                                $item->execute();
                                $itemcount = $item->rowCount();
                                if ($itemcount){
                                    while ($itemresult = $item->fetch(PDO::FETCH_ASSOC)){
                                            $resimler = $itemresult['resim'];
                                            $anaresim = explode(",", $resimler);
                                ?>
                                <tr>
                                    <th scope="row"><?=$itemresult['id']?></th>
                                    <td><img src="../assets/ilanresim/<?=$anaresim[0]?>" alt=""></td>
                                    <td><?=$itemresult['baslik']?></td>
                                    <td><?=$itemresult['fiyat']?> TL</td>
                                    <td><?php
                                        if ($itemresult['status'] == 1){
                                            ?>
                                            <a href="yayindankaldir?ilanno=<?=$itemresult['id']?>">Yayından Kaldır</a>
                                            <a href="duzenle?ilanno=<?=$itemresult['id']?>">Düzenle</a>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="yayinla?ilanno=<?=$itemresult['id']?>">Yayınla</a>
                                            <?php
                                        }
                                        ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
























