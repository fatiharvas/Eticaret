<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/flaticon.css">

<div class="login">
    <div class="form">
        <form class="login-form" method="post" action="../admin/controller/SifreController.php">
            <h1>Şifreyi Yenile</h1>
            <?php error_reporting(0);
            if ($_GET['durum'] == 'parolauyusmuyor') { ?>
                <div class="alert alert-danger">
                    <strong>Hata!</strong> Parolalar Uyuşmuyor.
                </div>
            <?php } ?>
            <input name="parola1" minlength="6" type="password" placeholder="Şifre" required />
            <input name="parola2" minlength="6" type="password" placeholder="Şifrenizi Onaylayın" required />
            <button name="sifre" class="btn-primary">Onayla</button>
        </form>
    </div>
</div>
