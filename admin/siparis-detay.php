<?php include "controller/baglan.php"; ?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sipariş Detay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/accordion.css">
</head>
<body>

<div class="accordion-content" style="margin-right: 15px; margin-left: 15px">

    <h2 style="text-align: center; margin-bottom: 20px">Sipariş Detayları</h2>

    <div class="accordion-item">
        <header class="item-header">
            <h4 class="item-question">
                Ürün Bilgileri
            </h4>
            <div class="item-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </header>
        <div class="item-content">
            <p class="item-answer">
                <table style="text-align: center; width: 100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Ürün</th>
                            <th>Ürün Adet</th>
                            <th>Ürün Fiyat</th>
                            <th>Ürün Stok</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $sorgu = $db->prepare("select * from tblsiparis,tblsiparisdetay,tblurunler,tblurunfoto,tbladres,tblstok where tblstok.urun_id = tblurunler.urun_id and tblsiparis.adres_id = tbladres.adres_id and tblsiparis.siparis_id = tblsiparisdetay.siparis_id and tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunfoto.urun_id = tblurunler.urun_id and tblurunfoto.is_profile = 1 and tblsiparisdetay.siparis_id={$_GET['siparis_id']}");
                            $sorgu->execute();

                            while ($urun = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>

                                <tr>
                                    <td>
                                        <img width="50px" src="<?php echo "../".$urun['resim_yol']?>" alt="Ürün Resmi">
                                    </td>
                                    <td><?php echo $urun['urun_ad']?></td>
                                    <td><?php echo $urun['urun_adet']?></td>
                                    <td><?php echo $urun['urun_fiyat']?></td>
                                    <td><?php echo $urun['stok']?></td>
                                </tr>

                            <?php } ?>
                    </tbody>
            </table>
            </p>
        </div>
    </div>
    <div class="accordion-item">
        <header class="item-header">
            <h4 class="item-question">
                Adres Bilgileri
            </h4>
            <div class="item-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </header>
        <div class="item-content">
            <p class="item-answer">
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
            </p>
        </div>
    </div>
    <div class="accordion-item">
        <header class="item-header">
            <h4 class="item-question">
                Kart Bilgileri
            </h4>
            <div class="item-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </header>
        <div class="item-content">
            <p class="item-answer">
                <p><b>Kart Numarası : </b><?php echo $urun['kart_numarasi']?></p>
                <p><b>Son Kullanma Tarihi : </b><?php echo $urun['son_kullanma_tarihi']?></p>
                <p><b>CVV : </b><?php echo $urun['cvv']?></p>
            </p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    const accordionBtns = document.querySelectorAll(".item-header");

    accordionBtns.forEach((accordion) => {
        accordion.onclick = function () {
            this.classList.toggle("active");

            let content = this.nextElementSibling;
            console.log(content);

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                console.log(content.style.maxHeight);
            }
        };
    });

</script>
</body>
</html>