<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/UrunFotoController.php" method="post" enctype="multipart/form-data">
        <h3>Ürün Resim Ekle </h3>

        <input id="UrunId" name="urun_id" value="<?php echo $_GET['urun_id'] ?>" readonly type="hidden" tabindex="1">

        <fieldset>
            <label for="ResimEkle">Resim Ekle</label>
            <input id="ResimEkle" name="resim_yol" required type="file" accept="image/png, image/gif, image/jpeg"  tabindex="1">
        </fieldset>

        <fieldset>
            <label for="resimSira">Resim Sıra</label>
            <input id="resimSira" type="number" name="sira" min="1" required tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="isProfile">Profil Fotoğrafı olsun mu?</label>
            <input id="isProfile" tabindex="1" name="is_profile" type="checkbox">
        </fieldset>

        <fieldset>
            <button name="fotoEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>


