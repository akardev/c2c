<?php require_once 'header.php' ?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold">İletişim Ayarları</h6>
            <small>
            <?php require_once 'alert.php'; ?>
                ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="">Telefon Numarası</label>
                    <input id="akarinput" type="text" name="ayarTel" value="<?php echo $ayarcek ['ayarTel'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Telefon Numarası (GSM)</label>
                    <input id="akarinput" type="text" name="ayarGsm" value="<?php echo $ayarcek ['ayarGsm'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Faks Numarası</label>
                    <input id="akarinput" type="text" name="ayarFaks" value="<?php echo $ayarcek ['ayarFaks'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Mail Adresi</label>
                    <input id="akarinput" type="text" name="ayarMail" value="<?php echo $ayarcek ['ayarMail'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">İlçe</label>
                    <input id="akarinput" type="text" name="ayarIlce" value="<?php echo $ayarcek ['ayarIlce'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">İl</label>
                    <input id="akarinput" type="text" name="ayarIl" value="<?php echo $ayarcek ['ayarIl'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Adres</label>
                    <input id="akarinput" type="text" name="ayarAdres" value="<?php echo $ayarcek ['ayarAdres'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Mesai</label>
                    <input id="akarinput" type="text" name="ayarMesai" value="<?php echo $ayarcek ['ayarMesai'] ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="iletisimguncelle" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>