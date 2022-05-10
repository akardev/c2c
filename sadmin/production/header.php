<?php
ob_start();
session_start();
require_once '../netting/db.php';
require_once '../netting/function.php';

$ayarsor = $db->prepare("SELECT * FROM ayar where ayarId=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


$usersor = $db->prepare("SELECT * FROM user where userMail=:mail");
$usersor->execute(array(
    'mail' => $_SESSION['userMail']
));
$say = $usersor->rowCount();
$usercek = $usersor->fetch(PDO::FETCH_ASSOC);

if ($say == 0) {

    Header("Location:login/login?durum=izinsiz");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Akar Admin Panel</title>

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="asset/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="asset/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="asset/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="asset/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="asset/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="asset/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="asset/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="asset/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="asset/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="asset/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="asset/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="asset/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="asset/favicon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom fonts for this template
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Tinos&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS-->
    <link href="asset/css/akardev.css" rel="stylesheet">
    <link href="asset/css/admin-panel.min.css" rel="stylesheet">

    <!-- tablo responsive -->
    <link href="asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Ck Editor -->
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>


</head>

<body id="akarfont" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">AKARDEV</div>
            </a>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index">
                    <i class="fa-solid fa-child-reaching"></i>
                    <span>HOŞGELDİNİZ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Site Ayarları</span>
                </a>
                <div id="collapseTwo" class="collapse <?php active('hakkimizda');
                                                        active('genel-ayar');
                                                        active('iletisim-ayar');
                                                        active('api-ayar');
                                                        active('sosyal-ayar');
                                                        active('smtp-ayar'); ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php active('hakkimizda'); ?>" href="hakkimizda"><i class="fa-solid fa-circle-info"></i>&emsp;Hakkımızda</a>
                        <a class="collapse-item <?php active('genel-ayar'); ?>" href="genel-ayar"><i class="fa-solid fa-gears"></i>&emsp;Genel Ayar</a>
                        <a class="collapse-item <?php active('iletisim-ayar'); ?>" href="iletisim-ayar"><i class="fa-solid fa-address-card"></i>&emsp;İletişim Ayar</a>
                        <a class="collapse-item <?php active('api-ayar'); ?>" href="api-ayar"><i class="fa-solid fa-dice-d6"></i>&emsp;Api Ayar</a>
                        <a class="collapse-item <?php active('sosyal-ayar'); ?>" href="sosyal-ayar"><i class="fa-solid fa-hashtag"></i>&emsp;Sosyal Ayar</a>
                        <a class="collapse-item <?php active('smtp-ayar'); ?>" href="smtp-ayar"><i class="fa-solid fa-at"></i>&emsp;Smtp Mail Ayar</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-shop"></i>
                    <span>Mağaza İşlemleri</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="magazalar"><i class="fa-solid fa-store"></i>&emsp;Mağazalar</a>
                        <a class="collapse-item" href="magaza-basvuru"><i class="fa-solid fa-file-pen"></i>&emsp;Mağaza Başvuruları</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php active('kullanici'); ?>" href="kullanici">
                <a class="nav-link" href="kullanici">
                    <i class="fa-solid fa-users"></i>
                    <span>Kullanıcılar</span></a>
            </li>


            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="kategoriler">
                    <i class="fa-solid fa-table-list"></i>
                    <span>Kategoriler</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="urunler">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Ürünler</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="menuler">
                    <i class="fa-solid fa-bars"></i>
                    <span>Menüler</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-gradient-dark bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i style="color: black;" class="fa fa-bars"></i>
                    </button>




                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $usercek['userAd'] . " " . $usercek['userSoyad'] ?></span>
                                <img class="img-profile rounded-circle" src="asset/img/ba.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="login/logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Güvenli Çıkış
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>