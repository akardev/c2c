<?php
$title = "Şifre Güncelle";
$activePage = "sifre-guncelle";
require_once 'header.php';
islemkontrol();

?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="sifre-guncelle">Şifre Güncelle</a><span></span></li>

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
                <form action="sadmin/netting/user-islem.php" method="POST" class="form-horizontal" id="personal-info-form">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Şifre Güncelle</h2>
                            <div class="personal-info inner-page-padding">
                                
                            <?php require_once 'alert.php' ?>  
     
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Eski Şifre</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="userPassOld" placeholder="Eski şifrenizi giriniz" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Yeni Şifre</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="userPassOne" placeholder="Yeni şifrenizi giriniz" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Yeni Şifre tekrar</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="userPassTwo" placeholder="Yeni şifrenizi tekrar giriniz" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="musterisifreguncelle">Güncelle</button>

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