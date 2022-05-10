<?php
if (isset($_GET['durum'])) {
    if ($_GET['durum'] == "ok") { ?>
        <div align="center" class="alert alert-success">
            <b>İşlem Başarılı...</b>
        </div>
    <?php } elseif ($_GET['durum'] == "no") { ?>
        <div align="center" class="alert alert-danger">
            <b>İşlem Başarısız...</b>
        </div>
<?php }
}

?>