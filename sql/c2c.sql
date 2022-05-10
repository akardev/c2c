-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2022, 08:45:50
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `c2c`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayarId` int(11) NOT NULL,
  `ayarLogo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarUrl` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarTitle` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarDescription` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarKeywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarAuthor` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarTel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarGsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarFaks` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarMail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarIlce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarIl` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarAdres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarMesai` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarMaps` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayarAnalystic` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarZopim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarFacebook` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarTwitter` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarInstagram` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarGoogle` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarYoutube` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarSmtpHost` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarSmtpMail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarSmtpPass` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarSmtpPort` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayarBakim` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayarId`, `ayarLogo`, `ayarUrl`, `ayarTitle`, `ayarDescription`, `ayarKeywords`, `ayarAuthor`, `ayarTel`, `ayarGsm`, `ayarFaks`, `ayarMail`, `ayarIlce`, `ayarIl`, `ayarAdres`, `ayarMesai`, `ayarMaps`, `ayarAnalystic`, `ayarZopim`, `ayarFacebook`, `ayarTwitter`, `ayarInstagram`, `ayarGoogle`, `ayarYoutube`, `ayarSmtpHost`, `ayarSmtpMail`, `ayarSmtpPass`, `ayarSmtpPort`, `ayarBakim`) VALUES
(0, 'dimg/2997725893pizap.png', 'akardev.com', 'c2c E-Ticaret Scripti', 'Php ile c2c E-ticaret Scripti yazıyoruz', 'c2c, eticaret, shopping, php', 'AKARDEV', '0850 1283 2808', '0850 1283 2808', '0850 1283 2808', 'akarbariis@gmail.com', 'Kadıköy', 'İstanbul', 'Kadıköy/İstanbul', '7/24 açık c2c scripti', '', '', '', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 'https://www.github.com', 'https://www.youtube.com', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banka`
--

CREATE TABLE `banka` (
  `bankaId` int(11) NOT NULL,
  `bankaAdı` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `bankaIban` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `bankaHesapAdSoyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `bankaDurum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `hakkimizdaId` int(11) NOT NULL,
  `hakkimizdabaslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizdaİcerik` text COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizdaVideo` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizdaVizyon` text COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizdaMisyon` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategoriId` int(11) NOT NULL,
  `kategoriAd` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kategoriOneCikar` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `kategoriSeoUrl` int(11) NOT NULL,
  `kategoriSira` int(5) NOT NULL,
  `kategoriDurum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategoriId`, `kategoriAd`, `kategoriOneCikar`, `kategoriSeoUrl`, `kategoriSira`, `kategoriDurum`) VALUES
(1, 'PHP Script', '1', 0, 1, '1'),
(2, 'Css Temalar', '1', 0, 2, '1'),
(3, 'WordPress Temalar', '1', 0, 3, '1'),
(4, 'Asp Scriptler', '1', 0, 4, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `menuId` int(11) NOT NULL,
  `menuUst` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `menuAd` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `menuDetay` text COLLATE utf8_turkish_ci NOT NULL,
  `menuUrl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `menuSira` int(5) NOT NULL,
  `menuDurum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `menuSeoUrl` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `mesajId` int(11) NOT NULL,
  `mesajZaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `mesajDetay` text COLLATE utf8_turkish_ci NOT NULL,
  `userGelen` int(11) NOT NULL,
  `userGonderen` int(11) NOT NULL,
  `mesajOkunma` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`mesajId`, `mesajZaman`, `mesajDetay`, `userGelen`, `userGonderen`, `mesajOkunma`) VALUES
