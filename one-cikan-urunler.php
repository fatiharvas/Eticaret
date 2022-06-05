<?php include "admin/controller/baglan.php";

$sorgu = $db->prepare("select * from tblurunler,tblurunfoto where tblurunler.urun_id = tblurunfoto.urun_id and one_cikar = 1 group by tblurunler.urun_id limit 5");
$sorgu->execute();

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/core-style.css">


</head>

<body>
<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Öne Çıkan Ürünler</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">

                    <?php

                        while ($uruncek = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>
                            <div class="single-product-wrapper">
                                <div class="product-img" style="width: 250px; height: 250px">
                                    <img src="<?php echo $uruncek['resim_yol']?>" alt="">
                                </div>

                                <div class="product-description">

                                    <h6><?php echo $uruncek['urun_ad']?></h6>

                                    <p class="product-price"><?php echo $uruncek['satis_fiyat']."₺"?></p>
                                    <div class="hover-content">
                                        <div class="add-to-cart-btn">
                                            <a href="urun-detay.php?urun_id=<?php echo $uruncek['urun_id'] ?>" class="btn essence-btn">Ürüne Git</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                </div>
            </div>
        </div>
</section>

<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/classy-nav.min.js"></script>
<script src="js/active.js"></script>

</body>

</html>