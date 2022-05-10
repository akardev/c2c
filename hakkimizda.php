<?php require_once 'header.php';
$hakkimizdasor = $db->prepare("SELECT * FROM hakkimizda where hakkimizdaId=:id");
$hakkimizdasor->execute(array(
    'id' => 0
));
$hakkimizdacek = $hakkimizdasor->fetch(PDO::FETCH_ASSOC); ?>
<div class="inner-banner-area">
    <div class="container">

    </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- About Page Start Here -->
<div class="about-page-area bg-secondary section-space-bottom">
    <div class="container">
        <h2 class="title-section">AKARDEV C2C</h2>
        <div class="inner-page-details inner-page-padding">
            <h3>Hakkımızda</h3>
            <p><?php echo @$hakkimizdacek['hakkimizdaBilgi']; ?></p>
            <h3>Vizyon</h3>
            <p><?php echo @$hakkimizdacek['hakkimizdaVizyon']; ?></p>
            <h3>Misyon</h3>
            <p><?php echo @$hakkimizdacek['hakkimizdaMisyon']; ?></p>
            <div align="center">
            <h2>Tanıtım Videosu</h2>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $hakkimizdacek['hakkimizdaVideo'] ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>