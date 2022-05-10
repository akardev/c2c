<?php
require_once 'header.php';
islemkontrol();
$urunsor = $db->prepare("SELECT * FROM urun where userId=:userId and urunId=:urunId order by urunZaman DESC");
$urunsor->execute([
    'userId' => $_SESSION['userIdMusteri'],
    'urunId' => @$_GET['urunId']
]);
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);


$kategorisor=$db->prepare("SELECT * FROM kategori order by kategoriSira ASC");
$kategorisor->execute();


?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="urun-duzenle">Ürün Düzenle</a><span></span></li>

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

                <form action="sadmin/netting/user-islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Ürün Düzenle</h2>
                            <div class="personal-info inner-page-padding">
                            <?php require_once 'alert.php' ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <img width="200" src="<?php echo $uruncek['urunResim']; ?>" alt="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Yeni Fotoğraf </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="urunResim" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Kategori</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kategoriId" class='select2'>

                                                <?php  while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                             
                                                    <option <?php if ($kategoricek['kategoriId'] == $uruncek['kategoriId']) {
                                                        echo "selected";
                                                    }  ?> value="<?php echo $kategoricek['kategoriId']; ?>"><?php echo $kategoricek['kategoriAd']; ?></option>

                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Ad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunAd" value="<?php echo $uruncek['urunAd']; ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Detay</label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" id="editor1" name="urunDetay" ><?php echo $uruncek['urunDetay']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Fiyatı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunFiyat" value="<?php echo $uruncek['urunFiyat']; ?>" type="number">
                                    </div>
                                </div>

                                <input type="hidden" value="<?php echo $uruncek['urunId']; ?>" name="urunId">
                                <input type="hidden" value="<?php echo $uruncek['urunResim']; ?>" name="eskiResim">


                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="urunduzenle" id="login-update">Ürün Düzenle</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php require_once 'footer.php'; ?>
