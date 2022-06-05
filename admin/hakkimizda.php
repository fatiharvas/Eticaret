<?php include "index.php"; include "controller/HakkimizdaController.php";?>

<link rel="stylesheet" href="css/form.css">
<head>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>
<div class="container">
    <form id="contact" action="controller/HakkimizdaController.php" method="post">
        <h3>Hakkımızda Ayarları</h3>

        <fieldset>
            <label for="Baslik">Başlık</label>
            <input id="Baslik" name="baslik" type="text" tabindex="1" value="<?php echo $veriCek['baslik']?>" required >
        </fieldset>

        <fieldset>
            <label for="Icerik">İçerik</label>
            <textarea class="ckeditor" id="Icerik" name="icerik" required style="width: 100%" ><?php echo $veriCek['icerik']?></textarea>
        </fieldset>

        <fieldset>
            <label for="Video">Video Adresi</label>
            <input  type="url" id="Video" name="video" required tabindex="1" value="<?php echo $veriCek['video']?>" >
        </fieldset>

        <fieldset>
            <label for="Vizyon">Vizyon</label>
            <input id="Vizyon" name="vizyon" required type="text" tabindex="1" value="<?php echo $veriCek['vizyon']?>">
        </fieldset>

        <fieldset>
            <label for="Misyon">Misyon</label>
            <input id="Misyon" name="misyon" required type="text" tabindex="1" value="<?php echo $veriCek['misyon']?>">
        </fieldset>

        <fieldset>
            <button name="hakkimizdaGuncelle" type="submit">Güncelle</button>
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
