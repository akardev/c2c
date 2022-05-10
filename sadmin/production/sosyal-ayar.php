<?php require_once 'header.php' ?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold ">Sosyal Ayarlar</h6>
            <small>
            <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="">Facebook</label>
                    <input id="akarinput" type="text" name="ayarFacebook" value="<?php echo $ayarcek ['ayarFacebook'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input id="akarinput" type="text" name="ayarTwitter" value="<?php echo $ayarcek ['ayarTwitter'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Instagram</label>
                    <input id="akarinput" type="text" name="ayarInstagram" value="<?php echo $ayarcek ['ayarInstagram'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">YouTube</label>
                    <input id="akarinput" type="text" name="ayarYoutube" value="<?php echo $ayarcek ['ayarYoutube'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Google</label>
                    <input id="akarinput" type="text" name="ayarGoogle" value="<?php echo $ayarcek ['ayarGoogle'] ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="sosyalayarguncelle" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>