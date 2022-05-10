<?php require_once 'header.php';

$urunsor = $db->prepare("SELECT * FROM urun where urunId=:id");
$urunsor->execute(array(
    'id' => $_GET['urunId']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark text-white">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold"><?php echo $uruncek['urunAd'] ?> adlı ürün</h4><br>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <form method="post" action="../netting/admin-islem.php" enctype="multipart/form-data">


                <div class="form-group">
                    <?php

                    $urunId = $uruncek['kategoriId'];
                    $kategorisor = $db->prepare("SELECT * FROM kategori order by kategoriSira ASC");
                    $kategorisor->execute();

                    ?>
                    <label for="">Ürün Kategori</label>
                    <select id="akarselect" class="form-control" readonly>
                        <?php while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                            $kategoriId = $kategoricek['kategoriId']; ?>
                            <option <?php if ($kategoriId == $urunId) {  echo "selected='select'";  } ?> value="<?php echo $kategoricek['kategoriId']; ?>"><?php echo $kategoricek['kategoriAd']; ?></option>

                        <?php } ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="">Ürün Durumu</label>
                    <select id="akarselect" class="form-control" readonly>
                        <option value="1" <?php echo $uruncek['urunDurum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                        <option value="0" <?php if ($uruncek['urunDurum'] == 0) {
                                                echo 'selected=""';
                                            } ?>>Pasif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Ürün Resim</label><br>
                    <img width="400" src="../../<?php echo $uruncek['urunResim'] ?>" alt="">
                </div>

                <div class="form-group">
                    <label for="">Ürün Ad </label>
                    <input id="akarinput" type="text" readonly value="<?php echo $uruncek['urunAd'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Ürün Detay</label>
                    <textarea id="editor1" readonly placeholder="Ürün detayı..."><?php echo $uruncek['urunDetay'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Ürün Fiyat </label>
                    <input id="akarinput" type="text" readonly value="<?php echo $uruncek['urunFiyat'] ?>" class="form-control" required>
                </div>
                <input type="hidden" name="urunId" value="<?php echo $uruncek['urunId'] ?>">
                <div class="form-group">
                    <a href="urunler" class="btn btn-light btn-block">Ürünlere Dön</a>
                    <!-- <button type="submit" name="urunguncelle" class="btn btn-light btn-block">Güncelle</button> -->
                </div>
            </form>




        </div>
    </div>
</div>
</div>
<script>
    CKEDITOR.replace('editor1');
</script>
<?php require_once 'footer.php' ?>