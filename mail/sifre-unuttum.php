<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/flaticon.css">

<div class="login">
    <div class="form" style="margin-top: 100px">
        <form class="login-form" action="../admin/controller/SifreController.php" method="post">
            <h1>Şifremi Unuttum</h1>
            <?php error_reporting(0);
                if ($_GET['durum'] == 'kullaniciyok') {?>
                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Böyle Bir Kullanıcı Bulunamadı.
                    </div>
            <?php error_reporting(0);
                }else if ($_GET['durum'] == 'basarisiz') { ?>

                    <div class="alert alert-danger">
                        <strong>Hata!</strong> Mail Gönderme İşlemi Başarısız.
                    </div>
                <?php } ?>
            <input type="email" placeholder="E-Posta adresinin giriniz" name="email" required />
            <button name="unuttum" class="btn-primary">Aktivasyon Kodu Gönder</button>
        </form>
    </div>
</div>
