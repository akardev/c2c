<?php
$title = "Siparişlerim";
$activePage = "siparislerim";
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
            <ul>
                <li><a href="urunlerim">Siparişlerim</a></li>
            </ul>
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
                        <h2 class="title-section">Siparişlerim <br>
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
                                            <th scope="col">Sipariş Tarihi</th>
                                            <th scope="col">Sipariş No</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $siparissor = $db->prepare("SELECT * FROM siparis where userId=:userId order by siparisZaman DESC");
                                        $siparissor->execute([
                                            'userId' => $_SESSION['userIdMusteri']
                                        ]);


                                        $say = 0;
                                        while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {
                                            $say++ ?>

                                            <tr>
                                                <th scope="row"><?php echo $say; ?></th>
                                                <?php $siparisZaman = $sipariscek['siparisZaman'] ?>
                                                <td><?php echo trdate("j F Y", $siparisZaman) ?></td>
                                                <td><?php echo $sipariscek['siparisId'] ?></td>
                                                <td><a href="siparis-detay?siparisId=<?php echo $sipariscek['siparisId'] ?>"><button class="btn btn-light btn-xs">Detay <i class="fa fa-angle-right"></i></button></a></td>
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

