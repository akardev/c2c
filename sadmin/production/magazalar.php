<?php require_once 'header.php';
$usersor = $db->prepare("SELECT * FROM user where userMagaza=:magaza");
$usersor->execute([
    'magaza' => 2
]);

?>


<div class="container-fluid">

    <div class="card shadow mb-4 bg-dark">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold ">Mağazalar</h4>
            <small>
            <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-secondary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>BİREYSEL/KURUMSAL</th>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Mail Adresi</th>
                            <th>Telefon</th>
                            <th style="width: 150px;">İşlemler</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($usercek = $usersor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $usercek['userTip'] ?></td>
                                <td><?php echo $usercek['userAd'] ?></td>
                                <td><?php echo $usercek['userSoyad'] ?></td>
                                <td><?php echo $usercek['userMail'] ?></td>
                                <td><?php echo $usercek['userGsm'] ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="magaza-gor?userId=<?php echo $usercek['userId']; ?>"><i class="fa fa-eye"></i> Mağazayı Gör</a>
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