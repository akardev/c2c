<?php 

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   
    header("Location:404");
  
 }

?>


<div class="fox-sidebar">
    <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">Kategoriler</h3>
            
            <ul class="sidebar-categories-list">
            <?php

                $kategorisor = $db->prepare("SELECT * FROM kategori where kategoriDurum=:durum order by kategoriSira ASC");
                $kategorisor->execute([
                    'durum' => 1
                ]);

                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                    $kategoriId = $kategoricek['kategoriId'];  ?>
                    <li><a href="kategori-<?= seo($kategoricek['kategoriAd']) . "-" . $kategoricek['kategoriId'] ?>"><?php echo $kategoricek['kategoriAd'] ?><span>(
                                <?php
                                $katsay = $db->prepare("SELECT COUNT(kategoriId) as say FROM urun where kategoriId=:id and urunDurum=:durum");
                                $katsay->execute([
                                    'id' => $kategoriId,
                                    'durum' => 1
                                ]);
                               
                                $cek = $katsay->fetch(PDO::FETCH_ASSOC);
                                echo $cek['say'];


                                ?>


                                )</span></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
    <!-- <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">Price Range</h3>
            <div id="price-range-wrapper" class="price-range-wrapper">
                <div id="price-range-filter"></div>
                <div class="price-range-select">
                    <div class="price-range" id="price-range-min"></div>
                    <div class="price-range" id="price-range-max"></div>
                </div>
                <button class="sidebar-full-width-btn disabled" type="submit" value="Login"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
            </div>
        </div>
    </div> -->

</div>