<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/MenuController.php" method="post">
        <h3>Menü Ekle </h3>

        <fieldset>
            <label for="MenuAd">Menü Ad</label>
            <input id="MenuAd" name="menu_ad" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="MenuUrl">Menü Url</label>
            <input id="MenuUrl" name="menu_url" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="MenuSira">Menü Sira</label>
            <input type="number" name="menu_sira" min="1" required tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="MenuDurum">Menü Durum</label>
            <select id="MenuDurum" class="form-control" name="menu_durumu" required>

                <option value="1" >Aktif</option>
                <option value="0">Pasif</option>

            </select><br>
        </fieldset>

        <fieldset>
            <button name="menuEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>


