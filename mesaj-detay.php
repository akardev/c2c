<?php
$title = "Mesaj Detayı";
require_once 'header.php';
islemkontrol();

$mesajsor = $db->prepare("SELECT mesaj.*, user.* FROM mesaj INNER JOIN user ON mesaj.userGonderen=user.userId where user.userId=:id and mesaj.mesajId=:mesajId order by mesajZaman DESC");
$mesajsor->execute(array(
    'id' => $_GET['userGonderen'],
    'mesajId' => $_GET['mesajId']
));

$mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['userIdMusteri'] == $mesajcek['userGelen'] and $mesajcek['mesajOkunma'] == 0) {
    $mesajguncelle = $db->prepare("UPDATE mesaj SET 
        mesajOkunma=:okuma   
        where mesajId={$_GET['mesajId']}");
    $mesajguncelle->execute([
        'okuma' => 1
    ]);
}




// if ($mesajcek['mesaj_okunma'] == 0) {
//     $mesajguncelle = $db->prepare("UPDATE mesaj SET
//       mesaj_okunma=:mesaj_okunma
//       WHERE mesaj_id={$_GET['mesaj_id']}");
//     $update = $mesajguncelle->execute(array(
//         'mesaj_okunma' => 1
//     ));
// }


?>

<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'mesaj-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <form action="sadmin/netting/user-islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section"> Mesaj Detayı</h2>
                            <div class="personal-info inner-page-padding">
                                <?php require_once 'alert.php' ?>
                                <div align="center">




                                    <div class="card">
                                        <img class="card-img-top img-circle" src="<?php echo $mesajcek['userResim'] ?>">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo $mesajcek['userAd'] . " " . $mesajcek['userSoyad'] ?> </h3><br>
                                            <b><textarea  style="height:150px; background-color: white"  class="form-control" ><?php echo $mesajcek['mesajDetay'] ?></textarea></b>

                                        </div>
                                    </div>
                                    <hr>

                                    <!-- giden mesaj detayına girdiğimizde textarea gelmesin -->
                                    <?php if (@$_GET['gidenmesaj'] != "ok") { ?>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <textarea style="height:100px;" name="mesajDetay" class="form-control" type="text" placeholder="cevap ver"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="userGelen" value="<?php echo $_GET['userGonderen'] ?>">

                                        <div class="form-group">
                                            <div align="center" class="col-sm-12">
                                                <button class="update-btn" name="mesajcevapver">Cevapla</button>
                                            </div>
                                        </div>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



<?php require_once 'footer.php'; ?>