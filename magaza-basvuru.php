<?php
$title = "Mağaza Başvuru";
$activePage = "magaza-basvuru";
require_once 'header.php';
islemkontrol();
?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="magaza-basvuru">Mağaza Başvuru</a><span></span></li>

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

                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Mağaza Başvurusu</h2>
                        <div class="personal-info inner-page-padding">
                            <?php require_once 'alert.php' ?>
                            <?php
                            if ($usercek['userMagaza'] == 0) { ?>


                                <div class="alert alert-warning" role="alert">
                                    <p><b><i>Başvuru işleminizi tamamlamak için lütfen aşağıda yer alan tüm bilgilerinizi eksiksiz ve doğru bir şekilde giriniz. Eksik ya da hatalı bir bilgi olduğunda başvuru işleminize devam edilmeyecektir.</i></b></p>
                                </div>

                                <form action="sadmin/netting/user-islem.php" method="POST" class="form-horizontal" id="personal-info-form">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Banka Adı</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userBanka" value="<?php echo $usercek['userBanka']; ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">IBAN Numaranız</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userIban" value="<?php echo $usercek['userIban']; ?>" type="text">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-Posta</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" disabled="" value="<?php echo $usercek['userMail']; ?>" type="text">
                                        </div>
                                    </div>

                                  

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Telefon Numarası</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="userGsm" value="<?php echo $usercek['userGsm']; ?>" type="text" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Bireysel/Kurumsal</label>
                                        <div class="col-sm-9">
                                            <div class="custom-select">
                                                <select name="userTip" id="usertip" class='select2'>

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


                                    <div id="tc">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">T.C Kimlik Numarası</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" required name="userTc" value="<?php echo $usercek['userTc']; ?>" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="kurumsal">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Firma Ünvan</label>
                                            <div class="col-sm-9">
                                                <input class="form-control"  name="userUnvan" value="<?php echo $usercek['userUnvan']; ?>" type="text">
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

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Adres</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required name="userAdres" value="<?php echo $usercek['userAdres']; ?>" type="text" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">İl</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required="" name="userIl" value="<?php echo $usercek['userIl']; ?>" type="text" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">İlçe</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" required="" name="userIlce" value="<?php echo $usercek['userIlce']; ?>" type="text" required>
                                        </div>
                                    </div>



                                    <div align="right" class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="checkbox">
                                            <div class="col-sm-12">
                                                <label style="background-color: #FFF8DC"><input type="checkbox" required="" value=""><strong>Kullanım şartlarını kabul ediyorum</strong> </label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div align="right" class="col-sm-12">
                                            <button class="update-btn" name="musterimagazabasvuru">Başvuruyu Tamamla</button>

                                        </div>
                                </form>
                            <?php } else if ($usercek['userMagaza'] == 1) { ?>
                                <div class="alert alert-success">
                                    <strong><i>Mağaza başvurunuz onay aşamasındadır...</i></strong>
                                    <p><i>Başvurular 1-3 iş günü içerisinde sonuçlanır.</i> </p>
                                </div>

                            <?php } else if ($usercek['userMagaza'] == 2) { ?>
                                <div class="alert alert-success">
                                    <strong><i>Mağaza başvurunuz onaylanmıştır.</i></strong>
                                    <p><i>Mağaza yönetim menüsünden mağazanızı yönetebilirsiniz.</i> </p>
                                </div>

                            <?php } else if ($usercek['userMagaza'] == 3) { ?>
                                <div class="alert alert-danger">
                                    <strong><i>Mağaza başvurunuz reddedilmiştir.</i></strong>
                                </div>
                                <form method="post" action="sadmin/netting/user-islem.php">
                                <button name="yenimagazabasvuru" class="btn btn-primary">Yeni başvuru yap</button>
                                </form>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
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