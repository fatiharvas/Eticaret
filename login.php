<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/flaticon.css">

<div class="login">
    <div class="form">
        <form class="login-form" action="admin/controller/LoginController.php" method="post">
            <h1>Üye Girişi</h1>
            <span class="simgeler">
                <i class="flaticon-profile"></i>
            </span>
            <div>
                <small>
                    <?php
                    error_reporting(0);
                    if ($_GET['durum']=="no") {?>
                        <strong class="message" style="color:red;">Kullanıcı bulunamadı</strong>
                    <?php }?>
                </small>
            </div>

            <input name="kullanici_mail" type="email" placeholder="E-Posta" required />
            <input name="kullanici_parola" type="password" placeholder="Şifre" required />
            <button name="login" class="btn-primary">Giriş Yap</button>
            <p class="password-forgot">
                <a href="mail/sifre-unuttum.php" style="float: right;">Şifremi Unuttum</a><br>
            </p>
            <br>
            <p class="message">Üye değilmisin? <a target="_blank" href="register.php">Hemen üye Ol</a></p>
        </form>
    </div>
</div>

