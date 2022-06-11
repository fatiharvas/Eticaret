<?php include "index.php";include "controller/AyarTabloController.php" ?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AyarTabloController.php" method="post">
        <h3>Site Ayarları</h3>
        <h4>İletişim Ayarları</h4>

        <fieldset>
            <label for="TelefonNumarasi">Telefon Numarası</label>
            <input id="TelefonNumarasi" name="ayarTelefon" type="tel" tabindex="1" min="11" max="11" required value="<?php echo $ayarcek['ayarTelefon']?>">
        </fieldset>

        <fieldset>
            <label for="Faks">Faks Numarasi</label>
            <input id="Faks" max="11" name="ayarFaks" type="tel" tabindex="1" value="<?php echo $ayarcek['ayarFaks'] ?>">
        </fieldset>

        <fieldset>
            <label for="Mail">Mail Adresi</label>
            <input id="Mail" required name="ayarMail" type="email" tabindex="1" value="<?php echo $ayarcek['ayarMail']?>" >
        </fieldset>

        <fieldset>
            <label for="il">İl</label>
            <input id="il" required name="ayarIl" type="text" tabindex="1" value="<?php echo $ayarcek['ayarIl']?>">
        </fieldset>

        <fieldset>
            <label for="ilce">İlçe</label>
            <input id="ilce" required name="ayarIlce" type="text" tabindex="1" value="<?php echo $ayarcek['ayarIlce']?>">
        </fieldset>

        <fieldset>
            <label for="adres">Adres</label>
            <input id="adres" required name="ayarAdres" type="text" tabindex="1" value="<?php echo $ayarcek['ayarAdres']?>">
        </fieldset>

        <fieldset>
            <label for="cagriMerkezi">Çağrı Merkezi</label>
            <input id="cagriMerkezi" name="ayarCagriMerkezi" type="tel" tabindex="1" value="<?php echo $ayarcek['ayarCagriMerkezi']?>">
        </fieldset>

        <fieldset>
            <label for="mesai">Mesai</label>
            <input id="mesai" type="text" name="ayarMesai" tabindex="1" value="<?php echo $ayarcek['ayarMesai']?>">
        </fieldset>

        <fieldset>
            <label for="konum">Konum</label>
            <input id="konum" type="text" name="ayarMaps" tabindex="1" value="<?php echo $ayarcek['ayarMaps']?>">
        </fieldset>

        <fieldset>
            <button name="iletisimAyarGuncelle" type="submit">Güncelle</button>
            <small>
                <?php
                error_reporting(0);
                if ($_GET['durum']=="ok") {?>
                    <b style="color:green;">İşlem Başarılı...</b>

                <?php } elseif ($_GET['durum']=="no") {?>

                    <b style="color:red;">İşlem Başarısız...</b>

                <?php } ?>
            </small>
        </fieldset>
    </form>
</div>