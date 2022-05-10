<?php
error_reporting(0);
// date_default_timezone_set('Europe/Istanbul');  --> db'den alıyoruz
ob_start();
session_start();
require_once 'sadmin/netting/db.php';
require_once 'sadmin/netting/function.php';

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {

    header("Location:404");
}


//AYAR SORGU
$ayarsor = $db->prepare("SELECT * FROM ayar where ayarId=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);

if ($ayarcek['ayarBakim'] == 0) {
   exit("Şu an bakımdayız...");
}



//user SORGU / Mail Session Atama
if (isset($_SESSION['userMailMusteri'])) {
    $usersor = $db->prepare("SELECT * FROM user where userMail=:mail");
    $usersor->execute([
        'mail' => $_SESSION['userMailMusteri']
    ]);
    $usercek = $usersor->fetch(PDO::FETCH_ASSOC);

    //User ID Session atama  
    if (!isset($_SESSION['userIdMusteri'])) {
        $_SESSION['userIdMusteri'] = $usercek['userId'];
    }
}


// USER ONLINE / OFFLINE DURUMU
$userSonZaman = @$_SESSION['userSonZamanMusteri'];
$suan = time();

$fark = ($suan - $userSonZaman);

if (@$fark > 300) {

    $useronline = $db->prepare("UPDATE user SET 

    userSonZaman=:userSonZaman 

    WHERE userId = {$_SESSION['userIdMusteri']}");

    $update = $useronline->execute([

        'userSonZaman' => date('Y-m-d H:i:s')

    ]);

    $userSonZaman = @$_SESSION['userSonZamanMusteri'];
}


//Kategori SORGU
$kategorisor = $db->prepare("SELECT * FROM kategori order by kategoriSira ASC");
$kategorisor->execute();

?>


<!doctype html>
<html class="no-js" lang="tr">

<head>
    <title>
        <?php
        if (empty($title)) {
            echo $ayarcek['ayarTitle'];
        } else {
            echo $title;
        }
        ?>
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $ayarcek['ayarDescription'] ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayarKeywords'] ?>">
    <meta name="author" content="<?php echo $ayarcek['ayarAuthor'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Ck Editor -->
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css\normalize.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css\main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css\animate.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css\font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css\meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css\jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css\reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css\hover-min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css\select2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">



    <!-- Modernizr Js -->
    <script src="js\modernizr-2.8.3.min.js"></script>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header2" class="header2-area right-nav-mobile">
                <div class="header-top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                <div class="logo-area">
                                    <a href="index"><img class="img-responsive" src="<?php echo $ayarcek['ayarLogo'] ?>" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <ul class="profile-notification">
                                    <li>
                                        <div class="notify-contact"><span>Yardıma mı ihtiyacınız var?</span> Bizimle iletişime geçin: <?php echo $ayarcek['ayarGsm'] ?></div>
                                    </li>


                                    <?php
                                    if (isset($_SESSION['userMailMusteri'])) { ?>


                                        <!-- SATICI YENİ SİPARİŞ BİLDİRİMİ BAŞLANGIC -->
                                        <?php if ($usercek['userMagaza'] == 2) {  ?>


                                            <li>
                                                <div class="notify-notification">
                                                    <a href="yeni-siparisler"><i class="fa fa-bell-o" aria-hidden="true"></i><span>

                                                            <?php



                                                            $bildirimsay = $db->prepare("SELECT COUNT(siparisDetayOnay) as say FROM siparisDetay where siparisDetayOnay=:detay and userIdSatici=:id ");
                                                            $bildirimsay->execute([
                                                                'detay' => 0,
                                                                'id' => $_SESSION['userIdMusteri'],

                                                            ]);

                                                            $bildirimcek = $bildirimsay->fetch(PDO::FETCH_ASSOC);
                                                            echo $bildirimcek['say'];

                                                            ?>

                                                        </span></a>
                                                    <ul>
                                                        <?php
                                                        $siparissor = $db->prepare("SELECT siparis.*, siparisDetay.*, user.*, urun.urunAd, urun.urunFiyat, urun.urunResim FROM siparis INNER JOIN siparisDetay ON siparis.siparisId=siparisDetay.siparisId INNER JOIN user ON user.userId=siparisDetay.userId INNER JOIN urun ON urun.urunId=siparisDetay.urunId where siparisDetay.userIdSatici=:userIdSatici and siparisDetay.siparisDetayOnay=:onay order by siparisZaman DESC");
                                                        $siparissor->execute([
                                                            'onay' => 0,
                                                            'userIdSatici' => $_SESSION['userIdMusteri']
                                                        ]);
                                                        if ($siparissor->rowCount() == 0) { ?>
                                                            <li>
                                                                <div class="notify-message-info">
                                                                    <div style="color:black !important" class="notify-message-subject">bildirim yok</div>

                                                                </div>
                                                            </li>
                                                        <?php }

                                                        while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) { ?>



                                                            <li>
                                                                <div class="notify-notification-img">
                                                                    <img class="img-responsive" src="<?php echo $sipariscek['urunResim'] ?>" alt="profile">
                                                                </div>
                                                                <div class="notify-notification-info">
                                                                    <div class="notify-notification-subject"><?php echo $sipariscek['urunAd'] ?></div>
                                                                    <div class="notify-notification-date">Alıcı: <?php echo $sipariscek['userAd'] . " " . substr($sipariscek['userSoyad'], 0, 1) . "." ?> </div>
                                                                    <div class="notify-notification-date">Sipariş No: <?php echo $sipariscek['siparisId'] ?> </div>
                                                                </div>
                                                                <div class="notify-notification-sign">
                                                                    <a href="yeni-siparisler"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <!-- SATICI YENİ SİPARİŞ BİLDİRİMİ BİTİŞ -->



                                        <!-- ALICI ÜRÜN TESLİM BİLDİRİMİ BAŞLANGIC -->
                                        <li>
                                            <div class="notify-notification">
                                                <a href="siparislerim"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                    <span>

                                                        <?php
                                                        $alicisay = $db->prepare("SELECT COUNT(siparisDetayOnay) as say FROM siparisDetay where siparisDetayOnay=:detay and userId=:id ");
                                                        $alicisay->execute([
                                                            'detay' => 1,
                                                            'id' => $_SESSION['userIdMusteri'],
                                                        ]);

                                                        $bldck = $alicisay->fetch(PDO::FETCH_ASSOC);
                                                        echo $bldck['say'];

                                                        ?>

                                                    </span></a>
                                                <ul>
                                                    <?php
                                                    $siparissor = $db->prepare("SELECT siparis.*, siparisDetay.*, user.*, urun.urunAd, urun.urunFiyat, urun.urunResim FROM siparis INNER JOIN siparisDetay ON siparis.siparisId=siparisDetay.siparisId INNER JOIN user ON user.userId=siparisDetay.userId INNER JOIN urun ON urun.urunId=siparisDetay.urunId where siparisDetay.userId=:userId and siparisDetay.siparisDetayOnay=:onay order by siparisZaman DESC");
                                                    $siparissor->execute([
                                                        'onay' => 1,
                                                        'userId' => $_SESSION['userIdMusteri']
                                                    ]);
                                                    if ($siparissor->rowCount() == 0) { ?>
                                                        <li>
                                                            <div class="notify-message-info">
                                                                <div style="color:black !important" class="notify-message-subject">bildirim yok</div>

                                                            </div>
                                                        </li>
                                                    <?php }

                                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) { ?>



                                                        <li>
                                                            <div class="notify-notification-img">
                                                                <img class="img-responsive" src="<?php echo $sipariscek['urunResim'] ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-notification-info">
                                                                <div class="notify-notification-subject"><?php echo $sipariscek['urunAd'] ?> </div>
                                                                <div class="notify-notification-date">Adlı Ürün Satıcı tarafından Teslim Edildi</div>
                                                                <div class="notify-notification-date">Sipariş No: <?php echo $sipariscek['siparisId'] ?> </div>
                                                            </div>
                                                            <div class="notify-notification-sign">
                                                                <a href="siparis-detay?siparisId=<?php echo $sipariscek['siparisId'] ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <!--  ALICI ÜRÜN TESLİM BİLDİRİMİ BITIS -->


                                        <!-- MESAJ BİLDİRİMİ BAŞLANGIÇ -->
                                        <li>
                                            <div class="notify-message">
                                                <a href="gelen-mesajlar"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>
                                                        <?php
                                                        $mesajsay = $db->prepare("SELECT COUNT(mesajOkunma) as say FROM mesaj where mesajOkunma=:okunma and userGelen=:id");
                                                        $mesajsay->execute([
                                                            'okunma' => 0,
                                                            'id' => $_SESSION['userIdMusteri']
                                                        ]);
                                                        $msjcek = $mesajsay->fetch(PDO::FETCH_ASSOC);
                                                        echo $msjcek['say'];  ?>
                                                    </span></a>


                                                <ul>
                                                    <?php
                                                    $mesajsor = $db->prepare("SELECT mesaj.*, user.* FROM mesaj INNER JOIN user ON mesaj.userGonderen=user.userId where mesaj.userGelen=:id and mesajOkunma=:okunma  order by mesajZaman DESC limit 5");
                                                    $mesajsor->execute([
                                                        'okunma' => 0,
                                                        'id' => $_SESSION['userIdMusteri']
                                                    ]);


                                                    if ($mesajsor->rowCount() == 0) { ?>
                                                        <li>
                                                            <div class="notify-message-info">
                                                                <div style="color:black !important" class="notify-message-subject">Okunmamış Mesajınız bulunmamaktadır...</div>

                                                            </div>
                                                        </li>
                                                    <?php }
                                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                                        <li>
                                                            <div class="notify-message-img">
                                                                <img class="img-responsive img-circle" src="<?php echo $mesajcek['userResim'] ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-message-info">
                                                                <div class="notify-message-sender"><b><?php echo $mesajcek['userAd'] . " " . substr($mesajcek['userSoyad'], 0, 1) . "." ?></b></div>
                                                                <div class="notify-message-date"><?php echo substr($mesajcek['mesajDetay'], 0, 15) . "..." ?> </div>
                                                                <?php $mesajZaman = $mesajcek['mesajZaman'] ?>
                                                                <div class="notify-message-date"><?php echo trdate("j F Y H:i", $mesajZaman) ?></div>
                                                            </div>
                                                            <div class="notify-message-sign">
                                                                <a href="mesaj-detay?mesajId=<?php echo $mesajcek['mesajId'] ?>&userGonderen=<?php echo $mesajcek['userGonderen'] ?>"><i style="color: red;" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </li>

                                                    <?php }  ?>

                                                </ul>
                                            </div>
                                        </li>
                                        <!-- MESAJ BİLDİRİMİ BİTİS -->

                                        <li>
                                            <div class="user-account-info">
                                                <div class="user-account-info-controler">
                                                    <div class="user-account-img">
                                                        <img style="border-radius: 50px;" width="34" height="34" class="img-responsive" src="<?php echo $usercek['userResim'] ?>" alt="Profil Resmi">
                                                    </div>
                                                    <div class="user-account-title">
                                                        <div class="user-account-name"><?php echo $usercek['userAd'] . " " . substr($usercek['userSoyad'], 0, 1) . "." ?></div>
                                                        <div class="user-account-balance">

                                                            <?php

                                                            $siparissor = $db->prepare("SELECT SUM(urunFiyat) as toplam FROM siparisDetay where userIdSatici=:id");
                                                            $siparissor->execute([
                                                                'id' => $_SESSION['userIdMusteri']
                                                            ]);

                                                           $sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC);

                                                           if (isset($sipariscek['toplam'])) {
                                                            echo $sipariscek['toplam']." TL";
                                                           }
                                                          else {
                                                            echo "0 TL";
                                                          }

                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="user-account-dropdown">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <p align="center" style="color: green;"><?php echo $usercek['userMail'] ?></p>
                                                    <a href="hesabim" class="btn btn-success btn-sm btn-block">Hesap</a>
                                                    <?php if ($usercek['userMagaza'] == 2) { ?>
                                                        <a href="satici-<?= seo($usercek['userAd'] . "-" . $usercek['userSoyad']) . "-" . $usercek['userId'] ?>" class="btn btn-success btn-sm btn-block">Mağaza</a>
                                                    <?php } ?>
                                                    <a href="gelen-mesajlar" class="btn btn-success btn-sm btn-block">Mesajlar</a>

                                                </ul>
                                            </div>
                                        </li>
                                        <li><a class="apply-now-btn-color" href="logout" id="logout-button">Çıkış Yap</a></li>

                                    <?php } else { ?>

                                        <li><a class="apply-now-btn" href="login">Üye Girişi</a></li>

                                        <li><a class="apply-now-btn-primary " href="register">Kayıt</a></li>

                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primaryText" id="sticker">
                    <div class="container">
                        <nav id="desktop-nav">
                            <ul>
                                <li class="active"><a href="index">Anasayfa</a></li>
                                <li class="active"><a href="kategoriler">Tüm Ürünler</a></li>
                                <?php
                                $kategorisor = $db->prepare("SELECT * FROM kategori where kategoriOneCikar=:onecikar and kategoriDurum=:durum order by kategoriSira ASC");
                                $kategorisor->execute([
                                    'onecikar' => 1,
                                    'durum' => 1
                                ]);

                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {  ?>
                                    <li><a href="kategori-<?= seo($kategoricek['kategoriAd']) . "-" . $kategoricek['kategoriId'] ?>"><?php echo $kategoricek['kategoriAd'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                    <li class="active"><a href="index">Anasayfa</a></li>
                                <li class="active"><a href="kategoriler">Tüm Ürünler</a></li>
                                <?php
                                $kategorisor = $db->prepare("SELECT * FROM kategori where kategoriOneCikar=:onecikar and kategoriDurum=:durum order by kategoriSira ASC");
                                $kategorisor->execute([
                                    'onecikar' => 1,
                                    'durum' => 1
                                ]);

                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {  ?>
                                    <li><a href="kategori-<?= seo($kategoricek['kategoriAd']) . "-" . $kategoricek['kategoriId'] ?>"><?php echo $kategoricek['kategoriAd'] ?></a></li>
                                <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here -->