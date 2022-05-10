<?php
require_once 'header.php';

$urunsor = $db->prepare("SELECT urun.*, user.* FROM urun INNER JOIN user ON urun.userId=user.userId where urunId=:id and urunDurum=:durum");
$urunsor->execute(array(
    'id' => @$_POST['urunId'],
    'durum' => 1
));

$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>

<div class="product-details-page bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">

                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Ürün Bilgisi</th>
                                    <th style="width:10%">Fiyat</th>
                                    <th style="width:22%" class="text-center">Satıcı</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img style="width: 60px; height: 60px; " src="<?php echo $uruncek['urunResim']; ?>" alt="<?php echo $uruncek['urunAd']; ?>" class="img-responsive" /></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin"><?php echo $uruncek['urunAd']; ?></h4>
                                                <!-- echo mb_substr($uruncek['urunDetay'], 0,150,'UTF-8') -->
                                                <p><?php echo $uruncek['urunDetay'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><?php echo $uruncek['urunFiyat']; ?> TL</td>
                                    <td data-th="Subtotal" class="text-center"><?php echo $uruncek['userAd'] . " " . $uruncek['userSoyad'] ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><button onclick="geridon()" class="btn btn-danger"><i class="fa fa-angle-left"></i> Geri Dön</button></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <form action="sadmin/netting/user-islem.php" method="POST">
                                        <input type="hidden" name="userIdSatici" value="<?php echo $uruncek['userId'] ?>">
                                        <input type="hidden" name="urunId" value="<?php echo $uruncek['urunId']  ?>">
                                        <input type="hidden" name="urunFiyat" value="<?php echo $uruncek['urunFiyat']  ?>">
                                        <td><button name="sipariskaydet" type="submit" class="btn btn-success btn-block">Siparişi Tamamla <i class="fa fa-angle-right"></i></button></td>
                                    </form>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require_once 'footer.php';
?>

<script type="text/javascript">
    function geridon() {

        window.history.back();
    }
</script>