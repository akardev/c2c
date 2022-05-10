<?php 

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   
    header("Location:404");
  
 }

?>


<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <p class="btn btn-success  btn-block">Mesajlar</p>
    <ul class="settings-title">
        <li <?php if (@$activePage == "gelen-mesajlar") { ?> class="active" <?php } ?>><a href="gelen-mesajlar">Gelen Mesajlar</a></li>
        <li <?php if (@$activePage == "giden-mesajlar") { ?> class="active" <?php } ?>><a href="giden-mesajlar">Giden Mesajlar</a></li>
    </ul>
</div>