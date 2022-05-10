<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   
    header("Location:404");
  
 }
 

?>

<div class="trending-products-area section-space-default">
    <div class="container">
        <h2 class="title-default">Çok Satanlar</h2>
    </div>
    <div class="container=fluid">
        <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">

            <?php

            // SELECT COUNT(urunId) as urunsay from siparisDetay GROUP BY urunId order by urunsay DESC
            $urunsor = $db->prepare("SELECT COUNT(siparisDetay.urunId) as coksatan, urun.*, kategori.*, user.*, siparisDetay.* FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId INNER JOIN user ON urun.userId=user.userId INNER JOIN siparisDetay ON siparisDetay.urunId=urun.urunId WHERE urunDurum=:durum GROUP BY siparisDetay.urunId order by coksatan DESC limit 8");
            $urunsor->execute([
                'durum' => 1
            ]);
            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

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
                                <div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?php echo $uruncek['userResim'] ?>" alt="profile" class="img-responsive img-circle"></div>
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
            <?php } ?>


        </div>
    </div>
</div>