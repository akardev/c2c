<?php
$title = "Mesajlar";
require_once 'header.php';
islemkontrol();

$usersor = $db->prepare("SELECT * FROM user where userId=:id");
$usersor->execute(array(
    'id' => $_GET['userGelen']
));

$usercek = $usersor->fetch(PDO::FETCH_ASSOC);


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
                <form action="sadmin/netting/user-islem.php" method="POST" enctype="multipart/form-data" class="form-horizontal" id="personal-info-form">

                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section"> Mesaj Gönder</h2>
                            <div class="personal-info inner-page-padding">
                                <?php require_once 'alert.php' ?>

                                <!-- MESAJ GÖNDERİLEN KULLANICI -->
                                <div align="center">
                                    <div class="card" style="width: 18rem;">
                                        <div card-title>
                                            <h3><?php echo @$usercek['userAd'] . " " . @$usercek['userSoyad'] ?> </h3>
                                        </div>
                                        <img class="card-img-top img-circle" src="<?php echo @$usercek['userResim'] ?>" alt="Card image cap">

                                    </div>
                                </div>

                                <br>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea style="height:100px;" name="mesajDetay" class="form-control" type="text" placeholder="mesajınız..."></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="userGelen" value="<?php echo $_GET['userGelen'] ?>">
                                
                                <div class="form-group">
                                    <div align="center" class="col-sm-12">
                                        <button class="update-btn" name="mesajgonder">Gönder</button>

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



<?php require_once 'footer.php'; ?>