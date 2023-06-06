-- emlakveritabani veritabanı için sql yedeği.

-- `admin` tablosu için tablo yapısı.

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullaniciadi` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- `admin` tablosu için döküm verisi.

INSERT INTO `admin` VALUES ('1','test','asd');



