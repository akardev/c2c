<?php require_once 'header.php';

$usersor = $db->prepare("SELECT * FROM user where userId=:id");
$usersor->execute(array(
    'id' => $_GET['userId']
));

$usercek = $usersor->fetch(PDO::FETCH_ASSOC);


?>

<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold">Mağaza Onay İşlemleri</h4><br>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <form method="post" action="../netting/admin-islem.php">
                <div class="row">
                    <div class="col-md-6">
                        <?php $zaman = explode(" ", $usercek['userZaman']); ?>
                        <div class="form-group">
                            <label for="">Kayıt Tarihi</label>
                            <input id="akarinput" disabled="" type="date"value="<?php echo $zaman[0]; ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Kayıt Saati</label>
                            <input id="akarinput" disabled="" type="time" value="<?php echo $zaman[1]; ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">E-Posta</label>
                            <input id="akarinput" disabled="" type="email" value="<?php echo $usercek['userMail'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Üye İşyeri Tipi </label>
                            <input id="akarinput" disabled type="text" value="<?php echo $usercek['userTip'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Firma Ünvanı</label>
                            <input id="akarinput" type="text" name="userUnvan" value="<?php echo $usercek['userUnvan'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Vergi Dairesi</label>
                            <input id="akarinput" type="text" name="userVDaire" value="<?php echo $usercek['userVDaire'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Vergi No</label>
                            <input id="akarinput" type="text" name="userVNo" value="<?php echo $usercek['userVNo'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Banka Adı</label>
                            <input id="akarinput"  type="text" name="userBanka" value="<?php echo $usercek['userBanka'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Banka IBAN</label>
                            <input id="akarinput"  type="text" name="userIban" value="<?php echo $usercek['userIban'] ?>" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kullanıcı Durum</label>
                            <select id="akarselect" class="form-control" name="userDurum">
                                <option value="1" <?php echo $usercek['userDurum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                                <option value="0" <?php if ($usercek['userDurum'] == 0) {  echo 'selected=""';    } ?>>Pasif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">T.C Kimlik Numarası</label>
                            <input id="akarinput"  type="text" name="userTc" value="<?php echo $usercek['userTc'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Ad </label>
                            <input id="akarinput" type="text" name="userAd" value="<?php echo $usercek['userAd'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for=""> Soyad</label>
                            <input id="akarinput" type="text" name="userSoyad" value="<?php echo $usercek['userSoyad'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Telefon Numarası</label>
                            <input id="akarinput" type="text" name="userGsm" value="<?php echo $usercek['userGsm'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Adres</label>
                            <input id="akarinput" type="text" name="userAdres" value="<?php echo $usercek['userAdres'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">İl</label>
                            <input id="akarinput" type="text" name="userIl" value="<?php echo $usercek['userIl'] ?>" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">İlçe</label>
                            <input id="akarinput" type="text" name="userIlce" value="<?php echo $usercek['userIlce'] ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                <input type="hidden" name="userId" value="<?php echo $_GET['userId'] ?>">
                <div class="form-group">
                    <button  onclick="return confirm('Mağaza başvurusunu onaylamak istiyor musunuz?')" type="submit" name="magazaonay" class="btn btn-light btn-block btn-sm">Başvuru Onayla</button>
                    <a onclick="return confirm('Mağaza başvurusunu reddetmek istiyor musunuz?')" class="btn btn-danger btn-block btn-sm" href="../netting/admin-islem?magaza-basvuru=red&userId=<?php echo $usercek['userId']; ?>">Başvuruyu Reddet</a>
                </div>
            </form>




        </div>
    </div>
</div>
</div>
<?php require_once 'footer.php' ?>