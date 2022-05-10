<?php require_once 'header.php';

$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizdaId=:id");
$hakkimizdasor->execute(array(
  'id' => 0
  ));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


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
                    <label for="">Hakkımızda</label>
                    <textarea id="editor1" name="hakkimizdaBilgi"><?php echo @$hakkimizdacek['hakkimizdaBilgi']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Vizyon</label>
                    <input id="akarinput" type="text" name="hakkimizdaVizyon" value="<?php echo @$hakkimizdacek['hakkimizdaVizyon'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Misyon</label>
                    <input id="akarinput" type="text" name="hakkimizdaMisyon" value="<?php echo @$hakkimizdacek['hakkimizdaMisyon'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input id="akarinput" type="text" name="hakkimizdaVideo" value="<?php echo @$hakkimizdacek['hakkimizdaVideo'] ?>" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" name="hakkimizdaguncelle" class="btn btn-light btn-block">Güncelle</button>
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