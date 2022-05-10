<?php
$title = "Ürünlerim";
$activePage = "urunlerim";
require_once 'header.php';
islemkontrol();

$urunsor = $db->prepare("SELECT * FROM urun where userId=:userId order by urunZaman DESC");
$urunsor->execute([
    'userId' => $_SESSION['userIdMusteri']
]);




?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="urunlerim">Ürünlerim</a></li>
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
                        <h2 class="title-section">Ürünlerim <br>
                            <small class="btn-success btn-xs"><?php
                                                                $urunsay = $db->prepare("SELECT COUNT(urun.userId) as say FROM urun where userId=:id and urunDurum=:durum");
                                                                $urunsay->execute([
                                                                    'id' => $_SESSION['userIdMusteri'],
                                                                    'durum' => 1
                                                                ]);
                                                                $cek = $urunsay->fetch(PDO::FETCH_ASSOC);
                                                                $cek['say'];
                                                                echo "Toplam ürün Sayısı: " . $cek['say']; ?></small>
                        </h2>
                        <div class="personal-info inner-page-padding">
                            <?php require_once 'alert.php'; ?>
                            <div align="center">
                                <a href="urun-ekle"><button class="btn btn-success"> Ürün Ekle</button></a>
                            </div>
                            <br>
                            <div class="table-responsive ">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Ürün Fotoğrafı</th>
                                            <th scope="col">Ürün Eklenme Tarihi</th>
                                            <th scope="col">Ürün Adı</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $say = 0;
                                        while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                            $say++ ?>

                                            <tr>
                                                <th scope="row"><?php echo $say; ?></th>
                                                <td><img width="100" src="<?php echo $uruncek['urunResim'] ?>" alt="<?php echo $uruncek['urunAd'] ?>"></td>
                                                <?php $urunZaman = $uruncek['urunZaman'] ?>
                                                <td><?php echo trdate("j F Y", $urunZaman) ?></td>
                                                <td><?php echo $uruncek['urunAd'] ?></td>
                                                <td><a href="urun-duzenle?urunId=<?php echo $uruncek['urunId'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></td>
                                                <td>

                                                    <?php if ($uruncek['urunDurum'] == 0) { ?>
                                                        <button class="btn btn-warning btn-xs">Onay Bekliyor</button>
                                                    <?php } elseif ($uruncek['urunDurum'] == 1) { ?>
                                                        <button class="btn btn-success btn-xs">Ürün Aktif</button>
                                                    <?php } ?>
                                                </td>
                                                <td><a onclick="return confirm('Bu ürünü silmek istiyor musunuz? \nİşlem geri alınamaz!')" href="sadmin/netting/user-islem.php?urunsil=ok&urunId=<?php echo $uruncek['urunId'] ?>&urunResim=<?php echo $uruncek['urunResim'] ?>"><button class="btn btn-danger btn-xs">Sil</button></a>
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


<script type="text/javascript">
    $(document).ready(function() {

        $("#kullanicitip").change(function() {

            var tip = $("#kullanicitip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#tc").show();

            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#tc").hide();

            }


        }).change();


    });
</script>