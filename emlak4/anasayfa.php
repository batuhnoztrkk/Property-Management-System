<?php !defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null;
    if (isset($_POST['ara'])){
        $ekategori = $_POST['ekategori'];
        $edurum = $_POST['edurum'];
        $danisman = $_POST['danisman'];
        header("location:Ilanlar?ekategori=$ekategori&edurum=$edurum&$danisman");
    }
?>
<section class="w3l-cover-3">
		<div class="cover top-bottom">
			<div class="container">
				<div class="middle-section text-center">
					<div class="section-width">
						<p>Bütçeye en uygun temiz evler burada!</p>
						<h2>Bugün bir mülk bulun</h2>
						<div class="most-searches">
							<h4>En Çok Arananlar</h4>
							<ul>
								<li><a href="Ilanlar?ekategori=Konut">Konut</a></li>
								<li><a href="Ilanlar?edurum=Satilik">Satılık</a></li>
								<li><a href="Ilanlar?edurum=Kiralik">Kiralık</a></li>
							</ul>
						</div>
						<form class="w3l-cover-3-gd" method="post">
							<span class="input-group-btn">
								<select class="btn btn-default" name="ekategori" id="ekategori" required>
									<option selected="" disabled>Emlak Kategorisi</option>
                                    <option value="Hepsi">Hepsi</option>
									<option value="Konut">Konut</option>
                                    <option value="Is_Yeri">İş Yeri</option>
                                    <option value="Arsa">Arsa</option>
                                    <option value="Bina">Bina</option>
                                    <option value="Turistik_Tesis">Turistik Tesis</option>
								</select>
							</span>
							<span class="input-group-btn">
								<select class="btn btn-default" name="edurum" id="edurum" required>
									<option selected="" disabled>Emlak Durumu</option>
                                    <option value="Hepsi">Hepsi</option>
									<option value="Satilik">Satılık</option>
                                    <option value="Kiralik">Kiralık</option>
								</select>
							</span>
							<span class="input-group-btn">
								<select class="btn btn-default" name="danisman" id="danisman" required>
									<option selected="" disabled>Danışman</option>
									<option value="bo">Batuhan Öztürk</option>
								</select>
							</span>
                            <input type="submit" name="ara" id="ara" class="btn-primary" style="width: 250px;" value="Ara">
						</form>
					</div>
					<section id="bottom" class="demo">
						<a href="#bottom"><span></span>Tıkla</a>
					</section>
				</div>
			</div>
		</div>
	</section>
