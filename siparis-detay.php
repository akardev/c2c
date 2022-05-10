<?php
$title = "Sipariş Detayı";
$activePage = "siparislerim";
require_once 'header.php';
islemkontrol();


// //MÜŞTERİNİN KAÇ ÜRÜNÜ OLDUĞUNU SAYMA FONKSİYONU
// $urunsay = $db->prepare("SELECT COUNT(userId) as say FROM urun");
// $urunsay->execute();
// $cek = $urunsay->fetch(PDO::FETCH_ASSOC);
// $cek['say'];       echo "Toplam sipariş Sayısı: " . $cek['say'];

?>

<head>
    <style>
        input {
            margin-left: 20px !important;
        }
    </style>
</head>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section"><?php echo @$_GET['siparisId']  ?> numaralı sipariş detayı <br>
                            <!-- <small class="btn-success btn-xs"><?php  ?></small> -->
                        </h2>
                        <div class="personal-info inner-page-padding">
                            <?php require_once 'alert.php'; ?>
                            <br>
                            <div class="table-responsive ">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ürün Fotoğrafı</th>
                                            <th scope="col">Ürün Adı</th>
                                            <th scope="col">Satıcı</th>
                                            <th scope="col">Fiyat</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $siparissor = $db->prepare("SELECT urun.*, user.*, siparis.*, siparisDetay.* FROM siparis INNER JOIN siparisDetay ON siparis.siparisId=siparisDetay.siparisId INNER JOIN urun ON urun.urunId=siparisDetay.urunId INNER JOIN user ON user.userId=siparisDetay.userIdSatici where siparis.siparisId=:siparisDetayId");
                                        $siparissor->execute([
                                            'siparisDetayId' => $_GET['siparisId']
                                        ]);


                                        $say = 0;
                                        while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                            $say++;

                                            $siparisDetayOnay = $sipariscek['siparisDetayOnay'];
                                            @$siparisDetayYorum = $sipariscek['siparisDetayYorum'];
                                            $urunId = $sipariscek['urunId'];
                                        ?>
                                            <tr>
                                                <td><img width="100" src="<?php echo $sipariscek['urunResim'] ?>" alt="<?php echo $sipariscek['urunAd'] ?>"></td>
                                                <td><?php echo $sipariscek['urunAd'] ?></td>
                                                <td><?php echo $sipariscek['userAd'] . " " . $sipariscek['userSoyad'] ?></td>
                                                <td><?php echo $sipariscek['urunFiyat'] ?> TL</td>
                                                <td><?php

                                                    if ($sipariscek['siparisDetayOnay'] == 1) { ?>
                                                        <a onclick="return confirm('Ürüne Onay Vermek istiyor musunuz?');" href="sadmin/netting/user-islem.php?urun-onay=ok&siparisDetayId=<?php echo $sipariscek['siparisDetayId'] ?>&siparisId=<?php echo $sipariscek['siparisId'] ?>"><button class="btn btn-xs btn-warning">Onay Ver</button></a>

                                                    <?php   } elseif ($sipariscek['siparisDetayOnay'] == 2) {  ?>
                                                        <button class="btn btn-xs btn-success">Onaylandı</button>
                                                    <?php } elseif ($sipariscek['siparisDetayOnay'] == 0) {  ?>
                                                        <button class="btn btn-xs btn-warning">Teslim Edilmesi Bekleniyor</button>
                                                    <?php }  ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


                                <!-- YORUM ALANI BAŞLANGIÇ -->
                                <?php if ($siparisDetayOnay == 2 and $siparisDetayYorum == 0) { ?>
                                    <form class="form-horizontal" action="sadmin/netting/user-islem.php" method="post">
                                        <div class="settings-details tab-content">
                                            <div class="tab-pane fade active in">
                                                <h2 id="yorum-baslik" class="title-section">Deneyimini değerlendirmek ister misiniz?</h2>
                                                <div id="yorum" class="info inner-page-padding">
                                                    <?php require_once 'alert.php' ?>

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input type="radio" name="yorumPuan" value="1"> 1
                                                            <input type="radio" name="yorumPuan" value="2"> 2
                                                            <input type="radio" name="yorumPuan" value="3"> 3
                                                            <input type="radio" name="yorumPuan" value="4"> 4
                                                            <input type="radio" name="yorumPuan" value="5"> 5
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="urunId" value="<?php echo $urunId ?>">
                                                    <input type="hidden" name="siparisId" value="<?php echo $_GET['siparisId'] ?>">

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <textarea style="height:100px;" class="form-control" type="text" placeholder="yorumunuzu giriniz..." name="yorumDetay"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-default" name="puanyorumekle">Gönder!</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php } elseif ($siparisDetayOnay == 2 and $siparisDetayYorum == 1) { ?>
                                    <!-- <br><br>
                                    <div class="card mb-3">
                                        <div class="card-header text-center">
                                            Değerlendirmeniz
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p></p>
                                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                            </blockquote>
                                        </div>
                                    </div> -->


                                <?php } ?>






                                <!-- YORUM ALANI BİTİŞ -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<?php require_once 'footer.php'; ?>