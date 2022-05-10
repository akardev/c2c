<?php 

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
   
    header("Location:404");
  
 }
 
?>
<footer>
    <div class="footer-area-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-box">
                        <h3 class="title-bar-left title-bar-footer">Öne Çıkan Kategoriler</h3>
                        <ul class="featured-links">
                            <li>
                                <ul>
                                <?php
                                $kategorisor = $db->prepare("SELECT * FROM kategori where kategoriOneCikar=:onecikar order by kategoriSira ASC");
                                $kategorisor->execute([
                                    'onecikar' => 1
                                ]);

                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {  ?>
                                    <li><a href="kategori-<?= seo($kategoricek['kategoriAd']) . "-" . $kategoricek['kategoriId'] ?>"><?php echo $kategoricek['kategoriAd'] ?></a></li>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-box">
                    <h3 class="title-bar-left title-bar-footer"><a style="color: green;" href="hakkimizda">Biz Kimiz?</a></h3>
                        <ul class="corporate-address">

                            <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo $ayarcek['ayarTel'] ?></li>
                            <li><i class="fa fa-fax" aria-hidden="true"></i><?php echo $ayarcek['ayarGsm'] ?></li>
                            <li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo $ayarcek['ayarMail'] ?></li>
                        </ul>
                    </div>
                </div>
                
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-box">
                        <h3 class="title-bar-left title-bar-footer"><a style="color: green;" href="hakkimizda">Biz Kimiz?</a></h3>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-box">
                        <h3 class="title-bar-left title-bar-footer">Sosyal medyada bizi takip et!</h3>
                        <ul class="footer-social">
                            <li><a href="<?php echo $ayarcek['ayarFacebook']; ?>" target="_blank"><i class="fa fa-facebook"  aria-hidden="true"></i></a></li>

                            <li><a href="<?php echo $ayarcek['ayarTwitter']; ?>" target="_blank"><i class="fa fa-twitter"   aria-hidden="true"></i></a></li>

                            <li><a href="<?php echo $ayarcek['ayarYoutube']; ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        </ul>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="newsletter-area">
                            <h3>Bültene üye ol!</h3>
                            <div class="input-group stylish-input-group">
                                <input type="text" placeholder="e-posta adresinizi giriniz" class="form-control">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-area-bottom">
        <div class="container">
            <p> &copy; <?php echo $ayarcek['ayarAuthor']; ?> | 2022</p>
        </div>
    </div>
</footer>
<!-- Footer Area End Here -->
</div>
<!-- Main Body Area End Here -->
<!-- jquery-->
<script src="js\jquery-2.2.4.min.js" type="text/javascript"></script>

<!-- Plugins js -->
<script src="js\plugins.js" type="text/javascript"></script>

<!-- Bootstrap js -->
<script src="js\bootstrap.min.js" type="text/javascript"></script>

<!-- WOW JS -->
<script src="js\wow.min.js"></script>

<!-- Owl Cauosel JS -->
<script src="vendor\OwlCarousel\owl.carousel.min.js" type="text/javascript"></script>

<!-- Meanmenu Js -->
<script src="js\jquery.meanmenu.min.js" type="text/javascript"></script>

<!-- Srollup js -->
<script src="js\jquery.scrollUp.min.js" type="text/javascript"></script>

<!-- Select2 Js -->
<script src="js\select2.min.js" type="text/javascript"></script>

<!--  -->

<!-- jquery.counterup js -->
<script src="js\jquery.counterup.min.js"></script>
<script src="js\waypoints.min.js"></script>

<!-- Isotope js -->
<script src="js\isotope.pkgd.min.js" type="text/javascript"></script>

<!-- Gridrotator js -->
<script src="js\jquery.gridrotator.js" type="text/javascript"></script>

<!-- Custom Js -->
<script src="js\main.js" type="text/javascript"></script>








</body>
<!--  -->
</html>