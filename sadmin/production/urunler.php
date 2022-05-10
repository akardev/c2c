<?php require_once 'header.php';
$urunsor = $db->prepare("SELECT * FROM urun order by urunId DESC");
$urunsor->execute();
?>
<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold">Ürün Listesi</h4>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-secondary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Ürün Resim</th>
                            <th>Ürün Ad</th>
                            <th>Ürün Fiyat</th>
                            <th>Ürün Kategori</th>
                            <th></th>
                            <th></th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $say = 0;
                        while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                            $say++ ?>

                            <tr>
                                <th width="20"><?php echo $say ?></th>
                                <td style="width: 50px;"><img width="200" src="../../<?php echo $uruncek['urunResim'] ?>" alt=""></td>
                                <td><?php echo $uruncek['urunAd'] ?></td>
                                <td><?php echo $uruncek['urunFiyat'] ?> TL</td>
                                <td>
                                    <?php
                                    $kategoriId = $uruncek['kategoriId'];
                                    $kategorisor = $db->prepare("SELECT * FROM kategori where kategoriId=:id");
                                    $kategorisor->execute(array(
                                        'id' => $kategoriId
                                    ));
                                    $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
                                    echo $kategoricek['kategoriAd'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($uruncek['urunOneCikar'] == 0) { ?>
                                        <a href="../netting/admin-islem.php?urunId=<?php echo $uruncek['urunId'] ?>&urunone=1&urunOneCikar=ok"><button class="btn btn-info btn-xs">Öne Çıkar</button></a>
                                    <?php } elseif ($uruncek['urunOneCikar'] == 1) { ?>
                                        <a href="../netting/admin-islem.php?urunId=<?php echo $uruncek['urunId'] ?>&urunone=0&urunOneCikar=ok"><button class="btn btn-danger btn-xs">Kaldır</button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($uruncek['urunDurum'] == 0) { ?>
                                        <a href="../netting/admin-islem.php?urunId=<?php echo $uruncek['urunId'] ?>&urundurum=1&urunDurum=ok"><button class="btn btn-danger btn-xs">Pasif</button></a>
                                    <?php } elseif ($uruncek['urunDurum'] == 1) { ?>
                                        <a href="../netting/admin-islem.php?urunId=<?php echo $uruncek['urunId'] ?>&urundurum=0&urunDurum=ok"><button class="btn btn-success btn-xs">Aktif</button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="urun-gor?urunId=<?php echo $uruncek['urunId']; ?>" title="İncele" class="btn btn-secondary btn-sm "><i class="fa fa-eye"></i></a>
                                    <a onclick="return confirm('Ürünü silmek istiyor musunuz? \n Bu işlem geri alınamaz!')" href="../netting/admin-islem.php?urunId=<?php echo $uruncek['urunId']; ?>&urunsil=ok" title="sil" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>

<?php require_once 'footer.php'; ?>