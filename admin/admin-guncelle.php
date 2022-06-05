<?php include "index.php"; include "controller/baglan.php";

$adminSorgu = $db ->prepare("SELECT * FROM tblkullanicilar where kullanici_id=:id");
$adminSorgu -> execute(array('id' => $_GET['kullanici_id']));
$veriCek = $adminSorgu->fetch(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AdminController.php" method="post">
        <h3>Admin Güncelle

            <?php
            error_reporting(0);
            if ($_GET['durum']=="ok") {?>
                <b style="color:green;">Parola Hatalı</b>
            <?php } ?> </h3>

        <fieldset>
            Admin Id<br>
            <input  type="text" tabindex="1" readonly name="kullanici_id"  value="<?php echo $veriCek['kullanici_id']?>">
        </fieldset>

        <fieldset>
            Admin Ad<br>
            <input  type="text" tabindex="1" required name="kullanici_ad"  value="<?php echo $veriCek['kullanici_ad']?>">
        </fieldset>

        <fieldset>
            Admin Soyad<br>
            <input  type="text" tabindex="1" required name="kullanici_soyad" value="<?php echo $veriCek['kullanici_soyad']?> ">
        </fieldset>

        <fieldset>
            Admin Mail<br>
            <input  type="text" tabindex="1" required name="kullanici_mail" value="<?php echo $veriCek['kullanici_mail']?>">
        </fieldset>

        <fieldset>
            Admin Telefon<br>
            <input  type="tel" tabindex="1" required name="kullanici_telefon" value="<?php echo $veriCek['kullanici_telefon']?>">
        </fieldset>

        <fieldset>
            Parolanızı Girin<br>
            <input  type="text" tabindex="1" name="kullanici_parola" required>
            <?php
            error_reporting(0);
            if ($_GET['durum']=="parolahatali") {?>
                <b style="color:green;">Parolala Hatalı</b>
            <?php } ?>
        </fieldset>

        <fieldset>
            Yeni Parola<br>
            <input  type="password" name="yeni_parola" tabindex="1">
        </fieldset>

        <fieldset>
            Yeni Parola Onaylayın<br>
            <input  type="password" name="yeni_parola2" tabindex="1">
            <?php
            error_reporting(0);
            if ($_GET['durum']=="parolauyusmuyor") {?>
                <b style="color:green;">Parolalar Uyuşmuyor</b>
            <?php } ?>
        </fieldset>

        <fieldset>
            <button name="adminGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>