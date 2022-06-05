<?php
ob_start();
session_start();
include 'baglan.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

if(isset($_POST['unuttum'])) {

    $gelenEmail = $_POST['email'];

    $uyeSor = $db->prepare("Select * from tblkullanicilar where kullanici_mail = ?");
    $uyeSor->execute([$gelenEmail]);
    $veriCek = $uyeSor->fetch(PDO::FETCH_ASSOC);
    $uyeKontrol = $uyeSor->rowCount();


    if ($uyeKontrol > 0) {

        $kod = rand(100000,999999);
        $sorgu = $db ->prepare("update tblkullanicilar set aktivasyon = ? where kullanici_mail = ?");
        $calis = $sorgu->execute(array($kod, $gelenEmail));

        if ($calis) {
            $mailBody = "Aktivasyon Kodunuz: ".$kod;
        }else {
            Header("Location:../../mail/sifre-unuttum.php?durum=basarisiz");
        }
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPKeepAlive = true;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "info.fatih.medipol@gmail.com";
        $mail->Password = "Medipol12345";

        $mail->setFrom("info.fatih.medipol@gmail.com");
        $mail->addAddress($veriCek['kullanici_mail']);

        $mail->isHTML(true);
        $mail->Subject = "PAROLA SIFIRLAMA";
        $mail->Body = $mailBody;

        if ($mail->send()) {
            Header("Location:../../mail/aktivasyon.php");
        }
        else {
            Header("Location:../../mail/sifre-unuttum.php?durum=basarisiz");
        }

    }else {
        Header("Location:../../mail/sifre-unuttum.php?durum=kullaniciyok");
    }


}
if (isset($_POST['gonder'])) {
    $aktivasyon = $_POST['aktivasyon'];
    $uyeSor = $db->prepare("Select * from tblkullanicilar where aktivasyon = ?");
    $uyeSor->execute([$aktivasyon]);
    $veriCek = $uyeSor->fetch(PDO::FETCH_ASSOC);
    $uyeKontrol = $uyeSor->rowCount();

    if ($uyeKontrol > 0) {
        $_SESSION['id'] = $veriCek['kullanici_id'];
        Header("Location:../../mail/sifre-yenile.php");
    }else {
        Header("Location:../../mail/aktivasyon.php?durum=basarisiz");
    }
}

if (isset($_POST['sifre'])) {

    $aktivasyonSifirla = $db ->prepare("update tblkullanicilar set aktivasyon = null where kullanici_id={$_SESSION['id']}");
    $aktivasyonSifirla->execute();

    $parola1 = $_POST['parola1'];
    $parola2 = $_POST['parola2'];

    if ($parola1 == $parola2) {
        $kullanici_id = $_SESSION['id'];

        $veriKaydet = $db->prepare("Update tblkullanicilar Set
            kullanici_parola=:kullanici_parola where kullanici_id={$kullanici_id} 
        ");

        $update = $veriKaydet->execute(array('kullanici_parola'=>password_hash($parola1, PASSWORD_DEFAULT)));

        if ($update) {
            session_destroy();
            Header("Location:../../login.php");
        }


    }else {
        Header("Location:../../mail/sifre-yenile.php?durum=parolauyusmuyor");
    }

}

?>