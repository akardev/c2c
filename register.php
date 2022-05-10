<?php
$title="Kayıt Ol";
require_once 'header.php';

?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="register">Kayıt</a><span> </span></li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">Kayıt Ol </h2>
        <div class="registration-details-area inner-page-padding">


        <?php  require_once 'alert.php' ?>

            <form action="sadmin/netting/user-islem.php" method="POST" id="personal-info-form">



                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Mail Adresiniz *</label>
                            <input type="email" id="first-name" required="" placeholder="mail adresinizi giriniz..." name="userMail" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Adınız *</label>
                            <input type="text" id="first-name" required="" placeholder="adınızı giriniz..." name="userAd" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name"> Soyadınız *</label>
                            <input type="text" id="first-name" required="" placeholder="soyadınızı giriniz..." name="userSoyad" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="first-name">Şifreniz *</label>
                            <input type="password" id="first-name" required="" placeholder="şifrenizi giriniz..." name="userPassOne" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="last-name">Şifreniz Tekrar *</label>
                            <input type="password" id="last-name" required="" placeholder="şifrenizi tekrar giriniz..." name="userPassTwo" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pLace-order">
                            <button class="update-btn disabled btn-block" type="submit" name="musterikaydet">Gönder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Registration Page Area End Here -->

<?php

require_once 'footer.php';


?>