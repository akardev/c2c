<?php
ob_start();
session_start();

require_once 'db.php';
require_once 'function.php';


//Admin Giriş
if (isset($_POST['admingiris'])) {

	$userMail = $_POST['userMail'];
	$userPass = md5($_POST['userPass']);

	$usersor = $db->prepare("SELECT * FROM user where userMail=:mail and userPass=:password and userYetki=:yetki");
	$usersor->execute(array(
		'mail' => $userMail,
		'password' => $userPass,
		'yetki' => 5
	));

	echo $say = $usersor->rowCount();

	if ($say == 1) {

		$_SESSION['userMail'] = $userMail;
		header("Location:../production/index");
		exit;
	} else {

		header("Location:../production/login/login?durum=no");
		exit;
	}
}


// USER GÜNCELLE
if (isset($_POST['userguncelle'])) {

	$userId = $_POST['userId'];

	$userguncelle = $db->prepare("UPDATE user SET
		
		userTc=:userTc,
		userAdres=:userAdres,
		userIl=:userIl,
		userIlce=:userIlce,
		userAd=:userAd,
		userSoyad=:userSoyad,
		userGsm=:userGsm,
		userDurum=:userDurum
		
		WHERE userId={$_POST['userId']}");

	$update = $userguncelle->execute([

		'userTc' => htmlspecialchars($_POST['userTc']),
		'userAdres' => htmlspecialchars($_POST['userAdres']),
		'userIl' => htmlspecialchars($_POST['userIl']),
		'userIlce' => htmlspecialchars($_POST['userIlce']),
		'userAd' => htmlspecialchars($_POST['userAd']),
		'userSoyad' => htmlspecialchars($_POST['userSoyad']),
		'userGsm' => htmlspecialchars($_POST['userGsm']),
		'userDurum' => htmlspecialchars($_POST['userDurum'])

	]);

	if ($update) {
		header("Location:../production/kullanici?durum=ok&userId=$userId");
	} else {
		header("Location:../production/kullanici?durum=no&userId=$userId");
	}
};

//USER SİL
if (isset($_GET['usersil'])) {


	if ($_GET['usersil'] == "ok") {

		$sil = $db->prepare("DELETE from user where userId=:id");
		$kontrol = $sil->execute(array(
			'id' => $_GET['userId']
		));


		if ($kontrol) {


			header("location:../production/kullanici?sil=ok");
		} else {

			header("location:../production/kullanici?sil=no");
		}
	}
}

// HAKKIMIZDA GÜNCELLE
if (isset($_POST['hakkimizdaguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE hakkimizda SET
		hakkimizdaBilgi=:hakkimizdaBilgi,
		hakkimizdaVizyon=:hakkimizdaVizyon,
		hakkimizdaMisyon=:hakkimizdaMisyon,
		hakkimizdaVideo=:hakkimizdaVideo
		WHERE hakkimizdaId=0");

	$update = $ayarkaydet->execute(array(
		'hakkimizdaBilgi' => $_POST['hakkimizdaBilgi'],
		'hakkimizdaVizyon' => $_POST['hakkimizdaVizyon'],
		'hakkimizdaMisyon' => $_POST['hakkimizdaMisyon'],
		'hakkimizdaVideo' => $_POST['hakkimizdaVideo']
	));

	if ($update) {

		header("Location:../production/hakkimizda?durum=ok");
	} else {

		header("Location:../production/hakkimizda?durum=no");
	}
}


// GENEL AYAR GÜNCELLE 
if (isset($_POST['genelayarguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayarTitle=:ayarTitle,
		ayarDescription=:ayarDescription,
		ayarKeywords=:ayarKeywords,
		ayarAuthor=:ayarAuthor
		WHERE ayarId=0");

	$update = $ayarkaydet->execute(array(
		'ayarTitle' => htmlspecialchars($_POST['ayarTitle']),
		'ayarDescription' => htmlspecialchars($_POST['ayarDescription']),
		'ayarKeywords' => htmlspecialchars($_POST['ayarKeywords']),
		'ayarAuthor' => htmlspecialchars($_POST['ayarAuthor'])
	));


	if ($update) {

		header("Location:../production/genel-ayar?durum=ok");
	} else {

		header("Location:../production/genel-ayar?durum=no");
	}
}

//  GENEL AYAR LOGO GÜNCELLE
if (isset($_POST['logoguncelle'])) {

	if ($_FILES['ayarLogo']['size'] > 1048576) {

		echo "Bu dosya boyutu çok büyük";

		Header("Location:../production/genel-ayar?durum=dosyabuyuk");
	}


	$izinli_uzantilar = array('jpg', 'gif', 'png');

	#echo $_FILES['ayarLogo']["name"];

	$ext = strtolower(substr($_FILES['ayarLogo']["name"], strpos($_FILES['ayarLogo']["name"], '.') + 1));

	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../production/genel-ayar?durum=formathata");

		exit;
	}


	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ayarLogo']["tmp_name"];
	@$name = $_FILES['ayarLogo']["name"];

	$benzersizsayi4 = rand(20000, 32000);
	$refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


	$duzenle = $db->prepare("UPDATE ayar SET
		ayarLogo=:logo
		WHERE ayarId=0");
	$update = $duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink = $_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar?durum=ok");
	} else {

		Header("Location:../production/genel-ayar?durum=no");
	}
};


// SOSYAL AYAR GÜNCELLE 
if (isset($_POST['sosyalayarguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayarFacebook=:ayarFacebook,
		ayarTwitter=:ayarTwitter,
		ayarInstagram=:ayarInstagram,
		ayarYoutube=:ayarYoutube,
		ayarGoogle=:ayarGoogle
		WHERE ayarId=0");

	$update = $ayarkaydet->execute(array(
		'ayarFacebook' => htmlspecialchars($_POST['ayarFacebook']),
		'ayarTwitter' => htmlspecialchars($_POST['ayarTwitter']),
		'ayarInstagram' => htmlspecialchars($_POST['ayarInstagram']),
		'ayarYoutube' => htmlspecialchars($_POST['ayarYoutube']),
		'ayarGoogle' => htmlspecialchars($_POST['ayarGoogle'])
	));


	if ($update) {

		header("Location:../production/sosyal-ayar?durum=ok");
	} else {

		header("Location:../production/sosyal-ayar?durum=no");
	}
}

// SMTP AYAR GÜNCELLE 
if (isset($_POST['smtpguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayarSmtpHost=:ayarSmtpHost,
		ayarSmtpMail=:ayarSmtpMail,
		ayarSmtpPass=:ayarSmtpPass,
		ayarSmtpPort=:ayarSmtpPort
		WHERE ayarId=0");

	$update = $ayarkaydet->execute(array(
		'ayarSmtpHost' => htmlspecialchars($_POST['ayarSmtpHost']),
		'ayarSmtpMail' => htmlspecialchars($_POST['ayarSmtpMail']),
		'ayarSmtpPass' => htmlspecialchars($_POST['ayarSmtpPass']),
		'ayarSmtpPort' => htmlspecialchars($_POST['ayarSmtpPort'])
	));


	if ($update) {

		header("Location:../production/smtp-ayar?durum=ok");
	} else {

		header("Location:../production/smtp-ayar?durum=no");
	}
}



// API AYAR GÜNCELLE 
if (isset($_POST['smtpguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayarSmtpHost=:ayarSmtpHost,
		ayarSmtpMail=:ayarSmtpMail,
		ayarSmtpPass=:ayarSmtpPass,
		ayarSmtpPort=:ayarSmtpPort
		WHERE ayarId=0");

	$update = $ayarkaydet->execute(array(
		'ayarSmtpHost' => htmlspecialchars($_POST['ayarSmtpHost']),
		'ayarSmtpMail' => htmlspecialchars($_POST['ayarSmtpMail']),
		'ayarSmtpPass' => htmlspecialchars($_POST['ayarSmtpPass']),
		'ayarSmtpPort' => htmlspecialchars($_POST['ayarSmtpPort'])
	));


	if ($update) {

		header("Location:../production/smtp-ayar?durum=ok");
	} else {

		header("Location:../production/smtp-ayar?durum=no");
	}
}


// İLETİŞİM AYAR GÜNCELLE 
if (isset($_POST['iletisimguncelle'])) {

	$ayarkaydet = $db->prepare("UPDATE ayar SET
		ayarTel=:ayarTel,
		ayarGsm=:ayarGsm,
		ayarFaks=:ayarFaks,
		ayarMail=:ayarMail,
		ayarIlce=:ayarIlce,
		ayarIl=:ayarIl,
		ayarAdres=:ayarAdres,
		ayarMesai=:ayarMesai
		WHERE ayarId=0");

	$update = $ayarkaydet->execute(array(
		'ayarTel' => htmlspecialchars($_POST['ayarTel']),
		'ayarGsm' => htmlspecialchars($_POST['ayarGsm']),
		'ayarFaks' => htmlspecialchars($_POST['ayarFaks']),
		'ayarMail' => htmlspecialchars($_POST['ayarMail']),
		'ayarIlce' => htmlspecialchars($_POST['ayarIlce']),
		'ayarIl' => htmlspecialchars($_POST['ayarIl']),
		'ayarAdres' => htmlspecialchars($_POST['ayarAdres']),
		'ayarMesai' => htmlspecialchars($_POST['ayarMesai'])
	));


	if ($update) {

		header("Location:../production/iletisim-ayar?durum=ok");
	} else {

		header("Location:../production/smtp-ayar?durum=no");
	}
}


// MAĞAZA ONAY İŞLEMLERİ 
if (isset($_POST['magazaonay'])) {

	$magazaguncelle = $db->prepare("UPDATE user SET
		userTc=:userTc,
		userUnvan=:userUnvan,
		userVDaire=:userVDaire,
		userVNo=:userVNo,
		userAdres=:userAdres,
		userIl=:userIl,
		userIlce=:userIlce,
		userAd=:userAd,
		userSoyad=:userSoyad,
		userGsm=:userGsm,
		userBanka=:userBanka,
		userIban=:userIban,
		userMagaza=:userMagaza
		WHERE userId={$_POST['userId']}");

	$update = $magazaguncelle->execute([
		'userTc' => htmlspecialchars($_POST['userTc']),
		'userUnvan' => htmlspecialchars($_POST['userUnvan']),
		'userVDaire' => htmlspecialchars($_POST['userVDaire']),
		'userVNo' => htmlspecialchars($_POST['userVNo']),
		'userAdres' => htmlspecialchars($_POST['userAdres']),
		'userIl' => htmlspecialchars($_POST['userIl']),
		'userIlce' => htmlspecialchars($_POST['userIlce']),
		'userAd' => htmlspecialchars($_POST['userAd']),
		'userSoyad' => htmlspecialchars($_POST['userSoyad']),
		'userGsm' => htmlspecialchars($_POST['userGsm']),
		'userBanka' => htmlspecialchars($_POST['userBanka']),
		'userIban' => htmlspecialchars($_POST['userIban']),
		'userMagaza' => 2
	]);

	if ($update) {
		header("Location:../production/magazalar?durum=ok");
	} else {
		header("Location:../production/magazalar?durum=no");
	}
};



//MAĞAZA RED İŞLEMLERİ
if (@$_GET['magaza-basvuru'] == "red") {


	$magazaguncelle = $db->prepare("UPDATE user SET
		
		userMagaza=:userMagaza
		
		WHERE userId={$_GET['userId']}");

	$update = $magazaguncelle->execute([

		'userMagaza' => 3

	]);

	if ($update) {
		header("Location:../production/magazalar?durum=ok");
	} else {
		header("Location:../production/magazalar?durum=no");
	}
};


//KATEGORİ EKLE
if (isset($_POST['kategoriekle'])) {

	$kategoriSeoUrl = seo($_POST['kategoriAd']);

	$kaydet = $db->prepare("INSERT INTO kategori SET
		kategoriAd=:kategoriAd,
		kategoriDurum=:kategoriDurum,	
		kategoriSeoUrl=:kategoriSeoUrl,
		kategoriSira=:kategoriSira
		");
	$insert = $kaydet->execute(array(
		'kategoriAd' => $_POST['kategoriAd'],
		'kategoriDurum' => $_POST['kategoriDurum'],
		'kategoriSeoUrl' => $kategoriSeoUrl,
		'kategoriSira' => $_POST['kategoriSira']
	));

	if ($insert) {

		Header("Location:../production/kategori-ekle?durum=ok");
	} else {

		Header("Location:../production/kategoriler?durum=no");
	}
}

//KATEGORİ SİL
if (isset($_GET['kategorisil'])) {

	if ($_GET['kategorisil'] == "ok") {

		$sil = $db->prepare("DELETE from kategori where kategoriId=:kategoriId");
		$kontrol = $sil->execute([
			'kategoriId' => $_GET['kategoriId']
		]);

		if ($kontrol) {
			Header("Location:../production/kategoriler?durum=ok");
		} else {
			Header("Location:../production/kategoriler?durum=no");
		}
	}
};


//KATEGORİ DÜZENLE
if (isset($_POST['kategoriguncelle'])) {

	$kategoriId = $_POST['kategoriId'];
	$kategoriSeoUrl = seo($_POST['kategoriAd']);


	$kaydet = $db->prepare("UPDATE kategori SET
		kategoriAd=:kategoriAd,
		kategoriDurum=:kategoriDurum,
		kategoriOneCikar=:kategoriOneCikar,	
		kategoriSeoUrl=:kategoriSeoUrl,
		kategoriSira=:kategoriSira
		WHERE kategoriId={$_POST['kategoriId']}");

	$update = $kaydet->execute([
		'kategoriAd' => $_POST['kategoriAd'],
		'kategoriDurum' => $_POST['kategoriDurum'],
		'kategoriOneCikar' => $_POST['kategoriOneCikar'],
		'kategoriSeoUrl' => $kategoriSeoUrl,
		'kategoriSira' => $_POST['kategoriSira']
	]);

	if ($update) {

		Header("Location:../production/kategori-duzenle?durum=ok&kategoriId=$kategoriId");
	} else {

		Header("Location:../production/kategori-duzenle?durum=no&kategoriId=$kategoriId");
	}
}


//KATEGORİ ÖNE ÇIKAR
if (isset($_GET['kategoriOneCikar'])) {


	if ($_GET['kategoriOneCikar'] == "ok") {
		$duzenle = $db->prepare("UPDATE kategori SET
			kategoriOneCikar=:kategoriOneCikar
			WHERE kategoriId={$_GET['kategoriId']}");

		$update = $duzenle->execute(array(
			'kategoriOneCikar' => $_GET['kategorione']
		));

		if ($update) {

			Header("Location:../production/kategoriler");
		} else {

			Header("Location:../production/kategoriler");
		}
	}
}

//KATEGORİ AKTİF/PASİF
if (isset($_GET['kategoriDurum'])) {


	if ($_GET['kategoriDurum'] == "ok") {
		$duzenle = $db->prepare("UPDATE kategori SET
			kategoriDurum=:kategoriDurum
			WHERE kategoriId={$_GET['kategoriId']}");

		$update = $duzenle->execute(array(
			'kategoriDurum' => $_GET['kategoridurum']
		));

		if ($update) {

			Header("Location:../production/kategoriler");
		} else {

			Header("Location:../production/kategoriler");
		}
	}
}

//ÜRÜN ÖNE ÇIKAR
if (isset($_GET['urunOneCikar'])) {


	if ($_GET['urunOneCikar'] == "ok") {
		$duzenle = $db->prepare("UPDATE urun SET
			urunOneCikar=:urunOneCikar
			WHERE urunId={$_GET['urunId']}");

		$update = $duzenle->execute(array(
			'urunOneCikar' => $_GET['urunone']
		));

		if ($update) {

			Header("Location:../production/urunler");
		} else {

			Header("Location:../production/urunler");
		}
	}
}

//ÜRÜN AKTİF/PASİF
if (isset($_GET['urunDurum'])) {


	if ($_GET['urunDurum'] == "ok") {
		$duzenle = $db->prepare("UPDATE urun SET
			urunDurum=:urunDurum
			WHERE urunId={$_GET['urunId']}");

		$update = $duzenle->execute(array(
			'urunDurum' => $_GET['urundurum']
		));

		if ($update) {

			Header("Location:../production/urunler");
		} else {

			Header("Location:../production/urunler");
		}
	}
}


//ÜRÜN SİL
if (isset($_GET['urunsil'])) {

	if ($_GET['urunsil'] == "ok") {

		$sil = $db->prepare("DELETE from urun where urunId=:urunId");
		$kontrol = $sil->execute(array(
			'urunId' => $_GET['urunId']
		));

		if ($kontrol) {

			Header("Location:../production/urunler?durum=ok");
		} else {

			Header("Location:../production/urunler?durum=no");
		}
	}
}
