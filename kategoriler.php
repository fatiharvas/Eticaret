
<?php include "header.php"; ?>

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
<link rel="stylesheet" href="css/nice-select.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="css/style2.css" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
      rel="stylesheet">


<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Kategoriler</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php
                                                $sorgu = $db ->prepare("select * from tblkategori where kategori_durum = 1 order by kategori_sira ASC ;");
                                                $sorgu -> execute();

                                                while ($kategoriCek = $sorgu ->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <li><a href="kategoriler.php?kategori_id=<?php echo $kategoriCek['kategori_id']?>"><?php echo $kategoriCek['kategori_ad']?></a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">

                    <?php if ($_GET['kategori_id']) {

                        $sorgu = $db -> prepare("select * from tblurunler,tblurunfoto where tblurunler.urun_id = tblurunfoto.urun_id and urun_durum = 1 and kategori_id={$_GET['kategori_id']} and is_profile = 1");
                        $sorgu->execute();

                       }else {

                        $sorgu = $db ->prepare("select * from tblurunler,tblurunfoto where tblurunler.urun_id = tblurunfoto.urun_id and urun_durum = 1 and is_profile = 1");
                        $sorgu -> execute();

                        }

                        while ($urunCek = $sorgu ->fetch(PDO::FETCH_ASSOC)) { ?>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo $urunCek['resim_yol']?>">

                                    </div>
                                    <div class="product__item__text">
                                        <h6><?php echo $urunCek['urun_ad']?></h6>
                                        <a href="urun-detay.php?urun_id=<?php echo $urunCek['urun_id']?>" class="add-cart">Ürün Detay</a>
                                        <h5><?php echo $urunCek['satis_fiyat']."₺"?></h5>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>

<?php include "footer.php"?>