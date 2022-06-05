<?php include "admin/controller/AyarTabloController.php"; error_reporting(0); ob_start(); session_start(); ?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="<?php echo $ayarcek['ayarDescription']?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayarKeywords']?>">
    <meta name="author" content="<?php echo $ayarcek['ayarAuthor']?>">
    <title><?php echo $ayarcek['ayarTitle'] ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/flaticon.css"/>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/lightslider.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/urun-detay.css">

</head>
<body>
<header class="header-section" style="font-family: revert;">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <a href="index.php">
                        <img id="siteLogo" width="150px" src="<?php echo $ayarcek['ayarLogo']?>" alt="logo">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <form class="search-container">
                        <input type="text" id="search-bar" placeholder="Aradığınız ürün, kategori veya markayı yazınız">
                        <button><i class="flaticon-search"></i></button>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">

                        <?php

                        if ($_SESSION['user_mail']) { ?>

                            <?php
                            $sorgu = $db -> prepare("SELECT * FROM tblkullanicilar where kullanici_mail=:mail");
                            $sorgu -> execute(array('mail' => $_SESSION['user_mail']));
                            $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="up-item">
                                <div class="shopping-card">
                                    <i class="flaticon-bag"></i>
                                </div>
                                <a href="sepet.php" >Alışveriş Sepetim</a>
                            </div>

                            <div class="up-item">
                                <div class="shopping-card">
                                    <i class="flaticon-shopping-cart"></i>
                                </div>
                                <a href="siparis.php" >Siparişlerim</a>
                            </div>

                        <?php }else { ?>
                            <div class="up-item">
                                <i class="flaticon-profile"></i>
                                <a href="login.php" target="_blank" >Giriş Yap</a> veya <a href="register.php" target="_blank" >Kayıt Ol</a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul class="main-menu">


                <?php

                $menuSorgu = $db -> prepare("SELECT * FROM tblmenuler WHERE menu_durumu=:durum ORDER BY menu_sira ASC limit 5 ");
                $menuSorgu -> execute(array('durum' => 1));

                while ($menuCek = $menuSorgu -> fetch(PDO::FETCH_ASSOC)) {?>

                    <li><a href="<?php echo $menuCek['menu_url'],".php"; ?>" style="text-decoration: none;" </a> <?php echo $menuCek['menu_ad']?> </li>

                <?php } ?>

                <?php
                if (isset($_SESSION['user_mail'])) {?>
                    <ul class="small-menu">
                        <li><a href="hesabim.php" class="hesabim" style="text-decoration: none; margin: auto"><i class="flaticon-profile"></i> Hesabım</a></li>
                        <li><a href="logout.php" class="cikis" style="text-decoration: none; margin: auto"><i class="flaticon-remove" ></i> Çıkış</a></li>
                    </ul>
                <?php } ?>

            </ul>

        </div>
    </nav>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>


</body>
</html>