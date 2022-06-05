<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" method="post" action="controller/KategoriController.php">
        <h3>Kategori Ekle </h3>

        <fieldset>
            <label for="KategoriAd">Kategori Ad</label>
            <input id="KategoriAd" name="kategori_ad" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="KategoriSira">Kategori Sira</label>
            <input type="number" name="kategori_sira" min="1" required tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="KategoriDurum">Kategori Durum</label>
            <select id="KategoriDurum" class="form-control" name="kategori_durum" required>

                <option value="1" >Aktif</option>
                <option value="0">Pasif</option>

            </select><br>
        </fieldset>

        <fieldset>
            <button name="kategoriEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>


