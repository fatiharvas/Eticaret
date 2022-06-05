<?php include "index.php";

$sorgu = $db -> prepare("select * from tblstok, tblurunler where tblstok.urun_id = tblurunler.urun_id and tblstok.urun_id={$_GET['urun_id']}");
$sorgu->execute();
$urunCek = $sorgu -> fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/StokController.php" method="post">
        <h3>Stok İşlemleri
            <small>
                <?php
                error_reporting(0);
                if ($_GET['durum']=="ok") {?>
                    <b style="color:green;">İşlem Başarılı...</b>

                <?php } elseif ($_GET['durum']=="no") {?>

                    <b style="color:red;">İşlem Başarısız...</b>

                <?php } ?>
            </small>
        </h3>

        <?php

            if ($sorgu->rowCount() == 0) { ?>

                <fieldset>
                    <label for="urunId">Ürün Id</label>
                    <input id="urunId" readonly name="urun_id" type="text" tabindex="1" value="<?php echo $_GET['urun_id']?>">
                </fieldset>

                <fieldset>
                    <label for="alisFiyat">Alış Fiyatı</label>
                    <input id="alisFiyat" name="alis_fiyat" type="number" min="0" required step="0.01" tabindex="1"">
                </fieldset>

                <fieldset>
                    <label for="stok">Stok</label>
                    <input id="stok" name="stok" type="text" required min="0" tabindex="1"">
                </fieldset>

                <fieldset>
                    <button name="stokEkle" type="submit">Ekle</button>
                </fieldset>

            <?php }else { ?>
                <fieldset>
                    <label for="urunId">Ürün Id</label>
                    <input id="urunId" readonly name="urun_id" type="text" tabindex="1" value="<?php echo $urunCek['urun_id']?>">
                </fieldset>

                <fieldset>
                    <label for="alisFiyat">Alış Fiyatı</label>
                    <input id="alisFiyat" name="alis_fiyat" type="text" min="0" required step="0.01" tabindex="1" value="<?php echo $urunCek['alis_fiyat']?>">
                </fieldset>


                <fieldset>
                    <label for="stok">Stok</label>
                    <input id="stok" name="stok" type="text" required min="0" tabindex="1" value="<?php echo $urunCek['stok']?>">
                </fieldset>

                <fieldset>
                    <label for="durum">Kar Zarar Durumu</label>
                    <input id="durum" readonly type="text" tabindex="1" value="<?php

                    if ($urunCek['alis_fiyat'] > $urunCek['satis_fiyat']) {

                        echo "Zararınız : ".($urunCek['alis_fiyat'] - $urunCek['satis_fiyat'])."₺";

                    }else {
                        echo "Karınız : ".$urunCek['satis_fiyat'] - $urunCek['alis_fiyat']."₺";
                    } ?>">
                </fieldset>

                <fieldset>
                    <label for="oran">Kar Zarar Oranı</label>
                    <input id="oran" readonly  type="text" tabindex="1" value="<?php

                    if ($urunCek['alis_fiyat'] > $urunCek['satis_fiyat']) {

                        $zarar = ($urunCek['alis_fiyat'] - $urunCek['satis_fiyat']) * (100 / $urunCek['alis_fiyat']);
                        echo "Zarar Yüzdesi: %".number_format($zarar,2);

                    }else {
                        $kar = ($urunCek['satis_fiyat'] - $urunCek['alis_fiyat']) * (100 / $urunCek['alis_fiyat']);
                        echo "Kar Yüzdesi: %".number_format($kar,2);
                    } ?>">
                </fieldset>

                <fieldset>
                    <button name="stokGuncelle" type="submit">Güncelle</button>
                </fieldset>
            <?php } ?>



    </form>
</div>
