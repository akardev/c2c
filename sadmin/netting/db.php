<?php 
date_default_timezone_set('Europe/Istanbul');
try {

	$db=new PDO("mysql:host=localhost;dbname=c2c;charset=utf8",'root','');

	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOException $e) {

	echo $e->getMessage();

}
