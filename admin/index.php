<?php
ob_start();
session_start();
include "header.php";
include "controller/LoginController.php";

$sorgu = $db ->prepare("SELECT * FROM tblkullanicilar where kullanici_mail=:mail");
$sorgu->execute(array(
        'mail' => $_SESSION['kullanici_mail']
));
$sayi = $sorgu->rowCount();
$veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

if ($sayi==0) {
    header("Location:../login.php?durum=izinsiz");
    exit();
}

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Paneli</title>
</head>
<body>

    <aside>

        <div id="sidebar"  class="nav-collapse ">
            <div class="profile-pic">
                <a href="admin.php" class="img-profile">
                    <img src="../img/Arthur.jpg" alt="Arthur" class="user-profile">
                </a>
            </div>
            <div class="profile-info">
                <span class="message">Hoşgeldin</span>
                <a href="admin.php">
                    <h2 class="user-name"><?php echo $veriCek['kullanici_ad']," ", $veriCek['kullanici_soyad']?></h2>
                </a>
            </div>

            <ul class="sidebar-menu" >
                <li class="mt">
                    <a href="index.php" class="active">
                        <i class="flaticon-home"></i>
                        <span>Ana Sayfa</span>
                    </a>
                    </a>
                </li>
                <li class="mt">
                    <a href="#" class="active">
                        <i class="flaticon-settings"></i>
                        <span class="active-settings">Site Ayarları</span>
                    </a>
                    <ul class="group-list">
                        <li><a href="genel-ayar.php" class="settings-sidebar">
                                <i class="flaticon-settings-1"></i>
                                <span>Genel Ayarlar</span>
                            </a>
                        </li>
                        <li>
                            <a href="iletisim-ayar.php" class="settings-sidebar">
                                <i class="flaticon-bell"></i>
                                <span>İletişim Ayarları</span>
                            </a>
                        </li>

                        <li>
                            <a href="sosyal-medya-ayar.php" class="settings-sidebar">
                                <i class="flaticon-video-camera"></i>
                                <span  style="font-size: 14px">Sosyal Medya Ayarları</span>
                            </a>
                        </li>
                        <li>
                            <a href="mail-ayar.php" class="settings-sidebar">
                                <i class="flaticon-speech-bubble"></i>
                                <span>Mail Ayarları</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="mt">
                    <a class="active" href="hakkimizda.php">
                        <i class="flaticon-info"></i>
                        <span>Hakkımızda</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="kullanicilar.php">
                        <i class="flaticon-profile"></i>
                        <span>Kullanıcılar</span>
                    </a>
                </li>

                <li class="mt">
                    <a class="active" href="menu.php">
                        <i class="flaticon-menu"></i>
                        <span>Menüler</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="kategoriler.php">
                        <i class="flaticon-store"></i>
                        <span>Kategoriler</span>
                    </a>
                </li>

                <li class="mt">
                    <a class="active" href="urunler.php">
                        <i class="flaticon-bag"></i>
                        <span>Ürünler</span>
                    </a>
                </li>

                <li class="mt">
                    <a class="active" href="slider.php">
                        <i class="flaticon-paint"></i>
                        <span>Slider</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="siparis.php">
                        <i class="flaticon-shopping-cart"></i>
                        <span>Siparişler</span>
                    </a>
                </li>
                <li class="mt">
                    <a class="active" href="yorumlar.php">
                        <i class="flaticon-edit"></i>
                        <span>Yorumlar</span>
                    </a>
                </li>

                <li class="mt">
                    <a href="kasalar.php" class="active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-safe" viewBox="0 0 16 16">
                            <path d="M1 1.5A1.5 1.5 0 0 1 2.5 0h12A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 1 14.5V13H.5a.5.5 0 0 1 0-1H1V8.5H.5a.5.5 0 0 1 0-1H1V4H.5a.5.5 0 0 1 0-1H1V1.5zM2.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-12z"/>
                            <path d="M13.5 6a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zM4.828 4.464a.5.5 0 0 1 .708 0l1.09 1.09a3.003 3.003 0 0 1 3.476 0l1.09-1.09a.5.5 0 1 1 .707.708l-1.09 1.09c.74 1.037.74 2.44 0 3.476l1.09 1.09a.5.5 0 1 1-.707.708l-1.09-1.09a3.002 3.002 0 0 1-3.476 0l-1.09 1.09a.5.5 0 1 1-.708-.708l1.09-1.09a3.003 3.003 0 0 1 0-3.476l-1.09-1.09a.5.5 0 0 1 0-.708zM6.95 6.586a2 2 0 1 0 2.828 2.828A2 2 0 0 0 6.95 6.586z"/>
                        </svg>
                        <i class="bi bi-safe"></i>
                        <span>Kasalar</span>
                    </a>
                </li>


                <li class="mt">
                    <a class="active" href="logout.php">
                        <i style="color:red;" class="flaticon-cancel"></i>
                        <span style="color: red;">Çıkış</span>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
</body>
</html>


