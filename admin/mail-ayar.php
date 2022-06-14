<?php include "index.php"; include "controller/AyarTabloController.php"; include "controller/Fonksiyonlar.php";?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AyarTabloController.php" method="post">
        <h3>Site Ayarları</h3>
        <h4>Mail Ayarları</h4>

        <fieldset>
            <label for="Mail">Mail Adresiniz</label>
            <input id="Mail" maxlength="30" name="ayarMail" type="text" tabindex="1" value="<?php echo hideInformation($ayarcek['ayarMail'],2,7)?>">
        </fieldset>

        <fieldset>
            <label for="Mail">Mevcut Parolanız</label>
            <input id="Mail" maxlength="50" required name="parola1" type="password" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="Mail">Parola</label>
            <input id="Mail" name="parola2" maxlength="50" required type="password" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="Mail">Parolanızı Onaylayın</label>
            <input id="Mail" name="parola3" maxlength="50" required type="password" tabindex="1">
        </fieldset>


        <fieldset>
            <button name="mailAyarGuncelle" type="submit">Güncelle</button>
            <small>
                <?php
                error_reporting(0);
                if ($_GET['durum']=="ok") {?>
                    <b style="color:green;">İşlem Başarılı...</b>

                <?php } elseif ($_GET['durum']=="no") {?>

                    <b style="color:red;">İşlem Başarısız...</b>

                <?php } elseif ($_GET['durum']=="kisa") {?>

                    <b style="color:red;">Şifre Minimum 6 karakter olmalıdır</b>

                <?php } elseif ($_GET['durum']=="sifreyanlis") {?>

                    <b style="color:red;">Girilen Şifre Yanlış</b>

                <?php }elseif($_GET['durum'] == "uyusmuyor") {?>

                    <b style="color:red;">Girilen Şifreler Uyuşmuyor</b>

                <?php } ?>
            </small>
        </fieldset>

    </form>
</div>
