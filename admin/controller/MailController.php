<?php

ob_start();
session_start();
include 'baglan.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';


if (isset($_POST['mailGonder'])){

    $sorgu = $db->prepare("select * from tblkullanicilar where kullanici_mail='{$_POST['kullanici_mail']}'");
    $sorgu->execute();
    $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

    $outlook_mail = new PHPMailer;

    $outlook_mail->IsSMTP();

    $outlook_mail->Host = 'smtp-mail.outlook.com';

    $outlook_mail->Port = 587;
    $outlook_mail->SMTPSecure = 'tls';
    $outlook_mail->SMTPDebug = 1;
    $outlook_mail->SMTPAuth = true;
    $outlook_mail->Username = 'fatiharvas@outlook.com';
    $outlook_mail->Password = 'Medipol12345';

    $outlook_mail->From = 'fatiharvas@outlook.com';
    $outlook_mail->FromName = 'fatiharvas@outlook.com';
    $outlook_mail->AddAddress($veriCek['kullanici_mail'], $veriCek['kullanici_ad']." ".$veriCek['kullanici_soyad']);  // Add a recipient  to name
    $outlook_mail->AddAddress($veriCek['kullanici_mail']);

    $outlook_mail->IsHTML(true);

    $outlook_mail->Subject = $_POST['konu'];
    $outlook_mail->Body    = $_POST['message'];


    if($outlook_mail->Send()) {
        Header("Location:../../iletisim.php?durum=ok");
    }
    else
    {
        Header("Location:../../iletisim.php?durum=no");
    }


}


