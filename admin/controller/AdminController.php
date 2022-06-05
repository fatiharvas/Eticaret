<?php include "baglan.php";
error_reporting(0);
$adminSorgu = $db -> prepare("SELECT * FROM tblkullanicilar WHERE kullanici_yetkisi=:kullanici_yetkisi");
$adminSorgu->execute(array('kullanici_yetkisi' => 1));

if (isset($_POST['adminEkle'])) {

    $kullanici_parola = password_hash($_POST['kullanici_parola'],PASSWORD_DEFAULT);

    if ($_POST['kullanici_parola'] != $_POST['kullanici_parola2']) {
        Header("Location:../admin-ekle.php?&durum=parolauyusmuyor");
    }

    $veriEkle = $db -> prepare("INSERT INTO tblkullanicilar SET    
        kullanici_ad=:kullanici_ad,
        kullanici_soyad=:kullanici_soyad,
        kullanici_mail=:kullanici_mail,
        kullanici_telefon=:kullanici_telefon,
        kullanici_parola=:kullanici_parola,
        kullanici_durum=:kullanici_durum,
        kullanici_yetkisi=:kullanici_yetkisi
    ");

    $insert = $veriEkle -> execute(array(
        'kullanici_ad' => $_POST['kullanici_ad'],
        'kullanici_soyad' => $_POST['kullanici_soyad'],
        'kullanici_mail' => $_POST['kullanici_mail'],
        'kullanici_telefon' => $_POST['kullanici_telefon'],
        'kullanici_parola' => $kullanici_parola,
        'kullanici_durum' => 1,
        'kullanici_yetkisi' => 1
    ));

    if ($insert)
        Header("Location:../admin.php?durum=ok");
    else
        Header("Location:../admin.php?durum=no");

}

if (isset($_POST['adminGuncelle'])) {

    $kullanici_id = $_POST['kullanici_id'];
    $sorgu = $db->prepare("SELECT * FROM tblkullanicilar WHERE kullanici_id=$kullanici_id");
    $sorgu->execute();
    $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['kullanici_parola'],$veriCek['kullanici_parola'])) {

        if ($_POST['yeni_parola'] == $_POST['yeni_parola2']){

            $veriKaydet = $db->prepare("UPDATE tblkullanicilar SET
                kullanici_ad=:kullanici_ad,
                kullanici_soyad=:kullanici_soyad,
                kullanici_mail=:kullanici_mail,
                kullanici_telefon=:kullanici_telefon,
                kullanici_parola=:kullanici_parola
                WHERE kullanici_id = {$_POST['kullanici_id']}
            ");

            $update = $veriKaydet->execute(array(
               'kullanici_ad' => $_POST['kullanici_ad'],
               'kullanici_soyad' => $_POST['kullanici_soyad'],
               'kullanici_mail' => $_POST['kullanici_mail'],
               'kullanici_telefon' => $_POST['kullanici_telefon'],
               'kullanici_parola' => password_hash($_POST['yeni_parola'],PASSWORD_DEFAULT,['cost' => 4])
            ));

            if ($update)
                header("Location:../admin.php?durum=ok");
            else
                header("Location:../admin.php?durum=no");

        }else {
            Header("Location:../admin-guncelle.php?kullanici_id=$kullanici_id&durum=parolauyusmuyor");
        }


    }else {
        header("Location:../admin-guncelle.php?kullanici_id=$kullanici_id&durum=parolahatali");
    }


}

if ($_GET['kullanicidurum']=="no") {

    $update = $db -> prepare("UPDATE tblkullanicilar SET kullanici_durum = 0 WHERE kullanici_id={$_GET['kullanici_id']}");
    $kontrol = $update->execute();

    if ($kontrol)
        header("Location:../admin.php");
    else
        header("Location:../admin.php?error");
}

if ($_GET['kullanicidurum'] == 'ok') {

    $update = $db -> prepare("UPDATE tblkullanicilar SET kullanici_durum = 1 WHERE kullanici_id={$_GET['kullanici_id']}");
    $kontrol = $update->execute();

    if ($kontrol)
        header("Location:../admin.php");
    else
        header("Location:../admin.php?error");
}

if ($_GET['kullanicisil'] == 'ok') {

    $delete = $db -> prepare("DELETE FROM tblkullanicilar WHERE kullanici_id=:id");
    $kontrol = $delete -> execute(array(
        'id' => $_GET['kullanici_id']
    ));

    if ($kontrol) {

        Header("Location:../admin.php?&durum=ok");

    } else {
        Header("Location:../menu.php?&durum=no");
    }

}


?>