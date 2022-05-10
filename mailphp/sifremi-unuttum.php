<?php
ob_start();

session_start();

require_once '../sadmin/netting/db.php';

require_once '../sadmin/netting/function.php';


if (isset($_POST['sifremiunuttum'])) {
	
	$usersor=$db->prepare("SELECT * FROM user where userMail=:mail");
	$usersor->execute(array(
		'mail' => $_POST['userMail']
	));
	$say=$usersor->rowCount();

	$userMail=$_POST['userMail'];


	if ($say==0) {
		
		Header("Location:../login");
		exit;

	} else {

		$usercek=$usersor->fetch(PDO::FETCH_ASSOC);

		$uretilensifre=uniqid();
		$sifrekaydet=md5($uretilensifre);

		//Veritabanı kaydını yap

		$sifreguncelle=$db->prepare("UPDATE user SET


			userPass=:userPass

			WHERE userMail='$userMail'");


		$update=$sifreguncelle->execute(array(


			'userPass' => $sifrekaydet

		));


		//Varitabanı kaydı bitir
		

	//Mail Gönderim Başlat
	$from="c2c@c2c.barisakar.com"; 
	$gonderici="Barış Akar";
	$host="mail.barisakar.com";
	$pass="HsFSxLdysvvV";
	$konu="şifre yenileme talebi";
	$yenisifre="Yeni Şifreniz : ".$uretilensifre;
	
	
	
	require("class.phpmailer.php"); // PHPMailer dosyamizi çagiriyoruz
	
	$mail = new PHPMailer(); // Sinifimizi $mail degiskenine atadik
	$mail->IsSMTP(true);  // Mailimizin SMTP ile gönderilecegini belirtiyoruz
	
	
	$mail->From     = $from;//"admin@localhost"; //Gönderen kisminda yer alacak e-mail adresi
	$mail->Sender   = $sender;//"admin@localhost";//Gönderen Mail adresi
	//$mail->ReplyTo  = ($_POST["mailiniz"]);//"admin@localhost";//Tekrar gönderimdeki mail adersi
	
	$mail->AddReplyTo=($from);//"admin@localhost";//Tekrar gönderimdeki mail adersi
	$mail->AddAddress($_POST['userMail']); // Mail gönderilecek adresleri ekliyoruz.
	$mail->FromName = "barisakarcom";//"PHP Mailer";//gönderenin ismi
	$mail->Host     = $host;//"localhost"; //SMTP server adresi
	$mail->SMTPAuth = true; //SMTP server'a kullanici adi ile baglanilcagini belirtiyoruz
	$mail->Port     = 465; //Natro SMPT Mail Portu
	$mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
	$mail->Username = $from;//"admin@localhost"; //SMTP kullanici adi
	$mail->Password = $pass;//""; //SMTP mailinizin sifresi
	//$mail->WordWrap = 50;
	//$mail->IsHTML(true); //Mailimizin HTML formatinda hazirlanacagini bildiriyoruz.
	$mail->Subject  = $konu;//"Deneme Maili"; // Mailin Konusu Konu
	//Mailimizin gövdesi: (HTML ile)
	$mail->Body = $yenisifre;
	//$mail->AltBody = $text_body;
	
	
	
	if ($mail->Send()) {
	
	Header("Location:../login.php");
	exit;

}

else {

	Header("Location:../login.php?durum=mailno");
	exit;

	/*echo "Mail Gönderimi Başarısız"; echo "<br>";
	echo "Hata: ".$mail->ErrorInfo;
	*/


}



/*$mail->ClearAddresses();
$mail->ClearAttachments();
$mail->AddAttachment('images.png'); //mail içinde resim göndermek için
$mail->addCC('mailadi@alanadiniz.site');// cc email adresi
$mail->addBCC('mailadi@alanadiniz.site');// bcc email adresi
$mail->AddAddress("mailadi@alanadiniz.site"); // Mail gönderilecek adresleri ekliyoruz.
$mail->AddAddress("mailadi@alanadiniz.site"); // Mail gönderilecek adresleri ekliyoruz. Birden fazla ekleme yapılabilir.
$mail->Send();
$mail->ClearAddresses();
$mail->ClearAttachments();
*/

//Mail Gönderim Bitir





}



}




?>