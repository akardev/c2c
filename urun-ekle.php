<?php
$title = "Ürün Ekle";
$activePage = "urun-ekle";
require_once 'header.php';
islemkontrol();
?>

<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="urun-ekle">Ürün Ekle</a><span></span></li>

            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <form action="sadmin/netting/user-islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Ürün Ekle</h2>
                            <div class="personal-info inner-page-padding">
                                <?php require_once 'alert.php' ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Fotoğraf </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunResim" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Kategori</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select name="kategoriId" class='select2'>

                                                <?php
                                                $kategorisor = $db->prepare("SELECT * FROM kategori order by kategoriSira ASC");
                                                $kategorisor->execute();
                                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <option value="<?php echo $kategoricek['kategoriId']; ?>"><?php echo $kategoricek['kategoriAd']; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Ad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunAd" placeholder="Ürün adını giriniz" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Detay</label>
                                    <div class="col-sm-9">
                                        <textarea id="editor1" name="urunDetay" placeholder="Ürün detayı..."></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Fiyatı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" required="" name="urunFiyat" placeholder="Ürün fiyatını giriniz" type="number">
                                    </div>
                                </div>





                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="urunekle">Ekle</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    CKEDITOR.replace('editor1');
</script>
<?php require_once 'footer.php'; ?>