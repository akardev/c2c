<?php

header('Content-type: application/xml; charset="utf8"', true);

?>


<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:example="http://www.example.com/schemas/example_schema">
    <!-- namespace extension -->

    <?php
    require_once 'sadmin/netting/db.php';
    require_once 'sadmin/netting/function.php';
    ?>

    <url>
        <loc>https://<?php $_SERVER['HTTP_HOST']; ?>/kategoriler</loc>
        <lastmod><?php echo date("Y-m-d"); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>



<!-- ürün linkleri  -->
    <?php
    $urunsor->$db->prepare("SELECT * FROM urun where urunDurum=:durum");
    $urunsor->execute([
        'durum' => 1
    ]);
    while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <url>
            <loc>https://<?php $_SERVER['HTTP_HOST']; ?>/urun-<?php echo seo($uruncek['urunAd']) ?>- <?php echo $uruncek['urunId'] ?></loc>
            <lastmod><?php echo date("Y-m-d"); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>

    <?php } ?>


</urlset>