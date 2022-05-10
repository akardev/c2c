<?php

$title =  "Ürün Detayı";
require_once 'header.php';


$urunsor = $db->prepare("SELECT urun.*, user.* FROM urun INNER JOIN user ON urun.userId=user.userId where  urunId=:id and urunDurum=:durum");
$urunsor->execute([
    'id' => $_GET['urunId'],
    'durum' => 1
]);

$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)


?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<div class="product-details-page bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="<?php echo $uruncek['urunResim'] ?>" alt="<?php echo $uruncek['urunAd'] ?>" class="img-responsive">
                    </div>
                    <h2 class="title-inner-default"><?php echo $uruncek['urunAd'] ?></p>

                        <div class="product-details-tab-area">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="product-details-title">
                                        <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Ürün Açıklaması</a></li>
                                        <li><a href="#review" data-toggle="tab" aria-expanded="false">Yorumlar</a></li>

                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="description">
                                            <p style="font-size: 14px;"><?php echo $uruncek['urunDetay'] ?></p>
                                        </div>
                                        <div class="tab-pane fade" id="review">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="comments-list">
                                                            <?php
                                                            $yorumsor = $db->prepare("SELECT yorumlar.*,user.* FROM yorumlar INNER JOIN user ON yorumlar.userId=user.userId where urunId=:id order by yorumZaman DESC");
                                                            $yorumsor->execute(array(
                                                                'id' => $_GET['urunId']
                                                            ));

                                                            if (!$yorumsor->rowCount()) {

                                                                echo "Bu ürün için henüz yorum girilmemiştir";
                                                            }

                                                            while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                                                <div class="media">

                                                                    <div class="media-body">

                                                                        <h4 class="media-heading user_name"><img style="border-radius: 30px; float: left; margin-right: 10px;" width="32" height="32" class="img-responsive" src="<?php echo $yorumcek['userResim'] ?>" alt="Profil Resmi"> <?php echo $yorumcek['userAd'] . " " . $yorumcek['userSoyad'] ?>

                                                                            <ul style="float:right" class="default-rating">

                                                                                <?php

                                                                                switch ($yorumcek['yorumPuan']) {

                                                                                    case '5': ?>

                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>

                                                                                    <?php
                                                                                        break;

                                                                                    case '4': ?>

                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


                                                                                    <?php
                                                                                        break;

                                                                                    case '3': ?>

                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


                                                                                    <?php
                                                                                        break;

                                                                                    case '2': ?>

                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>


                                                                                    <?php
                                                                                        break;

                                                                                    case '1': ?>

                                                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                        <li><i style="color:grey" class="fa fa-star" aria-hidden="true"></i></li>

                                                                                <?php
                                                                                        break;
                                                                                }
                                                                                ?>

                                                                                <li>(<span> <?php echo $yorumcek['yorumPuan'] ?></span> )</li>
                                                                            </ul>
                                                                        </h4>
                                                                        <h5><?php echo $yorumcek['yorumDetay'] ?></h5>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            <?php } ?>
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
            </div>



            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Ürün Fiyatı</h3>
                            <div align="center">
                                <b style="font-size: 30px;"><?php echo $uruncek['urunFiyat'] ?><span style="font-size:16px;"> ₺</span></b>
                                <hr>
                            </div>
                            <ul class="sidebar-product-btn">
                                <form action="odeme" method="post">
                                    <input type="hidden" name="urunId" value="<?php echo $uruncek['urunId'] ?>">

                                    <?php if (empty(@$_SESSION['userIdMusteri'])) { ?>
                                        <li><a href="login?lutfengirisyapiniz" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Satın Al</a></li>
                                    <?php } else if (@$_SESSION['userIdMusteri'] != $uruncek['userId']) { ?>
                                        <li><button type="submit" name="sepeteekle" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Satın Al</button></li>
                                    <?php } ?>

                                </form>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <ul class="sidebar-sale-info">
                                <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                                <li> <?php
                                        $satissay = $db->prepare("SELECT COUNT(urunId) as say FROM siparisDetay where urunId=:id ");
                                        $satissay->execute([
                                            'id' => $_GET['urunId']
                                        ]);

                                        $cek = $satissay->fetch(PDO::FETCH_ASSOC);
                                        echo $cek['say'];


                                        ?></li>
                                <li>Satış</li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <img style="width: 73; height: 69px;" src="<?php echo @$uruncek['userResim'] ?>" alt="product" class="img-responsive">
                                <div class="sidebar-author-content">
                                    <h3><?php echo $uruncek['userAd'] . " " . substr($uruncek['userSoyad'], 0, 1) ?>.</h3>
                                    <a href="satici-<?= seo($uruncek['userAd'] . "-" . $uruncek['userSoyad']) . "-" . $uruncek['userId'] ?>" class="view-profile">Profili görüntüle</a>
                                </div>
                            </div>
                            <ul class="sidebar-badges-item">
                                <?php
                                $satissay = $db->prepare("SELECT COUNT(userIdSatici) as say FROM siparisDetay where userIdSatici=:id ");
                                $satissay->execute([
                                    'id' => $uruncek['userId']
                                ]);

                                $cek = $satissay->fetch(PDO::FETCH_ASSOC);
                                // $cek['say'] = 40;

                                if ($cek['say'] > 1 and $cek['say'] <= 19) { ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

                                <?php } elseif ($cek['say'] > 19 and $cek['say'] <= 39) {  ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

                                <?php } elseif ($cek['say'] > 39 and $cek['say'] <= 59) {  ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

                                <?php } elseif ($cek['say'] > 59 and $cek['say'] <= 79) {  ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

                                <?php } elseif ($cek['say'] > 79) {  ?>
                                    <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                    <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php' ?>