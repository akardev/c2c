<?php
$activePage = "kategoriler";
require_once 'header.php';

?>




<!-- Header Area End Here -->

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Product Page Grid Start Here -->
<div class="product-page-list bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="page-controls">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <div class="page-controls-sorting">
                                    <div class="dropdown">
                                        <!--<button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting<i class="fa fa-sort" aria-hidden="true"></i></button>-->
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Date</a></li>
                                            <li><a href="#">Best Sale</a></li>
                                            <li><a href="#">Rating</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <div class="layout-switcher">
                                    <ul>
                                        <!--<li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>-->
                                        <!-- <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view">

                                <?php

                                if (isset($_GET['kategoriId'])) {

                                    $sayfada = 5; // sayfada gösterilecek içerik miktarını belirtiyoruz.

                                    $sorgu = $db->prepare("SELECT * FROM urun where kategoriId=:kategoriId");
                                    $sorgu->execute(array(
                                        'kategoriId' => $_GET['kategoriId']
                                    ));
                                    $toplam_icerik = $sorgu->rowCount();
                                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                    // eğer sayfa girilmemişse 1 varsayalım.
                                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                                    if ($sayfa < 1) $sayfa = 1;
                                    // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                                    $limit = ($sayfa - 1) * $sayfada;

                                    //tüm tablo sütunlarının çekilmesi
                                    $urunsor = $db->prepare("SELECT urun.*, kategori.*, user.* FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId INNER JOIN user ON urun.userId=user.userId WHERE urunDurum=:urunDurum and kategori.kategoriId=:kategoriId order by urunZaman DESC limit $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'urunDurum' => 1,
                                        'kategoriId' => $_GET['kategoriId']
                                    ));

                                    $say = $sorgu->rowCount();

                                    if ($say == 0) { ?>
                                        <div align="center" class="alert alert-warning">
                                            <b>Bu kategoride ürün bulunamadı.</b>
                                        </div>
                                    <?php   }
                                } else {

                                    $sayfada = 5; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                                    $sorgu = $db->prepare("SELECT * FROM urun");
                                    $sorgu->execute();
                                    $toplam_icerik = $sorgu->rowCount();
                                    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                    // eğer sayfa girilmemişse 1 varsayalım.
                                    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                                    if ($sayfa < 1) $sayfa = 1;
                                    // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                                    $limit = ($sayfa - 1) * $sayfada;


                                    $urunsor = $db->prepare("SELECT urun.urunAd, urun.urunId, urun.urunFiyat, urun.urunResim, urun.kategoriId,urun.userId, urun.urunDurum, urun.urunOneCikar, urun.urunZaman, kategori.kategoriAd, user.userAd, user.userSoyad, user.userResim FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId INNER JOIN user ON urun.userId=user.userId WHERE urunDurum=:urunDurum  order by urunZaman DESC limit $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'urunDurum' => 1
                                    ));

                                    $say = $sorgu->rowCount();

                                    if ($say == 0) { ?>
                                        <div align="center" class="alert alert-warning">
                                            <b>Bu kategoride ürün bulunamadı.</b>
                                        </div>
                                    <?php   }
                                }

                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                    <div class="single-item-list">

                                        <div class="item-img">
                                            <img style="width: 238px; height: 178px;" src="<?php echo $uruncek['urunResim'] ?>" alt="<?php echo $uruncek['urunAd'] ?>" class="img-responsive">
                                            <!-- <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>-->
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <h3><a href="urun-<?= seo($uruncek['urunAd']) . "-" . $uruncek['urunId'] ?>"><?php echo $uruncek['urunAd'] ?></a></h3>
                                                    <span><?php echo $uruncek['kategoriAd'] ?></span>
                                                </div>
                                                <div class="item-sale-info">
                                                    <div class="price"><?php echo $uruncek['urunFiyat'] ?> <span style="font-size:12px;">TL</span></div>


                                                    <!-- <div class="sale-qty">Satış (
                                                        <?php /*
                                                        $satissay = $db->prepare("SELECT COUNT(urunId) as say FROM siparisDetay where urunId=:id ");
                                                        $satissay->execute([
                                                            'id' => uruncek['urunId']
                                                        ]);

                                                        $cek = $satissay->fetch(PDO::FETCH_ASSOC);
                                                        echo $cek['say'];

*/
                                                        ?>


                                                        )</div> -->
                                                </div>
                                            </div>
                                            <div class="item-profile">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img src="<?php echo $uruncek['userResim'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                                    <span><?php echo $uruncek['userAd'] . " " . substr($uruncek['userSoyad'], 0, 1) ?>.</span>
                                                </div>
                                                <div class="profile-rating-info">
                                                    <ul>
                                                        <?php
                                                        $puansay = $db->prepare("SELECT COUNT(yorumlar.urunId) as say, SUM(yorumlar.yorumPuan) as topla, yorumlar.*, urun.* FROM yorumlar INNER JOIN urun ON yorumlar.urunId=urun.urunId where urun.urunId=:id ");
                                                        $puansay->execute([
                                                            'id' => $uruncek['urunId']
                                                        ]);

                                                        $cek = $puansay->fetch(PDO::FETCH_ASSOC);
                                                        $puan = round($cek['topla'] / $cek['say']);
                                                        $puan;

                                                        ?>


                                                        <ul class="default-rating">
                                                            <?php

                                                            switch ($puan) {

                                                                case '5': ?>

                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> <?php echo $puan ?> </span> )</li>
                                                                <?php
                                                                    break;

                                                                case '4': ?>

                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> <?php echo $puan ?> </span> )</li>

                                                                <?php
                                                                    break;

                                                                case '3': ?>

                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> <?php echo $puan ?> </span> )</li>

                                                                <?php
                                                                    break;

                                                                case '2': ?>

                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> <?php echo $puan ?> </span> )</li>

                                                                <?php
                                                                    break;

                                                                case '1': ?>

                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> <?php echo $puan ?> </span> )</li>
                                                            <?php
                                                                    break;
                                                            }
                                                            ?>

                                                        </ul>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">

                                            <?php
                                            $s = 0;
                                            while ($s < $toplam_sayfa) {
                                                $s++; ?>
                                                <?php
                                                if (!empty($_GET['kategoriId'])) {

                                                    if ($s == $sayfa) { ?>

                                                        <li class="active"><a href="kategori-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategoriId'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>

                                                    <?php } else { ?>

                                                        <li><a href="kategori-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategoriId'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>

                                                    <?php   }
                                                } else {


                                                    if ($s == $sayfa) { ?>



                                                        <li><a style="background-color: #C84C3C; color:white;" href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                                    <?php } else { ?>

                                                        <li><a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>


                                            <?php   }
                                                }
                                            }

                                            ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">

                <?php require_once 'kategori-sidebar.php' ?>
            </div>
        </div>
    </div>
</div>
<!-- Product Page Grid End Here -->
<?php
require_once 'footer.php';

?>