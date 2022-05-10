 id="akarinput"<?php require_once 'header.php' ?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold">SMTP Ayarları</h6>
            <small>
            <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="">Smtp Host</label>
                    <input id="akarinput" type="text" name="ayarSmtpHost" value="<?php echo $ayarcek ['ayarSmtpHost'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Mail Adresi</label>
                    <input id="akarinput" type="text" name="ayarSmtpMail" value="<?php echo $ayarcek ['ayarSmtpMail'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Mail Şifresi</label>
                    <input id="akarinput" type="text" name="ayarSmtpPass" value="<?php echo $ayarcek ['ayarSmtpPass'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Port</label>
                    <input id="akarinput" type="text" name="ayarSmtpPort" value="<?php echo $ayarcek ['ayarSmtpPort'] ?>" class="form-control" required>
                </div>
                

                <div class="form-group">
                    <button type="submit" name="smtpguncelle" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>