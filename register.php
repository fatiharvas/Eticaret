<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/flaticon.css">

<div class="login">
    <div class="form">
        <form class="login-form" action="admin/controller/LoginController.php" method="post">
            <h1>Üye Kayıt</h1>

            <?php
            error_reporting(0);
            if ($_GET['durum']=="farklisifre") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                </div>

            <?php } elseif ($_GET['durum']=="eksiksifre") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                </div>

            <?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                </div>

            <?php } elseif ($_GET['durum']=="basarisiz") {?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                </div>

            <?php }
            ?>

            <span class="simgeler">
                <i class="flaticon-profile"></i>
            </span>
            <input type="text" maxlength="30" name="kullanici_ad" placeholder="Ad" required />
            <input type="text" maxlength="30" name="kullanici_soyad" placeholder="Soyad" required />
            <input type="email" maxlength="50" name="kullanici_mail" placeholder="E-Posta" required />
            <input type="password" maxlength="50" name="kullanici_parola" placeholder="Şifre" required />
            <input type="password" maxlength="50" name="kullanici_parola2" placeholder="Şifrenizi Onaylayın" required />
            <button class="btn-primary" name="kayitOl">Kayıt Ol</button>
            <p class="message">Üye misiniz? <a target="_blank" href="login.php">Giriş Yap</a></p>
        </form>
    </div>
</div>

