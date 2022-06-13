<?php include "header.php"; ?>
    <!DOCTYPE html>

    <html lang="tr">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="css/owl.carousel.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    </head>
    <body>
    
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            <?php


            $slidersorgu = $db->prepare("Select * from tblslider where sliderDurumu=:durum ORDER BY sliderSira ASC limit 5 ");
            $slidersorgu->execute(array('durum' => 1));

            while ($slidercek = $slidersorgu->fetch(PDO::FETCH_ASSOC)) { ?>

                <div class="hs-item set-bg" data-setbg="<?php echo $slidercek['sliderResimYol']?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 text-white">
                                <h2><?php echo $slidercek['sliderAd']?></h2>
                                <p><?php echo $slidercek['sliderDetay']?></p>
                                <a href="<?php echo $slidercek['sliderLink']?>" class="site-btn sb-white">Ürüne Git</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }?>

    </section>

    <?php include "one-cikan-urunler.php"?>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/main.js"></script>


    </body>
    </html>

<?php include "footer.php"; ?>