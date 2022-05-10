<?php require_once 'header.php'; ?>

<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">
            <h1>AKARDEV C2C Platformu</h1>
            <p></p>
           
            </div>
        </div>
    </div>
</div>

<?php require_once 'cok-satanlar.php' ?>

<div class="newest-products-area bg-secondary section-space-default">
    <div class="container">
        <h2 class="title-default">Öne Çıkan Ürünler!</h2>
    </div>
    <div class="container-fluid" id="isotope-container">

        <div class="row featuredContainer">


            <?php
            /* 
            $urunsor = $db->prepare("SELECT urun.*, kategori.*, user.* FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId INNER JOIN user ON urun.userId=user.userId WHERE urunOneCikar=:onecikar and urunDurum=:durum order by urunZaman, urunOneCikar DESC limit 8");
            */
            $urunsor = $db->prepare("SELECT urun.urunId, urun.kategoriId, urun.userId, urun.urunAd, urun.urunFiyat, urun.urunResim, urun.urunDurum, urun.urunOneCikar, kategori.kategoriId, kategori.kategoriAd, user.userId, user.userAd, user.userSoyad, user.userResim FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId INNER JOIN user ON urun.userId=user.userId WHERE urunOneCikar=:onecikar and urunDurum=:durum order by urunZaman, urunOneCikar DESC limit 8");
            $urunsor->execute([
                'onecikar' => 1,
                'durum' => 1
            ]);
            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 yenigelen plugins">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?= seo($uruncek['urunAd']) . "-" . $uruncek['urunId'] ?>"><img src="<?php echo $uruncek['urunResim'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Öne Çıkanlar!"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <h3><a href="urun-<?= seo($uruncek['urunAd']) . "-" . $uruncek['urunId'] ?>"><?php echo $uruncek['urunAd'] ?></a></h3>
                                <span><a href="kategori-<?= seo($uruncek['kategoriAd']) . "-" . $uruncek['kategoriId'] ?>"><?php echo $uruncek['kategoriAd'] ?></a></span>
                                <div class="price">₺<?php echo $uruncek['urunFiyat'] ?></div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">           
                                    <div class="img-wrapper"><a href="satici-<?= seo($uruncek['userAd'] . "-" . $uruncek['userSoyad']) . "-" . $uruncek['userId'] ?>"><img style="width: 38px; height: 38px;" src="<?php echo $uruncek['userResim'] ?>" alt="profile" class="img-responsive img-circle"></a></div>
                                    <span><?php echo $uruncek['userAd'] . " " . $uruncek['userSoyad'] ?></span>
                                </div>
                                <div class="profile-rating">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

<div class="why-choose-area bg-primaryText section-space-default">
    <div class="container">
        <h2 class="title-textPrimary">Neden AkarMarket?</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i></a>
                    <h3><a href="#">Kolayca Al & Sat</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                    <h3><a href="#">Kaliteli Ürünler</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
                    <h3><a href="#">100% Güvenli Ödeme</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- svg fotolar gelebilir -->

<?php require_once 'footer.php'; ?>