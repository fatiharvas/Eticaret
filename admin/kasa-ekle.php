<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/KasaController.php" method="post">
        <h3>Kasa Ekle </h3>

        <fieldset>
            <label for="KasaAd">Kasa Ad</label>
            <input id="KasaAd" name="kasa_adi" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="KasaDurum">Kasa Durum</label>
            <select id="KasaDurum" class="form-control" name="kasa_durum" required>

                <option value="1" >Aktif</option>
                <option value="0">Pasif</option>

            </select><br>
        </fieldset>

        <fieldset>
            <button name="kasaEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>
