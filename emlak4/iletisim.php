<?php !defined('security') ? die('Aradığınız sayfaya ulaşılamıyor!') : null; ?>
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
            <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span>İletişim</li>
        </ul>
    </div>
</section>
<!-- contacts -->
<section class="w3l-contact-7 pt-5" id="contact">
    <div class="contacts-9 pt-lg-5 pt-md-4">
        <div class="container">
            <div class="top-map">
                <div class="row map-content-9">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h5 class="mb-2">İletişime Geçin!</h5>
                            <p class="mb-4">E-posta hesabınız yayımlanmayacak. Gerekli alanlar işaretlendi *</p>
                            <form action="https://sendmail.w3layouts.com/submitForm" method="post" class="">
                                <div class="form-grid">
                                    <div class="input-field">
                                        <input type="text" name="w3lName" id="w3lName" placeholder="İsminiz"
                                            required="">
                                    </div>
                                    <div class="input-field">
                                        <input type="email" name="w3lSender" id="w3lSender" placeholder="Email"
                                            required="">
                                    </div>
                                </div>
                                <div class="input-field mt-4">
                                    <textarea name="w3lMessage" id="w3lMessage" placeholder="Mesaj"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-style mt-3">Gönder</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 cont-details">
                        <address>
                            <h5 class="">Ofis Adresimiz</h5>
                            <p><span class="fa fa-map-marker"></span>Kütahya/MERKEZ. </p>

                            <h5 class="mt-4 pt-lg-3">Telefon Bilgileri</h5>
                            <p><span class="fa fa-mobile"></span> <strong>Telefon :</strong>
                                <a href="tel:+905075691340"> (+90) 507 569 1340</a></p>

                            <p><span class="fa fa-phone"></span> <strong>Telefon 2 :</strong>
                                <a href="tel:+905075691340"> (+90) 507 569 1340</a></p>

                            <p> <span class="fa fa-envelope"></span> <strong>Email :</strong>
                                <a href="mailto:mail@example.com"> mail@example.com</a></p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="map mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d394573.0281290067!2d29.818234458306726!3d39.410514404733775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14c94bb53b280f3f%3A0x78a02b938ebd9c43!2zS8O8dGFoeWEgTWVya2V6L0vDvHRhaHlh!5e0!3m2!1str!2str!4v1661076533458!5m2!1str!2str"
                frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>
    </div>
</section>
<!-- //contacts -->