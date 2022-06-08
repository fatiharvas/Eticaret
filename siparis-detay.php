<?php  include "admin/controller/baglan.php"; include "admin/controller/Fonksiyonlar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">


    <title>Sipariş Detay</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css2/bootstrap.min.css">
    <link rel="stylesheet" href="css/siparis.css">


</head>
<body>


<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Ürün Bilgileri
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <table class="table-active" style="text-align: center; width: 100%">
                                            <thead class="table-header">
                                                <tr>
                                                    <th></th>
                                                    <th>Ürün</th>
                                                    <th>Ürün Adet</th>
                                                    <th>Ürün Fiyat</th>
                                                </tr>
                                            </thead>

                                            <tbody class="table-body">

                                                    <?php

                                                    $sorgu = $db->prepare("select * from tblsiparis,tblsiparisdetay,tblurunler,tblurunfoto,tbladres where tblsiparis.adres_id = tbladres.adres_id and tblsiparis.siparis_id = tblsiparisdetay.siparis_id and tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunfoto.urun_id = tblurunler.urun_id and tblurunfoto.is_profile = 1 and tblsiparisdetay.siparis_id={$_GET['siparis_id']}");
                                                    $sorgu->execute();

                                                    while ($urun = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>
                                                        <tr>
                                                            <td>
                                                                <img width="50px" style="margin-bottom: 10px" src="<?php echo $urun['resim_yol']?>" alt="">
                                                            </td>
                                                            <td><?php echo $urun['urun_ad']?></td>
                                                            <td><?php echo $urun['urun_adet']?></td>
                                                            <td><?php echo $urun['urun_fiyat']?></td>
                                                        </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card single-accordion">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Adres Bilgileri
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="shipping-address-form">
                                        <?php

                                        $sorgu = $db->prepare("select * from tblsiparis,tblsiparisdetay,tblurunler,tblurunfoto,tbladres where tblsiparis.adres_id = tbladres.adres_id and tblsiparis.siparis_id = tblsiparisdetay.siparis_id and tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunfoto.urun_id = tblurunler.urun_id and tblurunfoto.is_profile = 1 and tblsiparisdetay.siparis_id={$_GET['siparis_id']}");
                                        $sorgu->execute();
                                        $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

                                        ?>
                                        <p><b>Ad : </b><?php echo $urun['ad']?></p>
                                        <p><b>Soyad : </b><?php echo $urun['soyad']?></p>
                                        <p><b>İl : </b><?php echo $urun['il']?></p>
                                        <p><b>İlçe : </b><?php echo $urun['ilce']?></p>
                                        <p><b>Adres : </b><?php echo $urun['adres']?></p>
                                        <p><b>Telefon : </b><?php echo $urun['telefon']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card single-accordion">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Kart Bilgileri
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="card-details">
                                        <p><b>Kart Numarası : </b><?php echo hideInformation($urun['kart_numarasi'],0,4)?></p>
                                        <p><b>Son Kullanma Tarihi : </b><?php echo $urun['son_kullanma_tarihi']?></p>
                                        <p><b>CVV : </b><?php echo $urun['cvv']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-details-wrap">
                    <table class="order-details" style="text-align: center" width="100%">
                        <thead>
                            <tr>
                                <th>Sipariş Detayı</th>
                                <th>Ürün Adet</th>
                                <th>Fiyat</th>
                            </tr>
                        </thead>
                            <tbody class="order-details-body">

                            <?php

                            $sorgu = $db->prepare("select * from tblsiparis,tblsiparisdetay,tblurunler,tblurunfoto,tbladres where tblsiparis.adres_id = tbladres.adres_id and tblsiparis.siparis_id = tblsiparisdetay.siparis_id and tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunfoto.urun_id = tblurunler.urun_id and tblurunfoto.is_profile = 1 and tblsiparisdetay.siparis_id={$_GET['siparis_id']}");
                            $sorgu->execute();

                            while ($urun = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>
                                <tr>
                                    <td><?php echo $urun['urun_ad']?></td>
                                    <td><?php echo $urun['urun_adet']?></td>
                                    <td><?php echo $urun['urun_fiyat']?></td>
                                </tr>

                            <?php } ?>
                            </tbody>
                        <?php

                        $sorgu = $db->prepare("select * from tblsiparis,tblsiparisdetay,tblurunler,tblurunfoto,tbladres where tblsiparis.adres_id = tbladres.adres_id and tblsiparis.siparis_id = tblsiparisdetay.siparis_id and tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunfoto.urun_id = tblurunler.urun_id and tblurunfoto.is_profile = 1 and tblsiparisdetay.siparis_id={$_GET['siparis_id']}");
                        $sorgu->execute();
                        $urun = $sorgu->fetch(PDO::FETCH_ASSOC);

                        ?>
                        <tbody>
                            <tr>
                                <td>Toplam Fiyat</td>
                                <td colspan="2"><?php echo $urun['siparis_toplam']?></td>
                            </tr>
                        </tbody>


                    </table>
                    <a href="index.php" style="text-align: center; width: 100%;" class="boxed-btn">Alışverişe Devam Et</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-1.11.3.min.js"></script>
<script src="bootstrap/js2/bootstrap.min.js"></script>

</body>
</html>
