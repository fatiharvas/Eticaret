<?php include "header.php"; ob_start(); session_start();?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <title>İletişim</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/iletisim.css">

</head>
<body>

<div class="contact-from-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="form-title">
                    <h2>Bizimle İletişime Geçin</h2>
                    <?php
                        if ($_GET['durum'] == 'ok') {?>
                            <p style="color: green">Mail Gönderme Başarılı.</p>
                        <?php }else if ($_GET['durum'] == "no"){?>
                            <p style="color:red;">Mail Gönderme Başarısız.</p>
                        <?php }else { ?>
                            <p>Herhangi bir sorunuzu bu form üzerinden bizlere ulaştırabilirsiniz!</p>
                        <?php } ?>
                </div>
                <div id="form_status"></div>
                <div class="contact-form">
                    <?php

                        if ($_SESSION['user_mail']) { ?>

                            <form action="admin/controller/MailController.php" method="post">
                                <p><input style="width: 100%;" type="text" placeholder="Konu" name="konu"></p>
                                <p><textarea name="message" id="message" cols="30" rows="10" placeholder="Mesaj"></textarea></p>
                                <p><input name="mailGonder" type="submit" value="Gönder"></p>
                                <input type="hidden" name="kullanici_mail" value="<?php echo $_SESSION['user_mail'] ?>">
                            </form>

                        <?php }else {?>

                            <form>
                                <p><textarea name="message" id="message" cols="30" rows="10" placeholder="Mesaj">Mail göndermek için Giriş Yapılmalıdır!</textarea></p>
                                <p><input id="mailGonder" type="button" value="Gönder"></p>
                            </form>


                        <?php } ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form-wrap">
                    <div class="contact-form-box">
                        <h4><i class="flaticon-map"></i> Adres</h4>
                        <p>İl: <?php echo $ayarcek['ayarIl']?> <br>İlçe: <?php echo $ayarcek['ayarIlce']?> <br> Adres: <?php echo $ayarcek['ayarAdres']?></p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="flaticon-clock"></i> Çalışma Saatleri</h4>
                        <p><?php echo $ayarcek['ayarMesai']?></p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="flaticon-help"></i> İletişim Adresleri</h4>
                        <p>
                            Telefon: +00 111 222 3333 <br>
                            Mail: <?php echo $ayarcek['ayarMail']; ?><br>
                            Faks: <?php echo $ayarcek['ayarFaks']?><br>
                            Çağrı Merkezi: <?php echo $ayarcek['ayarCagriMerkezi']?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="find-location blue-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p> <i class="flaticon-map"></i> Konumumuzu Bulun</p>
            </div>
        </div>
    </div>
</div>


<div class="embed-responsive embed-responsive-21by9">
    <iframe src="<?php echo $ayarcek['ayarMaps']; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

</body>
</html>

<?php include "footer.php"; ?>