<?php require_once 'header.php';

?>

<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h6 class="m-0 font-weight-bold">Yeni Kategori Ekle</h6>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">

            <form method="post" action="../netting/admin-islem.php">


                <div class="form-group">
                    <label>Kategori Ad</label>
                    <input id="akarinput" type="text" name="kategoriAd" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kategori Sıra</label>
                    <input id="akarinput" type="text" name="kategoriSira" class="form-control">
                </div>
                <div class="form-group">
                    <label">Kategori Durum</label>
                        <select id="akarselect" class="form-control" name="kategoriDurum">
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                </div>
                <input type="hidden" name="kategoriId" value="<?php echo $kategoricek['kategoriId'] ?>">
                <div class="form-group">
                    <button type="submit" name="kategoriekle" class="btn btn-light btn-block">Ekle</button>
                </div>
            </form>

        </div>
    </div>



</div>
</div>
<?php require_once 'footer.php' ?>