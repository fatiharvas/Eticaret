<?php include "index.php"; include "controller/AyarTabloController.php";?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AyarTabloController.php" method="post">
        <h3>Site Ayarları</h3>
        <h4>Sosyal Medya Ayarları</h4>

        <fieldset>
            <label for="Facebook">Facebook Adresi</label>
            <input id="Facebook" maxlength="50" name="ayarFacebook" type="text" tabindex="1" value="<?php echo $ayarcek['ayarFacebook']?>">
        </fieldset>

        <fieldset>
            <label for="Instagram">İnstagram Adresi</label>
            <input id="Instagram" maxlength="50" name="ayarInstagram" type="text" tabindex="1" value="<?php echo $ayarcek['ayarInstagram']?>">
        </fieldset>

        <fieldset>
            <label for="Twitter">Twitter Adresi</label>
            <input id="Twitter" maxlength="50" name="ayarTwitter" type="text" tabindex="1" value="<?php echo $ayarcek['ayarTwitter']?>">
        </fieldset>

        <fieldset>
            <label for="Youtube">Youtube Adresi</label>
            <input id="Youtube" maxlength="50" name="ayarYoutube" type="text" tabindex="1" value="<?php echo $ayarcek['ayarYoutube']?>">
        </fieldset>

        <fieldset>
            <button name="sosyalMedyaAyarGuncelle" type="submit">Güncelle</button>
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
