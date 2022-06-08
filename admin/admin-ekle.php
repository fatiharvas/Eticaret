<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AdminController.php" method="post">
        <h3>Admin Ekle</h3>

        <fieldset>
            <label for="AdminAd">Admin Ad</label>
            <input id="AdminAd" name="kullanici_ad" required type="text" tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="AdminSoyad">Admin Soyad</label>
            <input id="AdminSoyad" name="kullanici_soyad" required type="text" tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="AdminMail">Admin Mail</label>
            <input id="AdminMail" name="kullanici_mail" required type="email" tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="AdminTelefon">Admin Telefon</label>
            <input id="AdminTelefon" name="kullanici_telefon" required type="tel" tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="AdminParola">Admin Parola</label>
            <input id=AdminParola" name="kullanici_parola" required type="password" tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="AdminParola2">Admin Parola Onaylayın</label>
            <input id="AdminParola2" name="kullanici_parola2" required type="password" tabindex="1" >

            <?php
            error_reporting(0);
            if ($_GET['durum']=="parolauyusmuyor") {?>
                <b style="color:red;">Parolalar Uyuşmuyor</b>
            <?php }else if($_GET['durum'] == "kisa"){?>
                <b style="color:red;">Parolanız minimum 6 karakter uzunluğunda olmalıdır</b>
            <?php }else if($_GET['durum'] == "mukerrer") {?>
                <b style="color:red;">Girilen mail adresi zaten kullanımda lütfen farklı bir email adresi giriniz.</b>
            <?php } ?>

        </fieldset>

        <fieldset>
            <button name="adminEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>
