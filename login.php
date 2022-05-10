<?php



$title = "Giriş Yap";

require_once 'header.php';





?>



<!-- Inner Page Banner Area Start Here -->

<div class="pagination-area bg-secondary">

    <div class="container">

        <div class="pagination-wrapper">

           

        </div>

    </div>

</div>

<!-- Inner Page Banner Area End Here -->

<!-- Registration Page Area Start Here -->

<div class="registration-page-area bg-secondary section-space-bottom">

    <div class="container">

        <h2 class="title-section">Giriş Yap</h2>

        <div class="registration-details-area inner-page-padding">



            <?php require_once 'alert.php' ?>



            <form action="sadmin/netting/user-islem.php" method="POST" id="personal-info-form">





                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <div class="form-group">

                            <label class="control-label" for="first-name">Mail Adresiniz *</label>

                            <input type="mail" id="first-name" required="" placeholder="Mail Adresinizi giriniz" name="userMail" class="form-control">

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <div class="form-group">

                            <label class="control-label" for="last-name">Şifreniz *</label>

                            <input type="password" id="last-name" required="" placeholder="Şifrenizi giriniz" name="userPass" class="form-control">

                        </div>

                    </div>

                </div>



                <div align="center" class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <div class="form-group">

                            <label class="control-label" for="first-name"></label>

                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />

                            <a class="btn btn-light" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ <i class="fa fa-refresh" aria-hidden="true"></i> ]</a>

                            <br><br>

                            <input class="form-control" type="text" required name="captcha_code">

                        </div>

                    </div>

                </div>





                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="pLace-order">

                            <button class="update-btn disabled  btn-block" type="submit" name="musterigiris">Giriş Yap</button>
                            <button style="background-color: red" class="update-btn disabled btn-block" data-toggle="modal" data-target="#sifremiunuttum" type="submit" name="musterigiris" >Şifremi Unuttum</button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Modal Başlangıç -->


<div class="modal fade" id="sifremiunuttum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Şifre Sıfırlama</h4>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>-->
  </div>
  <div class="modal-body">
    <form action="mailphp/sifremi-unuttum.php" method="POST">
        <div class="form-group">
         <p><b>Uyarı:</b> Girdiğiniz mail adresi kayıtlarımızda varsa şifreniz mail adresinize gönderilecektir.</p>
     </div>
     <div class="form-group">
        <label for="recipient-name" class="col-form-label">Mail Adresiniz:</label>
        <input type="email" class="form-control" name="kullanici_mail" id="recipient-name">
    </div>

    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
    <button type="submit" name="sifremiunuttum" class="btn btn-primary">Şifre Talep Et</button>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Bitiş -->
<!-- Registration Page Area End Here -->



<?php



require_once 'footer.php';





?>