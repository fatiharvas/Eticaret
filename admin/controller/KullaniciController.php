<?php include "baglan.php"; include "Fonksiyonlar.php";

$kullaniciSorgu = $db->prepare("SELECT * FROM tblkullanicilar WHERE kullanici_yetkisi=:kullanici_yetkisi");
$kullaniciSorgu->execute(array('kullanici_yetkisi' => 0));

if (isset($_POST['kullaniciSil'])) {

    if ($_POST['parola1'] == $_POST['parola2']) {

        $sorgu = $db->prepare("select * from tblkullanicilar where kullanici_id={$_POST['kullanici_id']}");
        $sorgu->execute();
        $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['parola1'], $veriCek['kullanici_parola'])) {

            $kullaniciSil = $db->prepare("delete from tblkullanicilar where  kullanici_id={$_POST['kullanici_id']}");
            $delete = $kullaniciSil->execute();

            if ($delete){
                session_start(); session_destroy();
                Header("Location:../../login.php");
            }

        }else {
            Header("Location:../../hesap-sil.php?kullanici_id={$_POST['kullanici_id']}&durum=hatali");
        }


    }else {
        Header("Location:../../hesap-sil.php?kullanici_id={$_POST['kullanici_id']}&durum=uyusmuyor");
    }

}

if (isset($_POST['kullaniciGuncelle'])) {

  if ($_POST['parola2'] == "" and $_POST['parola3'] == "" and $_POST['parola1'] == "") {

      $sorgu = $db -> prepare("Select * from tblkullanicilar where kullanici_mail=:mail");
      $sorgu -> execute(array('mail' => $_SESSION['user_mail']));
      $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

      $kullaniciTelefon = $_POST['kullanici_telefon'];

      if ($_POST['kullanici_telefon'] == "") {
          $kullaniciTelefon = null;
      }

      $veriGuncelle = $db -> prepare("UPDATE tblkullanicilar SET  
        kullanici_ad=:kullanici_ad,
        kullanici_soyad=:kullanici_soyad,
        kullanici_telefon=:kullanici_telefon
        WHERE kullanici_id={$_POST['kullanici_id']}
        ");

      $update = $veriGuncelle ->execute(array(
          'kullanici_ad' => $_POST['kullanici_ad'],
          'kullanici_soyad' => $_POST['kullanici_soyad'],
          'kullanici_telefon' => $kullaniciTelefon
      ));

      if ($update) {
          Header("Location:../../hesabim.php?durum=ok");
      }else {
          Header("Location:../../hesabim.php?durum=no");
      }


  }else {

      $sorgu = $db -> prepare("Select * from tblkullanicilar where kullanici_id = {$_POST['kullanici_id']}");
      $sorgu->execute();
      $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

      $kullaniciTelefon = $_POST['kullanici_telefon'];

      if ($kullaniciTelefon == ""){
          $kullaniciTelefon = null;
      }

      if (password_verify($_POST['parola1'], $veriCek['kullanici_parola'])){

          if ($_POST['parola2'] != "" and $_POST['parola3'] != "") {

              if ($_POST['parola2'] == $_POST['parola3']) {

                  if (trim(strlen($_POST['parola2'])) > 5) {

                      $kullaniciParola = password_hash($_POST['parola2'],PASSWORD_DEFAULT);

                      $veriGuncelle = $db -> prepare("UPDATE tblkullanicilar SET  
                        kullanici_ad=:kullanici_ad,
                        kullanici_soyad=:kullanici_soyad,
                        kullanici_telefon=:kullanici_telefon,
                        kullanici_parola=:kullanici_parola
                        WHERE kullanici_id={$_POST['kullanici_id']}
                    ");

                      $update = $veriGuncelle ->execute(array(
                          'kullanici_ad' => $_POST['kullanici_ad'],
                          'kullanici_soyad' => $_POST['kullanici_soyad'],
                          'kullanici_telefon' => $kullaniciTelefon,
                          'kullanici_parola' => $kullaniciParola

                      ));

                      if ($update) {
                          Header("Location:../../logout.php");
                      }else {
                          Header("Location:../../hesabim.php?durum=no");
                      }

                  }else {
                      Header("Location:../../hesabim.php?durum=eksiksifre");
                  }

              }else {
                  Header("Location:../../hesabim.php?durum=farklisifre");
              }
          }else {
              Header("Location:../../hesabim.php?durum=bos");
          }

      }else {
          Header("Location:../../hesabim.php?durum=yanlisifre");
      }

  }

}

if ($_GET['sil']=="ok") {


    $sil = $db -> prepare("DELETE FROM tblkullanicilar WHERE kullanici_id={$_GET['kullanici_id']}");
    $kontrol = $sil -> execute();

    if ($kontrol) {
        Header("Location:../kullanicilar.php?durum=ok");
    }else {
        Header("Location:../kullanicilar.php?durum=no");
    }

}