<?php
// $title = $usercek['userAd'] . " " . $usercek['userSoyad'];
require_once 'header.php';

$usersor = $db->prepare("SELECT * FROM user where userId=:id and userMagaza=:magaza");
$usersor->execute([
    'id' => $_GET['userId'],
    'magaza' => 2
]);

$say = $usersor->rowCount();

if ($say == 0) {

    Header("Location:404");
}
$usercek = $usersor->fetch(PDO::FETCH_ASSOC);




?>
<div class="inner-banner-area">
    <div class="container">

    </div>
</div>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>

<div class="profile-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="<?php echo $usercek['userMagazaResim'] ?>" alt="product" class="img-responsive">
                    </div>
                    <div class="author-summery">
                        <div class="single-item">
                            <div class="item-title">Bölge:</div>
                            <div class="item-details"><?php echo $usercek['userIlce'] . "/" . $usercek['userIl'] ?></div>
                        </div>
                        <div class="single-item">
                            <div class="item-title">Kayıt Tarihi:</div>
                            <?php $userZaman = $usercek['userZaman'] ?>
                            <div class="item-details"><?php echo trdate("j F Y", $userZaman) ?></div>
                        </div>
                        <div class="single-item">
                            <div class="item-title">Satıcı Puanı:</div>
                            <div class="item-details">
                                <?php
                                $puansay = $db->prepare("SELECT COUNT(yorumlar.userId) as say, SUM(yorumlar.yorumPuan) as topla, yorumlar.*, urun.* FROM yorumlar INNER JOIN urun ON yorumlar.urunId=urun.urunId where urun.userId=:id ");
                                $puansay->execute([
                                    'id' => $_GET['userId']
                                ]);

                                $cek = $puansay->fetch(PDO::FETCH_ASSOC);
                                $puan = round($cek['topla'] / $cek['say']);






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
                        <div class="single-item">
                            <div class="item-title">Toplam Satış:</div>
                            <div class="item-name"><?php
                                                    $satissay = $db->prepare("SELECT COUNT(userIdSatici) as say FROM siparisDetay where userIdSatici=:id ");
                                                    $satissay->execute([
                                                        'id' => $_GET['userId']
                                                    ]);

                                                    $cek = $satissay->fetch(PDO::FETCH_ASSOC);
                                                    echo $cek['say'];


                                                    ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <div class="sidebar-author-img">
                                    <img src="<?php echo @$usercek['userResim'] ?>" alt="product" class="img-responsive">
                                </div>
                                <div class="sidebar-author-content">

                                    <h3><?php echo $usercek['userAd'] . " " . substr($usercek['userSoyad'], 0, 1) ?>.</h3>
                                    
                                        <?php

                                        $userSonZaman = strtotime(@$usercek['userSonZaman']);
                                        $suan = time();
                                        $fark = ($suan - $userSonZaman);

                                        if ($fark<300) { ?>

                                        <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"> Online</i>
                                           
                                       <?php } else { ?>

                                        <a href="#" class="view-profile"><i style="color: red;" class="fa fa-circle" aria-hidden="true"> Offline</i>

                                      <?php } ?>

                                        </a>
                                </div>
                            </div>

                            <ul class="sidebar-badges-item">

                                <?php
                                $satissay = $db->prepare("SELECT COUNT(userIdSatici) as say FROM siparisDetay where userIdSatici=:id ");
                                $satissay->execute([
                                    'id' => $_GET['userId']
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
                    <!-- <ul class="social-default">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul> -->
                    <ul class="sidebar-product-btn">

                        <?php if (empty($_SESSION['userIdMusteri'])) { ?>
                            <li><a href="login?lutfengirisyapiniz" class="buy-now-btn"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj gönder </a></li>

                        <?php  } else if (@$_SESSION['userIdMusteri'] != $usercek['userId']) { ?>
                            <li><a href="mesaj-gonder?userGelen=<?php echo $_GET['userId'] ?>" class="buy-now-btn"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj gönder </a></li>
                        <?php  }  ?>


                        <li><a href="#Products" data-toggle="tab" aria-expanded="false" class="add-to-cart-btn" id="cart-button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Ürünler (<?php
                                                                                                                                                                                                $urunsay = $db->prepare("SELECT COUNT(urun.userId) as say FROM urun where userId=:id and urunDurum=:durum");
                                                                                                                                                                                                $urunsay->execute([
                                                                                                                                                                                                    'id' => $_GET['userId'],
                                                                                                                                                                                                    'durum' => 1
                                                                                                                                                                                                ]);
                                                                                                                                                                                                $cek = $urunsay->fetch(PDO::FETCH_ASSOC);
                                                                                                                                                                                                $cek['say'];


                                                                                                                                                                                                echo $cek['say']; ?>)</a></li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="row profile-wrapper">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <!-- <ul class="profile-title">
                    <li><a href="#Products" data-toggle="tab" aria-expanded="false" class="add-to-cart-btn" id="cart-button"><i class="fa fa-briefcase" aria-hidden="true"></i> Ürünler ()</a></li>
                </ul> -->
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="tab-content">
                    <div class="tab-pane fade  active in" id="Products">
                        <h3 class="title-inner-section" style="background-color: #263238; color:aliceblue" align="center"><i class="fa fa-arrow-down" aria-hidden="true"></i> Ürünler <i class="fa fa-arrow-down" aria-hidden="true"></i></h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">

                                <?php
                                $urunsor = $db->prepare("SELECT urun.*, kategori.* FROM urun INNER JOIN kategori ON urun.kategoriId=kategori.kategoriId WHERE urun.userId=:userId and urunDurum=:durum ORDER BY urunZaman DESC");
                                $urunsor->execute([
                                    'userId' => $_GET['userId'],
                                    'durum' => 1
                                ]);
                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                        <div class="more-product-item">
                                            <div class="more-product-item-img">
                                                <img style="width: 100; height: 90px;" src="<?php echo $uruncek['urunResim'] ?>" alt="src=" <?php echo $uruncek['urunAd'] ?>" ">
                                            </div>
                                            <div class=" more-product-item-details">
                                                <h4><a href="urun-<?= seo($uruncek['urunAd']) . "-" . $uruncek['urunId'] ?>"><?php echo substr($uruncek['urunAd'], 0, 21) ?></a></h4>
                                                <div class="p-title"><?php echo $uruncek['kategoriAd'] ?></div>
                                                <div class="p-price"><?php echo $uruncek['urunFiyat'] ?>TL</div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>





                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <ul class="pagination-align-left">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Message">
                        <h3 class="title-inner-section">Message Box</h3>
                        <div class="message-wrapper">
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                                <div class="single-item-inner-author">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span> Author</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <ul class="pagination-profile-align-center">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ul>
                            </div>
                            <div class="single-item-message">
                                <h3>Leave A Comment</h3>
                                <div class="leave-comments-message">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="leave-comments-box">
                                        <textarea placeholder="Write your comment here ...*" class="textarea form-control" name="message"></textarea>
                                        <button type="submit" class="update-btn">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Reviews">
                        <h3 class="title-inner-section">Customer Reviews ( 20 )</h3>
                        <div class="reviews-wrapper">
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\7.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\8.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <ul class="pagination-profile-align-center">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Followers">
                        <h3 class="title-inner-section">Followers</h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\5.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Psdart</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\6.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">RadiusTheme</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\7.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Maxbox</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\8.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Dancty</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\9.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Austonea</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\10.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Branadom</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\11.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Grand Balle</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\12.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Akkas</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\13.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Moinar ma</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <ul class="pagination-align-left">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End Here -->
<?php require_once 'footer.php'; ?>