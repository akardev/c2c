<?php


if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {

    header("Location:404");
}



if (isset($_GET['durum'])) {

    if ($_GET['durum'] == "kayitbasarili") { ?>

        <div class="alert alert-success">
            <strong>Kayıt başarılı!</strong>
        </div>

    <?php } elseif ($_GET['durum'] == "farklisifre") { ?>

        <div class="alert alert-danger">
            <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
        </div>

    <?php } elseif ($_GET['durum'] == "eksiksifre") { ?>

        <div class="alert alert-danger">
            <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
        </div>
    <?php } elseif (@$_GET['durum'] == "eskisifrehata") { ?>

        <div class="alert alert-danger">
            <strong>Eski şifreniz hatalı!</strong>
        </div>

    <?php } elseif ($_GET['durum'] == "mukerrerkayit") { ?>

        <div class="alert alert-warning">
            <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
        </div>

    <?php } elseif ($_GET['durum'] == "kayitbasarisiz") { ?>

        <div class="alert alert-danger">
            <strong>Hata!</strong> Kayıt yapılamadı!
        </div>

    <?php } elseif ($_GET['durum'] == "girisbasarili") { ?>

        <div class="alert alert-success" align="center">
            <strong>Giriş başarılı!</strong>
        </div>
    <?php } elseif ($_GET['durum'] == "girisbasarisiz") { ?>

        <div class="alert alert-danger">
            <strong>Hata!</strong> Giriş yapılamadı!
        </div>
    <?php } elseif ($_GET['durum'] == "guncellemebasarili") { ?>

        <div class="alert alert-success">
            <strong>Güncelleme işlemi başarılı!</strong>
        </div>
    <?php } elseif ($_GET['durum'] == "guncellemebasarisiz") { ?>

        <div class="alert alert-danger">
            <strong>Hata!</strong> Güncelleme işlemi başarısız!
        </div>
    <?php } elseif ($_GET['durum'] == "cikis") { ?>

        <div class="alert alert-success">
            <strong>Başarıyla çıkış yapıldı.</strong>
        </div>
        <!-- <?php //} elseif ($_GET['durum'] == "basvuruyapildi") { 
                ?>

        <div class="alert alert-success">
            <strong>Mağaza Başvurunuz alınmıştır!</strong>
        </div> -->
    <?php } elseif ($_GET['durum'] == "basvuruyapilamadi") { ?>

        <div class="alert alert-danger">
            <strong>İşlem hatalı!</strong>
        </div>
    <?php } elseif ($_GET['durum'] == "uruneklendi") { ?>

        <div class="alert alert-success">
            <strong>Ürün eklendi!</strong>
        </div>

    <?php } elseif ($_GET['durum'] == "urunduzenlendi") { ?>

        <div class="alert alert-success">
            <strong>Ürün düzenleme başarılı!</strong>
        </div>


    <?php } elseif ($_GET['durum'] == "urunsilindi") { ?>

        <div class="alert alert-success">
            <strong>Ürün Silme işlemi başarılı!</strong>
        </div>
    <?php } elseif ($_GET['durum'] == "gonderildi") { ?>

        <div class="alert alert-success">
            <strong>Mesaj Gonderildi!</strong>
        </div>

    <?php } elseif ($_GET['durum'] == "captchahata") { ?>

        <div class="alert alert-danger">
            <strong>Güvenlik kodu hatalı</strong>
        </div>

<?php }
} ?>

