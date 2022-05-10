<?php require_once 'header.php';

$kategorisor=$db->prepare("SELECT * FROM kategori where kategoriId=:id");
$kategorisor->execute(array(
  'id' => $_GET['kategoriId']
));

$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold">Kategori Düzenle</h4><br>
            <small>
            <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <form method="post" action="../netting/admin-islem.php">
                        <div class="form-group">
                            <label for="">Kategori Ad </label>
                            <input id="akarinput" type="text" name="kategoriAd" value="<?php echo $kategoricek['kategoriAd'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Kategori Sıra</label>
                            <input id="akarinput" type="text" name="kategoriSira" value="<?php echo $kategoricek['kategoriSira'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Durum</label>
                            <select id="akarselect" class="form-control" name="kategoriDurum">
                                <option value="1" <?php echo $kategoricek['kategoriDurum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                                <option value="0" <?php if ($kategoricek['kategoriDurum'] == 0) {  echo 'selected=""'; } ?>>Pasif</option>
                            </select>
                        </div>
                        

                <input type="hidden" name="kategoriId" value="<?php echo $kategoricek['kategoriId'] ?>">
                <div class="form-group">
                    <button type="submit" name="kategoriguncelle" class="btn btn-light btn-block">Güncelle</button>
                </div>
            </form>




        </div>
    </div>
</div>
</div>
<?php require_once 'footer.php' ?>