<?php 

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   
    header("Location:404");
  
 }

?>

<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">

    <p class="btn btn-success  btn-block">Üye İşlemleri</p>
    <ul class="settings-title">
        <?php if ($usercek['userMagaza'] != 2) { ?>
            <li <?php if (@$activePage == "magaza-basvuru") { ?> class="active" <?php } ?>><a href="magaza-basvuru">Mağaza Başvuru</a></li>
        <?php } ?>
        <li <?php if (@$activePage == "siparislerim") { ?> class="active" <?php } ?>><a href="siparislerim">Siparişlerim</a></li>
        <li <?php if (@$activePage == "hesabim") { ?> class="active" <?php } ?>><a href="hesabim">Hesap Bilgilerim</a></li>
        <li <?php if (@$activePage == "adres-bilgileri") { ?> class="active" <?php } ?>><a href="adres-bilgileri">Adres Bilgilerim</a></li>
        <li <?php if (@$activePage == "sifre-guncelle") { ?> class="active" <?php } ?>><a href="sifre-guncelle">Şifre Güncelle</a></li>
    </ul>

    <?php if ($usercek['userMagaza'] == 2) { ?>
        <hr>
        <p class="btn btn-success btn-block">Mağaza İşlemleri</p>
        <ul class="settings-title">
            <li <?php if (@$activePage == "magaza-banner") { ?> class="active" <?php } ?>><a href="magaza-banner">Mağaza Banner</a></li>
            <li <?php if (@$activePage == "yeni-siparisler") { ?> class="active" <?php } ?>><a href="yeni-siparisler">Yeni Siparişler</a></li>
            <li <?php if (@$activePage == "tamamlanan-siparisler") { ?> class="active" <?php } ?>><a href="tamamlanan-siparisler">Tamamlanan Siparişler</a></li>
            <li <?php if (@$activePage == "urunlerim") { ?> class="active" <?php } ?>><a href="urunlerim">Ürünlerim</a></li>
            <li <?php if (@$activePage == "urun-ekle") { ?> class="active" <?php } ?>><a href="urun-ekle">Ürün Ekle</a></li>

        </ul>
    <?php } ?>

</div>