<?php require_once 'header.php';

//AYAR SORGU
$ayarsor = $db->prepare("SELECT * FROM ayar where ayarId=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold"> Genel Ayarlar</h6><br>
            <small>
               <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="">Yüklü Logo</label>
                    <img class="img-fluid" src="" alt="">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        if (strlen($ayarcek['ayarLogo']) > 0) { ?>

                            <img width="200" src="../../<?php echo $ayarcek['ayarLogo']; ?>">

                        <?php } else { ?>


                            <img width="200" src="../../dimg/logo-yok.png">


                        <?php } ?>


                    </div>
                </div>
                <div class="form-group">
                    <label for="">Logo Seç</label>
                    <input id="akarinput" type="file" name="ayarLogo" value="<?php echo $ayarcek['ayarLogo'] ?>" class="form-control" >
                </div>

                <input type="hidden" name="eskiYol" value="<?php echo $ayarcek['ayarLogo']; ?>">
                <div class="form-group">
                    <button type="submit" name="logoguncelle" class="btn btn-light">Logo Güncelle</button>
                </div>

                <div class="form-group">
                    <label for="">Site Başlığı</label>
                    <input id="akarinput" type="text" name="ayarTitle" value="<?php echo $ayarcek['ayarTitle'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Site Açıklaması</label>
                    <input id="akarinput" type="text" name="ayarDescription" value="<?php echo $ayarcek['ayarDescription'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Site Anahtar Kelimeler</label>
                    <input id="akarinput" type="text" name="ayarKeywords" value="<?php echo $ayarcek['ayarKeywords'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Site Yazar</label>
                    <input id="akarinput" type="text" name="ayarAuthor" value="<?php echo $ayarcek['ayarAuthor'] ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="genelayarguncelle" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>