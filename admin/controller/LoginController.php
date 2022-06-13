<?php include "baglan.php";
error_reporting(0);
ob_start();
session_start();

if (isset($_POST['kayitOl'])) {

    if ($_POST['kullanici_parola'] == $_POST['kullanici_parola2']) {

        if (trim(strlen($_POST['kullanici_parola'])) > 5) {

            $sorgu = $db -> prepare("Select * from tblkullanicilar where kullanici_mail=:mail");
            $sorgu -> execute(array('mail' => $_POST['kullanici_mail']));

            $say = $sorgu->rowCount();

            if ($say == 0) {

                $kullaniciParola = password_hash($_POST['kullanici_parola'],PASSWORD_DEFAULT);

                $veriEkle = $db -> prepare("INSERT INTO tblkullanicilar SET 
                    
                    kullanici_ad=:kullanici_ad,
                    kullanici_soyad=:kullanici_soyad,
                    kullanici_mail=:kullanici_mail,
                    kullanici_parola=:kullanici_parola,
                    kullanici_durum=:kullanici_durum,
                    kullanici_yetkisi=:kullanici_yetkisi
    
                ");

                $insert = $veriEkle -> execute(array(

                    'kullanici_ad' => $_POST['kullanici_ad'],
                    'kullanici_soyad' => $_POST['kullanici_soyad'],
                    'kullanici_mail' => $_POST['kullanici_mail'],
                    'kullanici_parola' => $kullaniciParola,
                    'kullanici_durum' => 1,
                    'kullanici_yetkisi' => 0

                ));


                if ($insert) {
                    Header("Location:../../login.php");

                }else {
                    Header("Location:../../register.php?durum=basarisiz");
                }


            }else {
                Header("Location:../../register.php?durum=mukerrerkayit");
            }

        }else {
            Header("Location:../../register.php?durum=eksiksifre");
        }


    }else {
        Header("Location:../../register.php?durum=farklisifre");
    }



}

if (isset($_POST['login'])){

    $kullaniciMail = $_POST['kullanici_mail'];
    $kullaniciParola = $_POST['kullanici_parola'];

    $sorgu = $db->prepare("SELECT * FROM tblkullanicilar where kullanici_mail=:mail and kullanici_durum=:kullanici_durum");
    $sorgu->execute(array(
        'mail' => $kullaniciMail,
        'kullanici_durum' => 1
    ));
    $veriCek = $sorgu -> fetch(PDO::FETCH_ASSOC);

    if ($veriCek['kullanici_yetkisi'] == 1) {
        if (password_verify($kullaniciParola, $veriCek['kullanici_parola'])) {
            $_SESSION['kullanici_mail'] = $kullaniciMail;
            header("Location:../index.php");
        } else {
            header("Location:../../login.php?durum=no");
        }
    }else {
        if (password_verify($kullaniciParola, $veriCek['kullanici_parola'])) {
            $_SESSION['user_mail'] = $kullaniciMail;
            header("Location:../../index.php");
        } else {
            header("Location:../../login.php?durum=no");
        }
    }
}