<section class="locations-1" id="locations">
    <div class="locations py-5">
        <div class="container py-lg-5 py-md-4 py-2">
            <div class="heading text-center mx-auto">
                <h3 class="title-big">Mülkler</h3>
            </div>
            <div class="row pt-md-5 pt-4">
                <?php
                    $item = $DB_connect->prepare('SELECT * FROM ilanlar ORDER BY id DESC');
                    $item->execute();
                    $itemcount = $item->rowCount();
                    if ($itemcount){
                        while ($itemresult = $item->fetch(PDO::FETCH_ASSOC)){
                            if ($itemresult['status'] == 1){
                                $resimler = $itemresult['resim'];
                                $anaresim = explode(",", $resimler);
                ?>
                <div class="col-lg-4 col-md-6">
                    <a href="Ilandetay?ilanno=<?=$itemresult['id']?>">
                        <div class="box16">
                            <div class="rentext-listing-category"><span><?=$itemresult['edurum']?></span></div>
                            <img class="img-fluid" src="assets/ilanresim/<?=$anaresim[0]?>" alt="">
                            <div class="box-content">
                                <h3 class="title"><?=$itemresult['fiyat']?> TL</h3>
                                <span class="post"><?=$itemresult['il']?> / <?=$itemresult['ilce']?> / <?=$itemresult['mahalle']?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="w3l-index3" id="about">
    <div class="midd-w3 pb-5">
        <div class="container pb-lg-5 pb-md-4 pb-2">
            <div class="row">
                <div class="col-lg-5 pr-lg-0">
                    <div class="w3l-left-img">
                    </div>
                </div>
                <div class="col-lg-7 pl-lg-0">
                    <div class="w3l-right-info">
                        <h6 class="title-small">Biz Kimiz?</h6>
                        <h3 class="title-big">Yerel ve uluslararası emlak uzmanları</h3>
                        <p class="mt-4">15 yıldan fazla deneyime sahibiz, 70'den fazla sektörde 20.000'den fazla kişi bizim için çalışıyor.
                            tüm dünyada ülkeler. İşimiz hakkında daha fazla bilgi edinin!
                        </p>
                        <ul class="w3l-right-book w3l-right-book-grid mt-md-5 mt-4">
                            <li><span class="fa fa-check" aria-hidden="true"></span>Olağanüstü mülk</li>
                            <li><span class="fa fa-check" aria-hidden="true"></span>Sosyal Güvenirlik</li>
                            <li><span class="fa fa-check" aria-hidden="true"></span>Uzman tavsiyesi alın</li>
                            <li><span class="fa fa-check" aria-hidden="true"></span>Grup yapısı</li>
                            <li><span class="fa fa-check" aria-hidden="true"></span>Uzman hizmetler</li>
                            <li><span class="fa fa-check" aria-hidden="true"></span>Vizyon ve strateji</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /bottom-grids-->
<section class="w3l-bottom-grids py-5" id="steps">
    <div class="container py-lg-5 py-md-4 py-2">
        <div class="grids-area-hny main-cont-wthree-fea row">
            <div class="col-lg-4 col-md-6 grids-feature">
                <div class="area-box no-box-shadow">
                    <span class="fa fa-home"></span>
                    <h4><a href="#feature" class="title-head">Ev Satın Al</a></h4>
                    <p>Ev satın alanların %95'i Öztürk Emlaktan memnun kalıyor!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-md-0 mt-4">
                <div class="area-box no-box-shadow">
                    <span class="fa fa-home"></span>
                    <h4><a href="#feature" class="title-head">Ev Kiralayın</a></h4>
                    <p>Kiracılar ile iletişimde kalan ve her yardımına koşan bir emlakçı!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-lg-0 mt-4">
                <div class="area-box no-box-shadow">
                    <span class="fa fa-building-o"></span>
                    <h4><a href="#feature" class="title-head">Mahalleleri Görün</a></h4>
                    <p>Mahalleler, yaşayız tarzı, idoloji gibi bir çok bilgiyi emlak ofisimize gelip bilgi alabilirsiniz!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="w3l-index3" id="about">
    <div class="midd-w3 py-5">
        <div class="container pb-lg-5 pb-md-4 pb-2">
            <div class="row">
                <div class="col-lg-5 pr-lg-0">
                    <div class="w3l-left-img1">
                    </div>
                </div>
                <div class="col-lg-7 pl-lg-0">
                    <div class="w3l-right-info">
                        <h6 class="title-small">Müşterilerimiz</h6>
                        <div class="client-grid">
                            <div class="client-title">
                                <h3 class="title-big">Müşteri ilişkilerine değer veriyoruz.</h3>
                            </div>
                            <div class="clients-info">
                                <h3 class="title-big">45,200</h3>
                                <p>Memnun Müşteriler</p>
                            </div>
                        </div>

                        <div class="w3l-clients" id="testimonials">
                            <div id="owl-demo1" class="owl-carousel owl-theme mt-4 pt-2 mb-4">
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial">
                                            <div class="testi-des">
                                                <div class="peopl align-self">
                                                    <h4>Kübra Gülal</h4>
                                                    <p class="indentity">İletişim Yöneticisi</p>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <q>AMAN TANRIM! Bundan sonra yeni bir özel evim olduğuna inanamıyorum.
                                                    villa almak. Çok rahattı. Emlak hakkında ne söylesem az.</q>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial">
                                            <div class="testi-des">
                                                <div class="peopl align-self">
                                                    <h4>Muhammet Kayabaş</h4>
                                                    <p class="indentity">Dijital Pazarlamacı</p>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <q>Dijital pazarlamacı olarak kendime en uygun evi seçtik ve çok hızlı
                                                bir şekilde satış işlemlerini gerçekleştirdik. MÜKEMMEL!</q>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial">
                                            <div class="testi-des">
                                                <div class="peopl align-self">
                                                    <h4>Osman Canbazoğlu</h4>
                                                    <p class="indentity">Web Developer</p>
                                                </div>
                                            </div>
                                            <blockquote>
                                                <q>Bir yazılımcı evi arıyordum. İsteğime en uygun evi anında bana gösterdi ve hemen eve gittik.
                                                Bu kadar kısa sürede evi beğenip alacağımı düşünmüyordum.</q>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /bottom-grids-->
<section class="w3l-bottom-grids py-5" id="steps">
    <div class="container py-lg-5 py-md-4 py-2">
        <div class="grids-area-hny main-cont-wthree-fea row">
            <div class="col-lg-4 col-md-6 grids-feature">
                <div class="area-box no-box-shadow text-left">
                    <span class="fa fa-search-plus"></span>
                    <h5>Hepsi Tek Yerde</h5>
                    <h4><a href="#feature" class="title-head">Hayalinizdeki Evi Bulabileceğiniz Tek Nokta</a></h4>
                    <p>Hemen hayalindeki evi bulmak için bize ulaşın!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-md-0 mt-4">
                <div class="area-box no-box-shadow text-left">
                    <span class="fa fa-user-o"></span>
                    <h5>Bir Aracıya Bağlanın</h5>
                    <h4><a href="#feature" class="title-head">Ücretsiz, Zorunlu Olmayan Bir Randevu Planlayın</a></h4>
                    <p>Planlanan randevu süresince sizinle hayalinizdeki ev için ilgileneceğiz.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 grids-feature mt-lg-0 mt-4">
                <div class="area-box no-box-shadow text-left">
                    <span class="fa fa-home"></span>
                    <h5>Bir ev değerlemesi alın</h5>
                    <h4><a href="#feature" class="title-head">Mülkünüzün Değerini Anlayın</a></h4>
                    <p>Mülkün değerine en yakın fiyatlarda satış işlemini gerçekleştirin.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //bottom-grids-->

<section class="w3l-companies-hny-6 py-5">
    <!-- /grids -->
        <div class="container py-md-3">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 column">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client1.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client2.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-md-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client3.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client4.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client5.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client6.png" alt="client"> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- //grids -->
</section>
