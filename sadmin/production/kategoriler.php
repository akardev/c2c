<?php require_once 'header.php';
$kategorisor = $db->prepare("SELECT * FROM kategori order by kategoriSira ASC");
$kategorisor->execute();
?>
<div class="container-fluid">
    <div class="card shadow mb-4 bg-dark">
        <div class="card-header py-3 bg-dark text-white text-center">
            <h4 class="m-0 font-weight-bold">Kategori Listesi</h4>
            <small>
                <?php require_once 'alert.php'; ?>
            </small>
        </div>
        <div class="card-body">
            <div align="center">
                <a title="Kategori Ekle" class="btn btn-light btn-sm" href="kategori-ekle"><i class="fa fa-plus"></i> Kategori Ekle</a><br><br>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-secondary" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Kategori Ad</th>
                            <th>Kategori Sira</th>
                            <th></th>
                            <th></th>
                            <th style="width: 100px;">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $say = 0;
                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                            $say++ ?>

                            <tr>
                                <td width="20"><?php echo $say ?></td>
                                <td><?php echo $kategoricek['kategoriAd'] ?></td>
                                <td><?php echo $kategoricek['kategoriSira'] ?></td>
                                <td>
                                    <?php
                                    if ($kategoricek['kategoriOneCikar'] == 0) { ?>
                                        <a href="../netting/admin-islem.php?kategoriId=<?php echo $kategoricek['kategoriId'] ?>&kategorione=1&kategoriOneCikar=ok"><button class="btn btn-info btn-xs">Öne Çıkar</button></a>
                                    <?php } elseif ($kategoricek['kategoriOneCikar'] == 1) { ?>
                                        <a href="../netting/admin-islem.php?kategoriId=<?php echo $kategoricek['kategoriId'] ?>&kategorione=0&kategoriOneCikar=ok"><button class="btn btn-danger btn-xs">Kaldır</button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($kategoricek['kategoriDurum'] == 0) { ?>
                                        <a href="../netting/admin-islem.php?kategoriId=<?php echo $kategoricek['kategoriId'] ?>&kategoridurum=1&kategoriDurum=ok"><button class="btn btn-danger btn-xs">Pasif</button></a>
                                    <?php } elseif ($kategoricek['kategoriDurum'] == 1) { ?>
                                        <a href="../netting/admin-islem.php?kategoriId=<?php echo $kategoricek['kategoriId'] ?>&kategoridurum=0&kategoriDurum=ok"><button class="btn btn-success btn-xs">Aktif</button></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="kategori-duzenle?kategoriId=<?php echo $kategoricek['kategoriId']; ?>" title="Düzenle" class="btn btn-secondary btn-sm "><i class="fa fa-edit"></i></a>
                                    <a href="../netting/admin-islem.php?kategoriId=<?php echo $kategoricek['kategoriId']; ?>&kategorisil=ok" title="sil" class="btn btn-secondary btn-sm"><i class="fa fa-times"></i></a>
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