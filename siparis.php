<?php include "header.php"; include "admin/controller/baglan.php";
ob_start();session_start();
$sorgu = $db->prepare("select * from tblsiparis,tblkullanicilar,tbladres where tblsiparis.kullanici_id = tblkullanicilar.kullanici_id and tblsiparis.adres_id = tbladres.adres_id and tblkullanicilar.kullanici_mail='{$_SESSION['user_mail']}' order by tblsiparis.siparis_id desc");
$sorgu->execute();

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <title>Sipraişlerim</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/siparis.css">


</head>
<body>

<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row" style="margin-top: -80px">
            <div class="col-lg-12 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table" style="width: 100%">
                        <thead class="cart-table-head">
                        <tr class="table-head-row">
                            <th class="product-image">Sipariş No</th>
                            <th class="product-name">Sipraiş Zamanı</th>
                            <th class="product-price">Sipariş Toplamı</th>
                            <th class="product-price">Sipariş Durumu</th>
                            <th class="product-price">Sipariş Detay</th>
                            <th class="product-price">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                            while ($siparis = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>

                                <tr class="table-body-row">
                                    <td><?php echo $siparis['siparis_id']?></td>
                                    <td><?php echo $siparis['siparis_zaman']?></td>
                                    <td><?php echo $siparis['siparis_toplam']?></td>
                                    <td>
                                        <?php
                                            if ($siparis['siparis_durum'] == null) { ?>
                                                <span>Sipariş İptal Edildi</span>
                                            <?php }else if($siparis['siparis_durum']){ ?>
                                                <span>Sipariş Teslim Edildi</span>
                                            <?php }else { ?>
                                                <span>Sipariş İşleme Alındı</span>
                                            <?php }?>
                                    </td>
                                    <td>
                                        <a class="boxed-btn" href="siparis-detay.php?siparis_id=<?php echo $siparis['siparis_id']?>">Sipariş Detayı</a>
                                    </td>

                                    <td>
                                        <?php
                                        if ($siparis['siparis_durum']) { ?>
                                            <span>İşlem Bulunmuyor</span>
                                        <?php }else if($siparis['siparis_durum'] == null){ ?>
                                            <span>Sipariş İptal Edildi</span>
                                        <?php }else { ?>
                                            <a class="boxed-btn" href="admin/controller/OdemeController.php?siparis_id=<?php echo $siparis['siparis_id'];?>&siparissil=ok">
                                                <i class="flaticon-remove"></i>
                                                Siparişi İptal Et
                                            </a>
                                        <?php }?>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include "footer.php"?>

</body>
</html>