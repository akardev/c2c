<?php
$title = "Gelen Mesajlar";
$activePage = "gelen-mesajlar";
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
            <?php require_once 'mesaj-sidebar.php' ?>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="settings-details tab-content">
                    <div class="tab-pane fade active in" id="Personal">
                        <h2 class="title-section">Gelen Mesajlar </h2>

                        <div class="personal-info inner-page-padding">

                            <?php require_once 'alert.php'; ?>
                            <br>
                            <div class="table-responsive ">
                                <table class="table table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $mesajsor = $db->prepare("SELECT mesaj.*, user.* FROM mesaj INNER JOIN user ON mesaj.userGonderen=user.userId where mesaj.userGelen=:id order by mesajZaman DESC");
                                        $mesajsor->execute([
                                            'id' => $_SESSION['userIdMusteri']


                                        ]);


                                        while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {

                                            $userGonderen = $mesajcek['userGonderen'];
                                        ?>

                                            <tr>
                                                <td>
                                             <a  <?php if ($mesajcek['userMagaza']==2) { ?>  href="satici-<?=seo($mesajcek['userAd']."-".$mesajcek['userSoyad'])."-".$mesajcek['userId'] ?>"  <?php  } ?>>
                                               <img width="50" class="img-circle" src="<?php echo $mesajcek['userResim'] ?>" alt=""></a></td>
                                                <td><?php echo $mesajcek['userAd'] . " " . $mesajcek['userSoyad'] ?></td>
                                                <?php $mesajZaman = $mesajcek['mesajZaman'] ?>
                                                <td><?php echo trdate(" j F Y H:i", $mesajZaman) ?></td>
                                                <td>
                                                    <?php
                                                    if ($mesajcek['mesajOkunma'] == 0) { ?>

                                                        <button class="btn-xs btn btn-danger">Okunmamış</button>

                                                        <?php } else { ?>

                                                            <i style="color: green;" class="fa fa-check-circle" aria-hidden="true"> Okundu</i>
                                                        <?php }  ?>
                                                </td>
                                                <td><a href="mesaj-detay?mesajId=<?php echo $mesajcek['mesajId'] ?>&userGonderen=<?php echo $mesajcek['userGonderen'] ?>"><button class="btn btn-primary btn-xs">Mesajı Gör</button></a></td>
                                                <td><a onclick="return confirm('Bu mesajı silmek istiyor musunuz? \nİşlem geri alınamaz!')" href="sadmin/netting/user-islem.php?gelenmesajsil=ok&mesajId=<?php echo $mesajcek['mesajId'] ?>"><button class="btn btn-danger btn-xs">Sil</button></a>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>


