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
    $mail->addAddress("fatiharvas1110@gmail.com");

    $mail->isHTML(true);
    $mail->Subject = "Mail";
    $mail->Body = $_POST['message'];

    if ($mail->send()) {
        Header("Location:../../iletisim.php?durum=ok");
    }
    else {
        Header("Location:../../iletisim.php?durum=no");
    }

}


