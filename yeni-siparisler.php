<?php
$title = "Yeni Siparişler";
$activePage = "yeni-siparisler";
require_once 'header.php';
islemkontrol();


// //MÜŞTERİNİN KAÇ ÜRÜNÜ OLDUĞUNU SAYMA FONKSİYONU
// $urunsay = $db->prepare("SELECT COUNT(userId) as say FROM urun");
// $urunsay->execute();
// $cek = $urunsay->fetch(PDO::FETCH_ASSOC);
// $cek['say'];       echo "Toplam sipariş Sayısı: " . $cek['say'];

?>


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
                        <h2 class="title-section">Yeni Siparişler <br>
                            <!-- <small class="btn-success btn-xs"><?php  ?></small> -->
                        </h2>
                        <div class="personal-info inner-page-padding">
                            <?php require_once 'alert.php'; ?>
                            <br>
                            <div class="table-responsive ">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Ürün</th>
                                            <th scope="col">Ürün Adı</th>
                                            <th scope="col">Ürün Fiyatı</th>
                                            <th scope="col">Alıcı</th>
                                            <th scope="col">Sipariş Tarihi</th>
                                            <th scope="col">Sipariş No</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $siparissor = $db->prepare("SELECT siparis.*, siparisDetay.*, user.*, urun.urunAd, urun.urunFiyat, urun.urunResim FROM siparis INNER JOIN siparisDetay ON siparis.siparisId=siparisDetay.siparisId INNER JOIN user ON user.userId=siparisDetay.userId INNER JOIN urun ON urun.urunId=siparisDetay.urunId where siparisDetay.userIdSatici=:userIdSatici and siparisDetay.siparisDetayOnay=:onay or siparisDetay.siparisDetayOnay=:onay1 order by siparisZaman DESC");
                                        $siparissor->execute([
                                            'onay' => 0,
                                            'onay1' => 1,
                                            'userIdSatici' => $_SESSION['userIdMusteri']
                                        ]);


                                        $say = 0;
                                        while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                            $say++ ?>

                                            <tr>
                                                <th scope="row"><?php echo $say; ?></th>
                                                <td><img width="100" src="<?php echo $sipariscek['urunResim'] ?>" alt="<?php echo $sipariscek['urunAd'] ?>"></td>
                                                <td><?php echo $sipariscek['urunAd'] ?></td>
                                                <td><?php echo $sipariscek['urunFiyat'] ?> TL</td>
                                                <td><?php echo $sipariscek['userAd'] . " " . $sipariscek['userSoyad'] ?></td>
                                                <?php $siparisZaman = $sipariscek['siparisZaman'] ?>
                                                <td><?php echo trdate("j F Y", $siparisZaman) ?></td>
                                                <td><?php echo $sipariscek['siparisId'] ?></td>
                                                <td><?php

                                                    if ($sipariscek['siparisDetayOnay'] == 0) { ?>
                                                        <a onclick="return confirm('Ürünü Teslim Etmek istiyor musunuz?');" href="sadmin/netting/user-islem.php?urun-teslim=ok&siparisDetayId=<?php echo $sipariscek['siparisDetayId'] ?>&siparisId=<?php echo $sipariscek['siparisId'] ?>"><button class="btn btn-xs btn-warning">Ürünü Teslim Et</button></a>

                                                    <?php   } elseif ($sipariscek['siparisDetayOnay'] == 1) {  ?>
                                                        <button class="btn btn-xs btn-success">Alıcıdan onay bekleniyor</button>
                                                    <?php }  ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>