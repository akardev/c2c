<?php


if (!$_GET['siparisId']) {

basename($_SERVER['PHP_SELF']) == basename(__FILE__);
   
    header("Location:404");
  
 } 


 
require_once 'header.php';

?>

<div class="inner-banner-area">
    <div class="container">

    </div>
</div>
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

            <div align="center" class="alert alert-success">

                <p><b><?php echo @$_GET['siparisId']  ?></b> numaralı siparişiniz alınmıştır. <br> Siparişlerim sayfasından onay verebilirsiniz</p>
                <hr>
                <p style="color: black" class="mb-0"><a href="siparislerim">Siparişlerim </a> sayfasına buraya tıklayak ulabilirsiniz.</p>
            </div>

        </div>
    </div>
</div>
<div class="about-page-area bg-secondary section-space-bottom">
    <div class="container">


    </div>
</div>

<?php
require_once 'footer.php';
?>































<!-- <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div> -->