<?php
$title = "Mağaza Banner";
$activePage = "magaza-banner";
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
                            <h2 class="title-section">Mağaza Banner</h2>
                            <div class="hesapbilgi-info inner-page-padding">

                                <?php require_once 'alert.php' ?>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <img style="width: 100;" class="img-responsive" src="<?php echo $usercek['userMagazaResim'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="userMagazaResim" type="file">
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $usercek['userId']; ?>" name="userId">
                                <input type="hidden" name="eskiResim" value="<?php echo $usercek['userMagazaResim'] ?>">
                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="magazabanner">Güncelle</button>
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