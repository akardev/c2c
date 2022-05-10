<?php require_once 'header.php' ?>

<div class="container-fluid">

    <!-- 
    <div class="d-sm-flex  justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sitenizin içeriğini yandaki menüler aracılığı ile yönetebilirsiniz.</h1>
    </div> -->

    <div class=" d-sm-flex justify-content-center">
        <a href="http://localhost/c2cplatform/" target="_blank" class="btn btn-sm btn-dark "><i class="fas fa-eye fa-sm text-white-50"></i> Siteyi Görüntüle</a>

    </div>

    <div class=" d-sm-flex justify-content-center">
        <div id="hosgeldin" class="card mt-2">
            <div class="card-body">
                <h5 class="card-title text-center">Hoşgeldin, <?php echo $usercek['userAd']." ".$usercek['userSoyad'] ?></h5>
                <p class="card-text">Sitenizin içeriğini yandaki menüler aracılığıyla yönetebilirsiniz...</p>
            </div>
        </div>
    </div>


</div>
</div>
<?php require_once 'footer.php' ?>