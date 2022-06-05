<?php include "index.php";
include "controller/AyarTabloController.php" ?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AyarTabloController.php" method="post">
        <h3>Site Ayarları</h3>
        <h4>Api Ayarları</h4>

        <fieldset>
            <label for="AnalysticKodu">Analystic Kodu</label>
            <input id="AnalysticKodu" name="ayarAnalystic" type="text" tabindex="1" value="<?php echo $ayarcek['ayarAnalystic']?>">
        </fieldset>

        <fieldset>
            <label for="MapsApi">Maps Api</label>
            <input id="MapsApi" name="ayarMaps" type="text" tabindex="1" value="<?php echo $ayarcek['ayarMaps']?>">
        </fieldset>

        <fieldset>
            <label for="ZopimApi">Zopim Api</label>
            <input id="ZopimApi" name="ayarZopim" type="text" tabindex="1" value="<?php echo $ayarcek['ayarZopim']?>" >
        </fieldset>

        <fieldset>
            <button name="apiAyarGuncelle" type="submit">Güncelle</button>

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
