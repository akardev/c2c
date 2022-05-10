<?php
ob_start();
session_start();
require_once 'db.php';
require_once 'function.php';

# REGISTER İŞLEMLERİ
if (isset($_POST['musterikaydet'])) {


    $userMail = htmlspecialchars($_POST['userMail']);
    $userPassOne = htmlspecialchars(trim($_POST['userPassOne']));
    $userPassTwo = htmlspecialchars(trim($_POST['userPassTwo']));

    if ($userPassOne == $userPassTwo) {

        if (strlen($userPassOne) >= 6) {

            $usersor = $db->prepare("SELECT * FROM user where userMail=:mail");
            $usersor->execute(array(
                'mail' => $userMail
            ));

            $say = $usersor->rowCount();

            if ($say == 0) {

                $password = md5($userPassOne);

                $userYetki = 1;

                $userkaydet = $db->prepare("INSERT INTO user SET
					userAd=:userAd,
					userSoyad=:userSoyad,
					userMail=:userMail,
					userPass=:userPass,
					userYetki=:userYetki
					");
                $insert = $userkaydet->execute([
                    'userAd' => htmlspecialchars($_POST['userAd']),
                    'userSoyad' => htmlspecialchars($_POST['userSoyad']),
                    'userMail' => $userMail,
                    'userPass' => $password,
                    'userYetki' => $userYetki
                ]);

                if ($insert) {

                    header("Location:../../register?durum=kayitbasarili");
                } else {

                    header("Location:../../register?durum=kayitbasarisiz");
                }
            } else {

                header("Location:../../register?durum=mukerrerkayit");
            }
        } else {
            header("Location:../../register?durum=eksiksifre");
        }
    } else {

        header("Location:../../register?durum=farklisifre");
    }
};


//MÜŞTERİ GİRİŞ
if (isset($_POST['musterigiris'])) {


    require_once '../../securimage/securimage.php';

    $securimage = new Securimage();

    if ($securimage->check($_POST['captcha_code']) == false) {

        header("Location:../../login?durum=captchahata");
        exit;
    }

    echo $userMail = htmlspecialchars($_POST['userMail']);
    echo $userPass = md5(htmlspecialchars($_POST['userPass']));

    $usersor = $db->prepare("SELECT * FROM user where userMail=:mail and userPass=:pass and userYetki=:yetki and userDurum=:durum");
    $usersor->execute(array(
        'mail' => $userMail,
        'pass' => $userPass,
        'yetki' => 1,
        'durum' => 1
    ));


    $say = $usersor->rowCount();

    if ($say == 1) {

        $useronline = $db->prepare("UPDATE user SET 

        userSonZaman=:userSonZaman 
        
        WHERE userMail='$userMail'");

        $update = $useronline->execute([
            'userSonZaman' => date('Y-m-d H:i:s')

        ]);

        $_SESSION['userSonZamanMusteri'] = strtotime(date('Y-m-d H:i:s'));
        $_SESSION['userMailMusteri'] = $userMail;

        header("Location:../../index?durum=girisbasarili");

        exit;
    } else {
        header("Location:../../login?durum=girisbasarisiz");
    }
};


//MÜŞTERİ BİLGİ GÜNCELLE
if (isset($_POST['musteribilgiguncelle'])) {

    $musteriguncelle = $db->prepare("UPDATE user SET
        userAd=:userAd,
        userSoyad=:userSoyad,
        userGsm=:userGsm    
        where userId={$_SESSION['userIdMusteri']}");


    $update = $musteriguncelle->execute([
        'userAd' => htmlspecialchars($_POST['userAd']),
        'userSoyad' => htmlspecialchars($_POST['userSoyad']),
        'userGsm' => htmlspecialchars($_POST['userGsm'])
    ]);

    if ($update) {
        header("location:../../hesabim?durum=guncellemebasarili");
    } else {
        header("location:../../hesabim?durum=guncellemebasarisiz");
    }
}

// MÜŞTERİ PROFİL RESMİ GÜNCELLE
if (isset($_POST['userResimguncelle'])) {

    if ($_FILES['userResim']['size'] > 1048576) {

        echo "Bu dosya boyutu çok büyük";

        Header("Location:../../hesabim?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');


    $ext = strtolower(substr($_FILES['userResim']["name"], strpos($_FILES['userResim']["name"], '.') + 1));

    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../../hesabim?durum=formathata");

        exit;
    }
    $tmp_name = $_FILES['userResim']["tmp_name"];
    $name = seo($_FILES['userResim']["name"]);

    # image resize işlemleri #
    include('SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(128, 128);
    $image->save($tmp_name);


    $uploads_dir = '../../dimg/userphoto';



    $uniq = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

    move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");


    $duzenle = $db->prepare("UPDATE user SET
		userResim=:userresim
		WHERE userId={$_SESSION['userIdMusteri']}");
    $update = $duzenle->execute(array(
        'userresim' => $refimgyol
    ));



    if ($update) {

        $resimsilunlink = $_POST['eskiResim'];

        unlink("../../$resimsilunlink");

        Header("Location:../../hesabim?durum=guncellemebasarili");
    } else {

        Header("Location:../../hesabim?durum=guncellemebasarisiz");
    }
};



//MÜŞTERİ ADRES GÜNCELLE

if (isset($_POST['musteriadresguncelle'])) {

    $musteriguncelle = $db->prepare("UPDATE user SET
		userTip=:userTip,
		userTc=:userTc,
		userUnvan=:userUnvan,
		userVDaire=:userVDaire,
		userVNo=:userVNo,
		userAdres=:userAdres,
		userIl=:userIl,
		userIlce=:userIlce
		WHERE userId={$_SESSION['userIdMusteri']}");

    $update = $musteriguncelle->execute([
        'userTip' => htmlspecialchars($_POST['userTip']),
        'userTc' => htmlspecialchars($_POST['userTc']),
        'userUnvan' => htmlspecialchars($_POST['userUnvan']),
        'userVDaire' => htmlspecialchars($_POST['userVDaire']),
        'userVNo' => htmlspecialchars($_POST['userVNo']),
        'userAdres' => htmlspecialchars($_POST['userAdres']),
        'userIl' => htmlspecialchars($_POST['userIl']),
        'userIlce' => htmlspecialchars($_POST['userIlce'])
    ]);

    if ($update) {
        header("Location:../../adres-bilgileri?durum=guncellemebasarili");
    } else {
        header("Location:../../adres-bilgileri?durum=guncellemebasarisiz");
    }
};


//MÜŞTERİ ŞİFRE GÜNCELLEME
if (isset($_POST['musterisifreguncelle'])) {


    $userPassOld = htmlspecialchars($_POST['userPassOld']);
    $userPassOne = htmlspecialchars($_POST['userPassOne']);
    $userPassTwo = htmlspecialchars($_POST['userPassTwo']);

    $userPass = md5($userPassOld);


    $usersor = $db->prepare("SELECT * FROM user where userPass=:password");
    $usersor->execute([
        'password' => $userPass
    ]);

    $say = $usersor->rowCount();

    if ($say == 0) {
        header("Location:../../sifre-guncelle?durum=eskisifrehata");
        exit;
    }


    if ($userPassOne == $userPassTwo) {

        if (strlen($userPassOne) >= 6) {

            $sifre = md5($userPassOne);


            $musteriguncelle = $db->prepare("UPDATE user SET
				userPass=:userPass
				WHERE userId={$_SESSION['userIdMusteri']}");

            $update = $musteriguncelle->execute([

                'userPass' => $sifre

            ]);

            if ($update) {
                header("Location:../../sifre-guncelle?durum=guncellemebasarili");
            } else {
                header("Location:../../sifre-guncelle?durum=hata");
            }
        } else {
            header("Location:../../sifre-guncelle?durum=eksiksifre");
            exit;
        }
    } else {
        header("Location:../../sifre-guncelle?durum=farklisifre");
        exit;
    }
};


//MÜŞTERİ MAĞAZA BAŞVURU
if (isset($_POST['musterimagazabasvuru'])) {

    $musteriguncelle = $db->prepare("UPDATE user SET
		userTip=:userTip,
		userTc=:userTc,
		userUnvan=:userUnvan,
		userVDaire=:userVDaire,
		userVNo=:userVNo,
		userAdres=:userAdres,
		userIl=:userIl,
		userIlce=:userIlce,
		userGsm=:userGsm,
		userBanka=:userBanka,
		userIban=:userIban,
		userMagaza=:userMagaza
		WHERE userId={$_SESSION['userIdMusteri']}");

    $update = $musteriguncelle->execute([
        'userTip' => htmlspecialchars($_POST['userTip']),
        'userTc' => htmlspecialchars($_POST['userTc']),
        'userUnvan' => htmlspecialchars($_POST['userUnvan']),
        'userVDaire' => htmlspecialchars($_POST['userVDaire']),
        'userVNo' => htmlspecialchars($_POST['userVNo']),
        'userAdres' => htmlspecialchars($_POST['userAdres']),
        'userIl' => htmlspecialchars($_POST['userIl']),
        'userIlce' => htmlspecialchars($_POST['userIlce']),
        'userGsm' => htmlspecialchars($_POST['userGsm']),
        'userBanka' => htmlspecialchars($_POST['userBanka']),
        'userIban' => htmlspecialchars($_POST['userIban']),
        'userMagaza' => 1
    ]);

    if ($update) {
        header("Location:../../magaza-basvuru");
    } else {
        header("Location:../../magaza-basvuru?durum=basvuruyapilamadi");
    }
};

//MÜŞTERİ MAĞAZA YENİ BAŞVURU
if (isset($_POST['yenimagazabasvuru'])) {

    $musteriguncelle = $db->prepare("UPDATE user SET
		userMagaza=:userMagaza
		WHERE userId={$_SESSION['userIdMusteri']}");

    $update = $musteriguncelle->execute([
        'userMagaza' => 0
    ]);

    if ($update) {
        header("Location:../../magaza-basvuru");
    } else {
        header("Location:../../magaza-basvuru?durum=basvuruyapilamadi");
    }
};


//MAĞAZA ÜRÜN EKLEME 
if (isset($_POST['urunekle'])) {

    if ($_FILES['urunResim']['size'] > 1048576) {

        echo "Bu dosya boyutu çok büyük";

        Header("Location:../../urun-ekle?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png', 'jpeg');

    #echo $_FILES['urunfoto_resimyol']["name"];

    $ext = strtolower(substr($_FILES['urunResim']["name"], strpos($_FILES['urunResim']["name"], '.') + 1));

    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../../urun-ekle?durum=formathata");

        exit;
    }
    @$tmp_name = $_FILES['urunResim']["tmp_name"];
    @$name = seo($_FILES['urunResim']["name"]);

    # image resize işlemleri #
    include('SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(829, 422);
    $image->save($tmp_name);


    $uploads_dir = '../../dimg/urunfoto';



    $uniq = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

    @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");


    $duzenle = $db->prepare("INSERT INTO urun SET
		kategoriId=:kategoriId,
		userId=:userId,
		urunAd=:urunAd,
		urunDetay=:urunDetay,
		urunFiyat=:urunFiyat,
		urunResim=:urunResim
		");
    $update = $duzenle->execute(array(
        'kategoriId' => htmlspecialchars($_POST['kategoriId']),
        'userId' => htmlspecialchars($_SESSION['userIdMusteri']),
        'urunAd' => htmlspecialchars($_POST['urunAd']),
        'urunDetay' => strip_tags($_POST['urunDetay']),
        'urunFiyat' => htmlspecialchars($_POST['urunFiyat']),
        'urunResim' => $refimgyol
    ));

    if ($update) {
        Header("Location:../../urunlerim?durum=uruneklendi");
    } else {

        Header("Location:../../urun-ekle?durum=hata");
    }
};


//Mağaza Banner Güncelleme
if (isset($_POST['magazabanner'])) {

    if ($_FILES['userMagazaResim']['size'] > 0) {

        if ($_FILES['userMagazaResim']['size'] > 1048576) {

            echo "Bu dosya boyutu çok büyük";

            Header("Location:../../magaza-banner?durum=dosyabuyuk");
        }

        $izinli_uzantilar = array('jpg', 'png', 'jpeg');
        $ext = strtolower(substr($_FILES['userMagazaResim']["name"], strpos($_FILES['userMagazaResim']["name"], '.') + 1));

        if (in_array($ext, $izinli_uzantilar) === false) {
            echo "Bu uzantı kabul edilmiyor";
            Header("Location:../../magaza-banner?durum=formathata");
            exit;
        }

        @$tmp_name = $_FILES['userMagazaResim']["tmp_name"];
        @$name = $_FILES['userMagazaResim']["name"];

        //İmage Resize İşlemleri
        include('SimpleImage.php');
        $image = new SimpleImage();
        $image->load($tmp_name);
        $image->resize(829, 332);
        $image->save($tmp_name);

        $uploads_dir = '../../dimg/userphoto';



        $uniq = uniqid();
        $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

        @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");




        $duzenle = $db->prepare("UPDATE user SET
			userMagazaResim=:userMagazaResim
			WHERE userId={$_POST['userId']}");


        $update = $duzenle->execute(array(

            'userMagazaResim' => $refimgyol
        ));


        $userId = $_POST['userId'];

        if ($update) {

            $resimsilunlink = $_POST['eskiResim'];
            unlink("../../$resimsilunlink");

            Header("Location:../../magaza-banner?durum=guncellemebasarili&userId=$userId");
        } else {

            Header("Location:../../magaza-banner?durum=hata&userId=$userId");
        }
    }
};




//Mağaza Ürün Düzenleme İşlemleri
if (isset($_POST['urunduzenle'])) {

    if ($_FILES['urunResim']['size'] > 0) {


        if ($_FILES['urunResim']['size'] > 1048576) {

            echo "Bu dosya boyutu çok büyük";

            Header("Location:../../urun-duzenle?durum=dosyabuyuk");
        }

        $izinli_uzantilar = array('jpg', 'png', 'jpeg');
        $ext = strtolower(substr($_FILES['urunResim']["name"], strpos($_FILES['urunResim']["name"], '.') + 1));

        if (in_array($ext, $izinli_uzantilar) === false) {
            echo "Bu uzantı kabul edilmiyor";
            Header("Location:../../urun-duzenle?durum=formathata");
            exit;
        }

        @$tmp_name = $_FILES['urunResim']["tmp_name"];
        @$name = $_FILES['urunResim']["name"];

        //İmage Resize İşlemleri
        include('SimpleImage.php');
        $image = new SimpleImage();
        $image->load($tmp_name);
        $image->resize(829, 422);
        $image->save($tmp_name);

        $uploads_dir = '../../dimg/urunfoto';



        $uniq = uniqid();
        $refimgyol = substr($uploads_dir, 6) . "/" . $uniq . "." . $ext;

        @move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");




        $duzenle = $db->prepare("UPDATE urun SET

			kategoriId=:kategoriId,
			urunAd=:urunAd,
			urunDetay=:urunDetay,
			urunFiyat=:urunFiyat,
			urunResim=:urunResim
			WHERE urunId={$_POST['urunId']}");


        $update = $duzenle->execute(array(

            'kategoriId' => htmlspecialchars($_POST['kategoriId']),
            'urunAd' => htmlspecialchars($_POST['urunAd']),
            'urunDetay' => strip_tags($_POST['urunDetay']),
            'urunFiyat' => htmlspecialchars($_POST['urunFiyat']),
            'urunResim' => $refimgyol
        ));


        $urunId = $_POST['urunId'];

        if ($update) {

            $resimsilunlink = $_POST['eskiResim'];
            unlink("../../$resimsilunlink");

            Header("Location:../../urun-duzenle?durum=urunduzenlendi&urunId=$urunId");
        } else {

            Header("Location:../../urun-duzenle?durum=hata&urunId=$urunId");
        }
    } else {



        //Fotoğraf Yoksa İşlemler

        $duzenle = $db->prepare("UPDATE urun SET

			kategoriId=:kategoriId,
			urunAd=:urunAd,
			urunDetay=:urunDetay,
			urunFiyat=:urunFiyat
			WHERE urunId={$_POST['urunId']}");


        $update = $duzenle->execute(array(

            'kategoriId' => htmlspecialchars($_POST['kategoriId']),
            'urunAd' => htmlspecialchars($_POST['urunAd']),
            'urunDetay' => strip_tags($_POST['urunDetay']),
            'urunFiyat' => htmlspecialchars($_POST['urunFiyat'])
        ));


        $urunId = $_POST['urunId'];

        if ($update) {
            Header("Location:../../urun-duzenle?durum=urunduzenlendi&urunId=$urunId");
        } else {

            Header("Location:../../urun-duzenle?durum=hata&urunId=$urunId");
        }
    }
};


// MAĞAZA ÜRÜN SİLME İŞLEMLERİ
if (isset($_GET['urunsil'])) {

    if ($_GET['urunsil'] == "ok") {
        islemkontrol();
        $sil = $db->prepare("DELETE from urun where urunId=:urunId");
        $kontrol = $sil->execute(array(
            'urunId' => $_GET['urunId']
        ));

        if ($kontrol) {

            $resimsilunlink = $_GET['urunResim'];
            unlink("../../$resimsilunlink");

            Header("Location:../../urunlerim?durum=urunsilindi");
        } else {

            Header("Location:../../urunlerim?durum=no");
        }
    }
};


//SİPARİŞ KAYDET
if (isset($_POST['sipariskaydet'])) {
    $siparisId = $_GET['siparisId'];
    $kaydet = $db->prepare("INSERT INTO siparis SET
		userId=:id,
		userIdSatici=:idsatici
		");

    $insert = $kaydet->execute(array(
        'id' => htmlspecialchars($_SESSION['userIdMusteri']),
        'idsatici' => htmlspecialchars($_POST['userIdSatici'])
    ));

    if ($insert) {
        $siparisId = $db->lastInsertId();
        $sipariskaydet = $db->prepare("INSERT INTO siparisDetay SET
			siparisId=:siparisId,
			userId=:id,
			userIdSatici=:idsatici,
			urunId=:urunId,
			urunFiyat=:urunFiyat
			");
        $insertkaydet = $sipariskaydet->execute(array(
            'siparisId' => $siparisId,
            'id' => htmlspecialchars($_SESSION['userIdMusteri']),
            'idsatici' => htmlspecialchars($_POST['userIdSatici']),
            'urunId' => htmlspecialchars($_POST['urunId']),
            'urunFiyat' => htmlspecialchars($_POST['urunFiyat'])
        ));

        if ($insertkaydet) {
            Header("Location:../../odemebilgi?siparisId=$siparisId");
        }
    } else {
        Header("Location:../../404");
    }
}


//ALICI ÜRÜN ONAY İŞLEMLERİ
if (@$_GET['urun-onay'] == "ok") {

    $siparisId = $_GET['siparisId'];

    $siparisDetayGuncelle = $db->prepare("UPDATE siparisDetay SET
		siparisDetayOnay=:siparisDetayOnay
		WHERE siparisDetayId={$_GET['siparisDetayId']}");
    $update = $siparisDetayGuncelle->execute([
        'siparisDetayOnay' => 2
    ]);

    if ($update) {
        header("Location:../../siparis-detay?siparisId=$siparisId");
    } else {
        header("Location:../../siparis-detay?durum=no");
    }
};

//SATICI ÜRÜN TESLİM İŞLEMLERİ
if (@$_GET['urun-teslim'] == "ok") {

    $siparisId = $_GET['siparisId'];

    $siparisDetayGuncelle = $db->prepare("UPDATE siparisDetay SET
		siparisDetayOnay=:siparisDetayOnay
		WHERE siparisDetayId={$_GET['siparisDetayId']}");
    $update = $siparisDetayGuncelle->execute([
        'siparisDetayOnay' => 1
    ]);

    if ($update) {
        header("Location:../../yeni-siparisler?siparisId=$siparisId");
    } else {
        header("Location:../../siparis-detay?durum=no");
    }
};


//PUAN YORUM EKLE 
if (isset($_POST['puanyorumekle'])) {

    $kaydet = $db->prepare("INSERT INTO yorumlar SET
		yorumPuan=:yorumPuan,
		urunId=:urunId,
        yorumDetay=:yorumDetay,
        userId=:userId
		");

    $insert = $kaydet->execute(array(
        'yorumPuan' => htmlspecialchars($_POST['yorumPuan']),
        'urunId' => htmlspecialchars($_POST['urunId']),
        'yorumDetay' => htmlspecialchars($_POST['yorumDetay']),
        'userId' => htmlspecialchars($_SESSION['userIdMusteri'])
    ));

    $siparisId = $_POST['siparisId'];

    if ($insert) {

        $siparisYorumGuncelle = $db->prepare("UPDATE siparisDetay SET
         siparisDetayYorum=:siparisDetayYorum
         WHERE siparisId={$_POST['siparisId']}");
        $update = $siparisYorumGuncelle->execute([
            'siparisDetayYorum' => 1
        ]);

        header("Location:../../siparis-detay?siparisId=$siparisId");
    } else {
        header("Location:../../siparis-detay?durum=no");
    }
}



// MESAJ GÖNDER
if (isset($_POST['mesajgonder'])) {

    $userGelen = $_POST['userGelen'];

    $kaydet = $db->prepare("INSERT INTO mesaj SET
		mesajDetay=:mesajDetay,
		userGelen=:userGelen,
		userGonderen=:userGonderen
		");
    $insert = $kaydet->execute(array(
        'mesajDetay' => $_POST['mesajDetay'],
        'userGelen' => htmlspecialchars($_POST['userGelen']),
        'userGonderen' => htmlspecialchars($_SESSION['userIdMusteri'])
    ));

    if ($insert) {
        Header("Location:../../mesaj-gonder?durum=gonderildi&userGelen=$userGelen");
    } else {
        Header("Location:../../mesaj-gonder?durum=no&userGelen=$userGelen");
    }
}



//MESAJA CEVAP VER
if (isset($_POST['mesajcevapver'])) {
    $userGelen = $_POST['userGelen'];

    $kaydet = $db->prepare("INSERT INTO mesaj SET
        mesajDetay=:mesajDetay,
		userGelen=:userGelen,
		userGonderen=:userGonderen
		");

    $insert = $kaydet->execute(array(
        'mesajDetay' => $_POST['mesajDetay'],
        'userGelen' => htmlspecialchars($_POST['userGelen']),
        'userGonderen' => htmlspecialchars($_SESSION['userIdMusteri'])
    ));

    if ($insert) {
        Header("Location:../../gelen-mesajlar?durum=ok");
    } else {
        Header("Location:../../gelen-mesajlar?durum=hata");
    }
}



// GİDEN MESAJI SİL
if ($_GET['gidenmesajsil'] == "ok") {

    $sil = $db->prepare("DELETE from mesaj where mesajId=:mesajId");
    $kontrol = $sil->execute(array(
        'mesajId' => $_GET['mesajId']
    ));

    if ($kontrol) {

        Header("Location:../../giden-mesajlar?durum=ok");
    } else {

        Header("Location:../../giden-mesajlar?durum=hata");
    }
}


// GELEN MESAJI SİL
if ($_GET['gelenmesajsil'] == "ok") {

    $sil = $db->prepare("DELETE from mesaj where mesajId=:mesajId");
    $kontrol = $sil->execute(array(
        'mesajId' => $_GET['mesajId']
    ));

    if ($kontrol) {

        Header("Location:../../gelen-mesajlar?durum=ok");
    } else {

        Header("Location:../../gelen-mesajlar?durum=hata");
    }
}
