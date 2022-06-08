<?php include "index.php"; include "controller/baglan.php";

$adminSorgu = $db ->prepare("SELECT * FROM tblkullanicilar where kullanici_id=:id");
$adminSorgu -> execute(array('id' => $_GET['kullanici_id']));
$veriCek = $adminSorgu->fetch(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/AdminController.php" method="post">
        <h3>Admin Güncelle</h3>

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
            <?php
            error_reporting(0);
            if ($_GET['durum']=="mukerrer") {?>
                <b style="color:red;">Girilen mail adresi kullanımda lütfen farklı bir email adresi giriniz.</b>
            <?php } ?>
        </fieldset>

        <fieldset>
            Admin Telefon<br>
            <input  type="tel" tabindex="1" required name="kullanici_telefon" value="<?php echo $veriCek['kullanici_telefon']?>">
        </fieldset>

        <fieldset>
            Parolanızı Girin<br>
            <input  type="password" tabindex="1" name="kullanici_parola">
            <?php
            error_reporting(0);
            if ($_GET['durum']=="parolahatali") {?>
                <b style="color:red;">Parolanız Hatalı</b>
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
                <b style="color:red;">Parolalar Uyuşmuyor</b>
            <?php }else if($_GET['durum']=="kisa"){?>
                <b style="color:red;">Parola minimum 6 karakterden oluşturulmalıdr.</b>
            <?php } ?>
        </fieldset>

        <fieldset>
            <button name="adminGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>