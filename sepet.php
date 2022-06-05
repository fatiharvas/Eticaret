<?php include "header.php"; include "admin/controller/baglan.php";

$sorgu = $db->prepare("select * from tblsepet,tblurunler,tblkullanicilar,tblurunfoto where tblurunler.urun_id = tblurunfoto.urun_id and tblurunler.urun_id = tblsepet.urun_id and tblkullanicilar.kullanici_id = tblsepet.kullanici_id and tblkullanicilar.kullanici_mail='{$_SESSION['user_mail']}' group by tblurunfoto.urun_id order by sepet_id desc ");
$sorgu->execute();

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aliışveriş Sepetim</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/sepet.css" type="text/css">
</head>

<body>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">

                    <table>
                        <thead>
                        <tr>
                            <th>Ürün</th>
                            <th>Adet</th>
                            <th>Fiyat</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $toplamFiyat = 0;

                        while ($sepet = $sorgu->fetch(PDO::FETCH_ASSOC)) {

                            $toplamFiyat += $sepet['satis_fiyat']*$sepet['urun_adet'];
                            ?>

                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img width="80px" src="<?php echo $sepet['resim_yol']?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6><?php echo $sepet['urun_ad']?></h6>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity" >
                                        <div class="pro-qty-2" style="text-align: center">
                                            <span><?php echo $sepet['urun_adet']?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price"><?php echo $sepet['urun_adet']*$sepet['satis_fiyat']."₺";?></td>
                                <td class="cart__close"><a href="admin/controller/SepetController.php?sepet_id=<?php echo $sepet['sepet_id'] ?>&sepetsil=ok"><i class="fa fa-close"></i></a></td>
                            </tr>


                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="kategoriler.php">Alışverişe Devam Et</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Sepet Toplamı</h6>
                    <h6>
                        <?php if ($_GET['durum']=="ok") {?>
                            <b style="color:green;">İşlem Başarılı...</b>

                        <?php } elseif ($_GET['durum']=="no") {?>

                            <b style="color:red;">İşlem Başarısız...</b>

                        <?php } ?>
                    </h6>
                    <ul>
                        <li>Toplam fiyat <span><?php echo $toplamFiyat."₺"?></span></li>
                    </ul>
                    <a href="teslimat.php" class="primary-btn">Ödeme Sayfasına Geçin</a>
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
</body>

</html>