<?php
$title = "Adres Bilgilerim";
$activePage = "adres-bilgileri";
require_once 'header.php';
islemkontrol();


?>

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
            <?php require_once 'hesap-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">


                <form class="form-horizontal" id="personal-info-form" action="sadmin/netting/user-islem.php" method="post">
                    <div class="settings-details tab-content">
                        <div class="tab-pane fade active in" id="Personal">
                            <h2 class="title-section">Adres Bilgilerim</h2>
                            <div class="personal-info inner-page-padding">
                                <?php require_once 'alert.php' ?>  
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Bireysel/Kurumsal</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select class='select2' name="userTip" id="usertip">

                                                <option <?php
                                                        if ($usercek['userTip'] == "PERSONAL") {
                                                            echo "selected";
                                                        }
                                                        ?> value="PERSONAL">Bireysel
                                                </option>

                                                <option <?php
                                                        if ($usercek['userTip'] == "PRIVATE_COMPANY") {
                                                            echo "selected";
                                                        }
                                                        ?> value="PRIVATE_COMPANY">Kurumsal
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="kurumsal">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Ünvan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userUnvan" value="<?php echo $usercek['userUnvan']; ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Vergi Dairesi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userVDaire" value="<?php echo $usercek['userVDaire']; ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Vergi No</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userVNo" value="<?php echo $usercek['userVNo']; ?>" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div id="tc" class="form-group">
                                    <label class="col-sm-3 control-label">T.C Kimlik Numarası</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userTc" value="<?php echo $usercek['userTc'] ?>" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Adres</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userAdres" value="<?php echo $usercek['userAdres'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İl</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userIl" value="<?php echo $usercek['userIl'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İlçe</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="userIlce" value="<?php echo $usercek['userIlce'] ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div align="right" class="col-sm-12">
                                        <button class="update-btn" name="musteriadresguncelle">Güncelle</button>
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

<script type="text/javascript">
    $(document).ready(function() {

        $("#usertip").change(function() {

            var tip = $("#usertip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#tc").show();

            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#tc").hide();

            }


        }).change();


    });
</script>