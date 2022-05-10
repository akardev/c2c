<?php require_once 'header.php';
$usersor = $db->prepare("SELECT * FROM user");
$usersor->execute();
?>
<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold ">Kullanıcı Listesi </h4>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-secondary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Kayıt Tarihi</th>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Mail Adresi</th>
                            <th>Telefon</th>
                            <th style="width: 100px;">İşlemler</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($usercek = $usersor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><img src=""></td>
                                <td><?php echo $usercek['userZaman'] ?></td>
                                <td><?php echo $usercek['userAd']; ?></td>
                                <td><?php echo $usercek['userSoyad'] ?></td>
                                <td><?php echo $usercek['userMail'];
                                    if ($usercek['userYetki'] == 5) { ?> <span class="badge badge-danger float-right">Admin</span> <?php } ?></td>
                                <td><?php echo $usercek['userGsm'] ?></td>
                                <td>
                                    <a title="Düzenle" class="btn btn-dark btn-sm" href="kullanici-duzenle?userId=<?php echo $usercek['userId']; ?>"><i class="fa fa-edit"></i></a>
                                    <?php if ($usercek['userYetki'] != 5) {  ?>
                                        <a title="Sil" class="btn btn-dark btn-sm" href="../netting/admin-islem.php?userId=<?php echo $usercek['userId']; ?>&usersil=ok"><i class="fa fa-times"></i></a>
                                    <?php  } ?>

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

<?php require_once 'footer.php' ?>