<?php 
$title="Hesap Bilgilerim";
$activePage = "hesabim";
require_once 'header.php';
islemkontrol();



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


                <form class="form-horizontal" id="personal-info-form" enctype="multipart/form-data" action="sadmin/netting/user-islem.php" method="post">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="hesapbilgi">
                            <h2 class="title-section">Hesap Bilgilerim</h2>
                            <div class="hesapbilgi-info inner-page-padding">

                            <?php  require_once 'alert.php' ?>

                            <div class="form-group">
                                    <label class="col-sm-3 control-label">Profil Resminiz</label>
                                    <div class="col-sm-9">
                                        <img style="border-radius: 150px;" class="img-responsive" src="<?php echo $usercek['userResim'] ?>" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="userResim" type="file">
                                    </div>
                                </div>


                                <input type="hidden" name="eskiResim" value="<?php echo $usercek['userResim'] ?>">

                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="btn btn-success" name="userResimguncelle">Güncelle</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">E-Posta</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" disabled value="<?php echo $usercek['userMail'] ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userAd" value="<?php echo $usercek['userAd'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Soyad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userSoyad" value="<?php echo $usercek['userSoyad'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Telefon (GSM)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userGsm" value="<?php echo $usercek['userGsm'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="musteribilgiguncelle">Güncelle</button>
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