(1, '2022-04-23 15:14:49', 'Merhaba Barış Bey', 2, 3, '1'),
(2, '2022-04-23 15:15:01', 'Merhaba, buyrun', 3, 2, '1'),
(3, '2022-04-23 15:15:19', 'Bla bla bla', 2, 3, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `siparisId` int(11) NOT NULL,
  `siparisZaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `userId` int(11) NOT NULL,
  `userIdSatici` int(11) NOT NULL,
  `siparisOdeme` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`siparisId`, `siparisZaman`, `userId`, `userIdSatici`, `siparisOdeme`) VALUES
(1, '2022-04-23 19:02:41', 3, 2, '0'),
(2, '2022-04-23 19:04:43', 3, 2, '0'),
(3, '2022-04-23 19:05:27', 3, 4, '0'),
(4, '2022-04-23 19:06:03', 4, 2, '0'),
(5, '2022-04-23 19:16:30', 5, 2, '0'),
(6, '2022-04-23 19:17:52', 5, 2, '0'),
(7, '2022-04-23 19:33:51', 5, 2, '0'),
(8, '2022-04-23 19:34:37', 5, 2, '0'),
(9, '2022-04-23 19:34:40', 5, 2, '0'),
(10, '2022-04-23 19:34:43', 5, 2, '0'),
(11, '2022-04-23 19:34:46', 5, 4, '0'),
(12, '2022-05-04 14:12:03', 3, 2, '0'),
(13, '2022-05-04 14:12:19', 3, 2, '0'),
(14, '2022-05-04 14:12:50', 3, 2, '0'),
(15, '2022-05-04 14:13:19', 3, 2, '0'),
(16, '2022-05-04 14:16:51', 3, 2, '0'),
(17, '2022-05-04 14:17:05', 3, 2, '0'),
(18, '2022-05-04 14:17:58', 3, 2, '0'),
(19, '2022-05-05 12:54:05', 3, 2, '0'),
(20, '2022-05-05 12:54:09', 3, 2, '0'),
(21, '2022-05-05 12:54:12', 3, 2, '0'),
(22, '2022-05-05 12:54:15', 3, 2, '0'),
(23, '2022-05-05 12:54:17', 3, 2, '0'),
(24, '2022-05-07 06:07:47', 3, 2, '0'),
(25, '2022-05-07 06:08:21', 3, 4, '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisdetay`
--

CREATE TABLE `siparisdetay` (
  `siparisDetayId` int(11) NOT NULL,
  `siparisId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userIdSatici` int(11) NOT NULL,
  `urunId` int(11) NOT NULL,
  `urunFiyat` float(9,2) NOT NULL,
  `siparisDetayOnay` enum('0','1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `siparisDetayYorum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `siparisDetayOnayZaman` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisdetay`
--

INSERT INTO `siparisdetay` (`siparisDetayId`, `siparisId`, `userId`, `userIdSatici`, `urunId`, `urunFiyat`, `siparisDetayOnay`, `siparisDetayYorum`, `siparisDetayOnayZaman`) VALUES
(1, 1, 3, 2, 1, 250.00, '2', '1', '0000-00-00 00:00:00'),
(2, 2, 3, 2, 3, 175.00, '2', '1', '0000-00-00 00:00:00'),
(3, 3, 3, 4, 7, 175.00, '2', '1', '0000-00-00 00:00:00'),
(4, 4, 4, 2, 1, 250.00, '2', '1', '0000-00-00 00:00:00'),
(5, 5, 5, 2, 1, 250.00, '2', '1', '0000-00-00 00:00:00'),
(6, 6, 5, 2, 3, 175.00, '2', '1', '0000-00-00 00:00:00'),
(7, 7, 5, 2, 2, 200.00, '2', '1', '0000-00-00 00:00:00'),
(8, 8, 5, 2, 4, 100.00, '2', '1', '0000-00-00 00:00:00'),
(9, 9, 5, 2, 5, 250.00, '2', '1', '0000-00-00 00:00:00'),
(10, 10, 5, 2, 6, 185.00, '2', '1', '0000-00-00 00:00:00'),
(11, 11, 5, 4, 8, 95.00, '2', '1', '0000-00-00 00:00:00'),
(12, 12, 3, 2, 1, 250.00, '0', '0', '0000-00-00 00:00:00'),
(13, 13, 3, 2, 1, 250.00, '0', '0', '0000-00-00 00:00:00'),
(14, 14, 3, 2, 1, 250.00, '0', '0', '0000-00-00 00:00:00'),
(15, 15, 3, 2, 1, 250.00, '0', '0', '0000-00-00 00:00:00'),
(16, 16, 3, 2, 2, 200.00, '0', '0', '0000-00-00 00:00:00'),
(17, 17, 3, 2, 2, 200.00, '2', '1', '0000-00-00 00:00:00'),
(18, 18, 3, 2, 3, 175.00, '2', '1', '0000-00-00 00:00:00'),
(19, 19, 3, 2, 5, 250.00, '2', '1', '0000-00-00 00:00:00'),
(20, 20, 3, 2, 4, 100.00, '2', '1', '0000-00-00 00:00:00'),
(21, 21, 3, 2, 1, 250.00, '2', '1', '0000-00-00 00:00:00'),
(22, 22, 3, 2, 2, 200.00, '2', '1', '0000-00-00 00:00:00'),
(23, 23, 3, 2, 3, 175.00, '2', '1', '0000-00-00 00:00:00'),
(24, 24, 3, 2, 4, 100.00, '2', '1', '0000-00-00 00:00:00'),
(25, 25, 3, 4, 8, 95.00, '2', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urunId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `kategoriId` int(11) NOT NULL,
  `urunZaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `urunResim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urunAd` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urunSeoUrl` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urunDetay` text COLLATE utf8_turkish_ci NOT NULL,
  `urunFiyat` decimal(10,2) NOT NULL,
  `urunSatis` int(5) NOT NULL,
  `urunVideo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urunKeywords` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urunStok` int(11) NOT NULL,
  `urunDurum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL,
  `urunOneCikar` enum('0','1') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urunId`, `userId`, `kategoriId`, `urunZaman`, `urunResim`, `urunAd`, `urunSeoUrl`, `urunDetay`, `urunFiyat`, `urunSatis`, `urunVideo`, `urunKeywords`, `urunStok`, `urunDurum`, `urunOneCikar`) VALUES
(1, 2, 1, '2022-04-23 14:25:40', 'dimg/urunfoto/62640c641dd34.png', 'Php Domain Takip Scripti', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque sed augue nec lobortis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut et lacinia justo. Praesent eget bibendum neque. Nam non ipsum porta, tempus risus in, lacinia urna\r\n', '250.00', 0, '', '', 0, '1', '1'),
(2, 2, 1, '2022-04-23 15:10:07', 'dimg/urunfoto/626416cf9bc3a.png', 'Php One Page Scripti', '', 'Nulla suscipit pharetra leo, vitae malesuada eros commodo non. Aenean imperdiet gravida diam, a suscipit neque consequat non. In in venenatis diam. Suspendisse potenti. Sed sit amet laoreet neque. Nulla facilisi. Quisque luctus urna condimentum, viverra libero at, sodales velit. In congue ultricies nibh at euismod. Praesent molestie diam at arcu euismod elementum. Donec lobortis blandit rhoncus. Etiam porttitor lacus eget mollis porta. Etiam sed nulla ante. Curabitur rutrum lacinia neque. Duis sit amet dictum metus. Quisque nisl nunc, ultrices a rhoncus a, tempus sed neque.\r\n', '200.00', 0, '', '', 0, '1', '1'),
(3, 2, 1, '2022-04-23 15:12:52', 'dimg/urunfoto/6264177412de5.png', ' PHP Kripto Para Listeleme Scripti', '', 'Nulla suscipit pharetra leo, vitae malesuada eros commodo non. Aenean imperdiet gravida diam, a suscipit neque consequat non. In in venenatis diam. Suspendisse potenti. Sed sit amet laoreet neque. Nulla facilisi. Quisque luctus urna condimentum, viverra libero at, sodales velit. In congue ultricies nibh at euismod. Praesent molestie diam at arcu euismod elementum. Donec lobortis blandit rhoncus. Etiam porttitor lacus eget mollis porta. Etiam sed nulla ante. Curabitur rutrum lacinia neque. Duis sit amet dictum metus. Quisque nisl nunc, ultrices a rhoncus a, tempus sed neque.\r\n', '175.00', 0, '', '', 0, '1', '1'),
(4, 2, 1, '2022-04-23 15:17:44', 'dimg/urunfoto/6264189893bd9.png', 'PHP Resim Upload Scripti', '', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean arcu massa, luctus vel hendrerit non, feugiat eget metus. Pellentesque mollis commodo egestas. Aenean aliquam fermentum libero. Integer cursus dui magna, id venenatis ligula bibendum eu.&nbsp;\r\n', '100.00', 0, '', '', 0, '1', '1'),
(5, 2, 1, '2022-04-23 15:18:41', 'dimg/urunfoto/626418d1cf749.png', 'Php Restaurant, Cafe, Lokanta Scripti', '', 'stibulum molestie eleifend elementum. Donec placerat, est dictum auctor lacinia, odio leo posuere metus, feugiat vulputate neque nulla vel nunc. Proin id mi a nisl sagittis sollicitudin eu vitae felis. Nam ornare lectus velit, in elementum erat efficitur convallis. Quisque at sapien nisi. Donec ligula tortor, posuere id nunc egestas, facilisis iaculis nisl. Nulla congue porttitor elementum.\r\n', '250.00', 0, '', '', 0, '1', '1'),
(6, 2, 1, '2022-04-23 15:19:38', 'dimg/urunfoto/6264190a3abd4.png', 'PHP Smm Panel Scripti', '', 'Donec a ipsum tincidunt magna imperdiet tempus nec quis quam. Donec molestie elementum mi, et ultricies nulla ullamcorper at. In euismod massa eu nunc pretium vulputate. Mauris vel tortor diam. In rutrum scelerisque sem, venenatis placerat neque pretium sed. Ut pellentesque tortor id elit tincidunt cursus. Cras aliquam porttitor odio eu lobortis. Mauris suscipit eu ligula quis lacinia. Etiam id purus sed felis laoreet tempor.\r\n', '185.00', 0, '', '', 0, '1', '1'),
(7, 4, 4, '2022-04-23 18:57:03', 'dimg/urunfoto/62644bff69381.png', 'ASP Haber Scripti', '', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n', '175.00', 0, '', '', 0, '1', '1'),
(8, 4, 3, '2022-04-23 18:57:59', 'dimg/urunfoto/62644c371b6a9.png', 'WordPress Minimalist Blog Teması', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using&nbsp;\r\n', '95.00', 0, '', '', 0, '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `subMerchantKey` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `userMagaza` enum('0','1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `userMagazaResim` varchar(500) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'dimg/magaza-resim-yok.png',
  `userZaman` datetime NOT NULL DEFAULT current_timestamp(),
  `userSonZaman` datetime NOT NULL DEFAULT current_timestamp(),
  `userResim` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `userTc` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userBanka` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userIban` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userAd` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `userSoyad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userMail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userPass` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userGsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `userAdres` text COLLATE utf8_turkish_ci NOT NULL,
  `userIl` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userIlce` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userUnvan` varchar(100) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'PERSONAL',
  `userTip` enum('PERSONAL','PRIVATE_COMPANY','LIMITED_OR_JOINT_STOCK_COMPANY','') COLLATE utf8_turkish_ci NOT NULL,
  `userVDaire` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userVNo` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `userYetki` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `userDurum` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`userId`, `subMerchantKey`, `userMagaza`, `userMagazaResim`, `userZaman`, `userSonZaman`, `userResim`, `userTc`, `userBanka`, `userIban`, `userAd`, `userSoyad`, `userMail`, `userPass`, `userGsm`, `userAdres`, `userIl`, `userIlce`, `userUnvan`, `userTip`, `userVDaire`, `userVNo`, `userYetki`, `userDurum`) VALUES
(1, '', '0', 'dimg/magaza-resim-yok.png', '2022-04-08 04:01:54', '2022-05-05 12:33:13', 'dimg/magaza-resim-yok.png', '54531', '', '', 'Barış Sedat', 'Akar', 'admin@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '0505 555 55 55', 'İstanbul/Kadıköy', 'İstanbul', 'Kadıköy', 'PERSONAL', '', '', '', '5', 1),
(2, '', '2', 'dimg/userphoto/62640b117c9be.jpg', '2022-04-23 16:52:34', '2022-05-07 09:43:57', 'dimg/userphoto/626711b87cd3c.jpg', '185611321531', 'AKBANK', 'TR 85502225623138594512385', 'Barış ', 'Akar', 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', '5415658544', 'Erciyesevler Mah.', 'Kayseri', 'Kocasinan', 'PERSONAL', 'PERSONAL', '', '', '1', 1),
(3, '', '0', 'dimg/magaza-resim-yok.png', '2022-04-23 18:00:49', '2022-05-07 09:07:39', 'dimg/userphoto/626414c744167.jpg', '', '', '', 'Sedat ', 'Akar', 'test2@test.com', 'e10adc3949ba59abbe56e057f20f883e', '5415658521', '', '', '', 'PERSONAL', 'PERSONAL', '', '', '1', 1),
(4, '', '2', 'dimg/userphoto/62644bb381425.jpg', '2022-04-23 18:27:56', '2022-05-07 09:08:12', 'dimg/userphoto/62641b174964a.jpg', '18563531434', 'AKBANK', 'TR 8550222343432385', 'Tina ', 'Akar', 'test3@test.com', 'e10adc3949ba59abbe56e057f20f883e', '4564654', 'Erciyesevler Mah.', 'Kayseri', 'Melikgazi', 'PERSONAL', 'PERSONAL', '', '', '1', 1),
(5, '', '0', 'dimg/magaza-resim-yok.png', '2022-04-23 22:13:20', '2022-05-05 12:33:13', 'dimg/userphoto/62644ffb3b3f5.jpg', '', '', '', 'Ayça', 'Akar', 'test4@test.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 'PERSONAL', 'PERSONAL', '', '', '1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorumId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `urunId` int(11) NOT NULL,
  `yorumDetay` text COLLATE utf8_turkish_ci NOT NULL,
  `yorumPuan` int(11) NOT NULL,
  `yorumZaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `yorumOnay` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`yorumId`, `userId`, `urunId`, `yorumDetay`, `yorumPuan`, `yorumZaman`, `yorumOnay`) VALUES
(1, 3, 1, 'Muhteşem bir script Barış Bey.\r\n', 5, '2022-04-23 19:03:04', '0'),
(2, 3, 3, '', 1, '2022-04-23 19:05:04', '0'),
(3, 3, 7, 'Eh işte.', 3, '2022-04-23 19:05:52', '0'),
(4, 4, 1, 'hav hav ', 5, '2022-04-23 19:06:28', '0'),
(5, 5, 1, 'ben beğenmedim barışcım.', 2, '2022-04-23 19:17:26', '0'),
(6, 5, 3, 'idare eder', 2, '2022-04-23 19:18:10', '0'),
(7, 5, 8, '', 1, '2022-04-23 19:36:21', '0'),
(8, 5, 6, '', 2, '2022-04-23 19:36:30', '0'),
(9, 5, 5, '', 3, '2022-04-23 19:36:37', '0'),
(10, 5, 4, '', 5, '2022-04-23 19:36:44', '0'),
(11, 5, 2, 'güzellll', 5, '2022-04-23 19:37:01', '0'),
(12, 3, 3, '', 3, '2022-05-05 12:55:03', '0'),
(13, 3, 2, '', 4, '2022-05-05 12:55:10', '0'),
(14, 3, 1, '', 5, '2022-05-05 12:55:21', '0'),
(15, 3, 4, '', 5, '2022-05-05 12:55:28', '0'),
(16, 3, 5, '', 5, '2022-05-05 12:55:35', '0'),
(17, 3, 3, '', 1, '2022-05-05 15:27:37', '0'),
(18, 3, 2, '', 4, '2022-05-05 15:27:53', '0'),
(19, 3, 4, '', 5, '2022-05-07 06:08:03', '0'),
(20, 3, 8, '', 5, '2022-05-07 06:10:09', '0');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayarId`);

--
-- Tablo için indeksler `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`bankaId`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`hakkimizdaId`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriId`);

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`mesajId`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`siparisId`);

--
-- Tablo için indeksler `siparisdetay`
--
ALTER TABLE `siparisdetay`
  ADD PRIMARY KEY (`siparisDetayId`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urunId`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorumId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `ayarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `banka`
--
ALTER TABLE `banka`
  MODIFY `bankaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `mesajId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `siparisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `siparisdetay`
--
ALTER TABLE `siparisdetay`
  MODIFY `siparisDetayId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `urunId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
