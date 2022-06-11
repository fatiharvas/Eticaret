<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/hesabim.css">

    <title>Hesabım Sil</title>

    <style>
        .row{
            min-height: 0px !important;
        }
        input[type="submit"] {
            width: 100%;
            background-color: red;
        }
    </style>

</head>
<body>
<div class="d-lg-flex half">
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 py-5">
                    <h3 style="text-align: center">Hesabı Sil</h3>
                    <form action="admin/controller/KullaniciController.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="lname">Parola</label>
                                    <input type="password" class="form-control" required name="parola1" id="lname">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="lname">Parolanızı Onaylayın</label>
                                    <input type="password" class="form-control" required name="parola2" id="lname">
                                </div>
                            </div>
                        </div>
                        <?php
                        error_reporting(0);
                            if ($_GET['durum'] == "uyusmuyor") { ?>
                                <p style="color: red; text-align: center; width: 100%">Parola Uyuşmuyor!</p>
                            <?php }else if ($_GET['durum'] == "hatali") { ?>
                                <p style="color: red; text-align: center; width: 100%">Parola Hatalı!</p>
                            <?php } ?>
                        <input type="hidden" name="kullanici_id" value="<?php echo $_GET['kullanici_id'] ?>">
                        <input type="submit" name="kullaniciSil" value="Hesabı Sil" class="btn px-5 btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
