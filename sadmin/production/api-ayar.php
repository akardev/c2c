<?php require_once 'header.php' ?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold">İletişim Ayarları</h6>
            <small>
            <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">

            
                <div class="form-group">
                    <label for="">Analyticcs Kodu</label>
                    <input id="akarinput" type="text" name="title" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Maps API</label>
                    <input id="akarinput" type="text" name="title" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Zopim API</label>
                    <input id="akarinput" type="text" name="title" value="" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>