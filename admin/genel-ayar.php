<?php include 'controller/AyarTabloController.php'; include 'index.php';?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/form.css">
    <title>Genel Ayarlar</title>
</head>
<body>


    <div class="container">
        <form id="contact" action="controller/AyarTabloController.php" method="post">
            <h3>Site Ayarları</h3>
            <h4>Genel Ayarlar</h4>
            <fieldset>
                <img src="<?php echo $ayarcek['ayarLogo']?>" alt="Site Logosu">
                <label for="SiteLogo">Yüklü Logo Linki</label>
                <input id="SiteLogo" type="text" required tabindex="1" name="ayarLogo" value="<?php echo $ayarcek['ayarLogo']?>">
            </fieldset>
            <fieldset>
                <label for="SiteBasligi">Site Başlığı</label>
                <input id="SiteBasligi" maxlength="20" type="text" required tabindex="1" name="ayarTitle" value="<?php echo $ayarcek['ayarTitle']?>">
            </fieldset>

            <fieldset>
                <label for="SiteAciklama">Site Açıklaması</label>
                <input id="SiteAciklama" maxlength="250" required type="text" tabindex="1" name="ayarDescription" value="<?php echo $ayarcek['ayarDescription']?>" >
            </fieldset>

            <fieldset>
                <label for="SiteAnahtarKelime">Site Anahtar Kelime</label>
                <input id="SiteAnahtarKelime" maxlength="30" required type="text" tabindex="1" name="ayarKeywords" value="<?php echo $ayarcek['ayarKeywords']?>">
            </fieldset>

            <fieldset>
                <label for="SitaYazari">Site Yazari</label>
                <input id="SiteYazari" maxlength="20" type="text" tabindex="1" name="ayarAuthor" value="<?php echo $ayarcek['ayarAuthor']?>">
            </fieldset>

            <fieldset>
                <button name="genelAyarGuncelle" type="submit">Güncelle</button>

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
</body>
</html>

