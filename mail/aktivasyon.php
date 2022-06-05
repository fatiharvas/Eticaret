<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/flaticon.css">

<div class="login">
    <div class="form">
        <form class="login-form" action="../admin/controller/SifreController.php" method="post">
            <h1>Şifremi Unuttum</h1>
            <?php error_reporting(0);
                if ($_GET['durum'] == 'basarisiz') { ?>
                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Aktivasyon Kodu Hatalı.
                    </div>
            <?php } ?>
            <input type="text" name="aktivasyon" placeholder="E-posta Adresinize Gelen Kodu Giriniz." required />
            <button name="gonder" class="btn-primary">Doğrula</button>

        </form>
    </div>
</div>
