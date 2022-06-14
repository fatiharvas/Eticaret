<?php include "admin/controller/baglan.php";
ob_start(); session_start();

$sorgu = $db -> prepare("Select * from tblkullanicilar where kullanici_mail=:mail");
$sorgu -> execute(array('mail' => $_SESSION['user_mail']));
$veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

?>
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

    <title>Hesabım</title>
</head>
<body>


<div class="d-lg-flex half">
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 py-5">
                    <h3 style="text-align: center">Kullanıcı Bilgilerim</h3>
                    <?php error_reporting(0);
                    if ($_GET['durum']=='ok') { ?>
                            <p style="text-align: center;color: dodgerblue" class="mb-4">İşlem Başarılı</p>
                    <?php } ?>
                    <?php if ($_GET['durum']=='no') { ?>
                        <p style="text-align: center; color: red" class="mb-4">İşlem Başarısız</p>
                    <?php } ?>
                    <form action="admin/controller/KullaniciController.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group first">
                                    <label for="fname">Ad</label>
                                    <input type="text" maxlength="30" class="form-control" name="kullanici_ad" required value="<?php echo $veriCek['kullanici_ad']?>" id="fname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group first">
                                    <label for="lname">Soyad</label>
                                    <input type="text" maxlength="30" class="form-control" name="kullanici_soyad" required value="<?php echo $veriCek['kullanici_soyad']?>" id="lname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group first">
                                    <label for="lname">Telefon Numarası</label>
                                    <input type="text" maxlength="11" minlength="11" class="form-control" name="kullanici_telefon" value="<?php echo $veriCek['kullanici_telefon']?>" id="lname">
                                </div>
                            </div>
                        </div>
                        <h3 style="text-align: center">Şifre Güncelle</h3>
                        <?php error_reporting(0);
                        if ($_GET['durum']=='eksiksifre') { ?>
                            <p style="text-align: center; color: red" class="mb-4">Şifreniz minimum 6 karakter uzunluğunda olmalıdır.</p>
                        <?php } ?>
                        <?php error_reporting(0);
                        if ($_GET['durum']=='farklisifre') { ?>
                            <p style="text-align: center; color: red" class="mb-4">Şifreler Uyuşmuyor</p>
                        <?php } ?>
                        <?php error_reporting(0);
                        if ($_GET['durum']=='yanlisifre') { ?>
                            <p style="text-align: center; color: red" class="mb-4">Şifreniz Hatalı</p>
                        <?php } ?>
                        <?php error_reporting(0);
                        if ($_GET['durum']=='bos') { ?>
                            <p style="text-align: center; color: red" class="mb-4">Şifre Boş</p>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group last mb-3">
                                    <label for="password">Parolanız</label>
                                    <input type="password" class="form-control" name="parola1" id="password">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group last mb-3">
                                    <label for="re-password">Yeni Parolanız</label>
                                    <input type="password" class="form-control" name="parola2" id="re-password">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group last mb-3">
                                    <label for="re-password">Parolanızı Onaylayın</label>
                                    <input type="password" class="form-control" name="parola3" id="re-password">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="kullanici_id" value="<?php echo $veriCek['kullanici_id'] ?>">
                        <input type="submit" name="kullaniciGuncelle" value="Güncelle" class="btn px-5 btn-primary">
                    </form>
                    <form action="hesap-sil.php?kullanici_id=<?php echo $veriCek['kullanici_id']?>" method="post">
                        <input style="float: right; background-color: red; margin-top: -55px" type="submit" value="Hesabı Sil" class="btn px-5 btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>



<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>