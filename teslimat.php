<?php include "admin/controller/baglan.php"; ob_start(); session_start();

$sorgu = $db->prepare("select * from tbladres,tblkullanicilar where tbladres.kullanici_id = tbladres.kullanici_id and tblkullanicilar.kullanici_mail='{$_SESSION['user_mail']}' and tbladres.kaydet = 1");
$sorgu->execute();

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teslimat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image {
        td, th {
            vertical-align: middle;
        }
        }



        .ekle {
            float: right;
            box-shadow: 1px 1px 1px 1px black;
            width: 100%;
            padding: 5px;
            border: 1px solid black;
            color: black;
            text-align: center;
            background-color: darkcyan;
            border-radius: 5px;
        }
        .ekle:hover {
            color: #1D9BF0;
        }
    </style>

</head>
<body>

<?php

    if ($sorgu->rowCount() > 0) { ?>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 style="text-align: center">Adres Seç
                        <?php
                        error_reporting(0);
                        if ($_GET['durum']=="ok") {?>
                            <b style="color:green;">İşlem Başarılı...</b>

                        <?php } elseif ($_GET['durum']=="no") {?>

                            <b style="color:red;">İşlem Başarısız...</b>

                        <?php } ?>
                    </h2>
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">Sıra</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">İl</th>
                                <th scope="col">İlçe</th>
                                <th scope="col">Adres</th>
                                <th colspan="3" scope="col">İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $say = 1;
                                while ($veriCek = $sorgu->fetch(PDO::FETCH_ASSOC)){?>

                                    <tr>
                                        <td><span><?php echo $say; ?></span></td>
                                        <td><?php echo $veriCek['ad']?></td>
                                        <td><?php echo $veriCek['soyad']?></td>
                                        <td><?php echo $veriCek['telefon']?></td>
                                        <td><?php echo $veriCek['il']?></td>
                                        <td><?php echo $veriCek['ilce']?></td>
                                        <td><?php echo $veriCek['adres']?></td>
                                        <td>
                                            <a href="admin/controller/OdemeController.php?adres_id=<?php echo $veriCek['adres_id']?>&adressil=ok">
                                                <span>Sil</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="teslimat-guncelle.php?adres_id=<?php echo $veriCek['adres_id']?>">
                                                <span>Güncelle</span>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="odeme.php?adres_id=<?php echo $veriCek['adres_id']?>">
                                                <span>Seç</span>
                                            </a>
                                        </td>

                                    </tr>

                                <?php $say++; } ?>

                        </tbody>
                    </table>
                    <a style="text-decoration: none;" class="ekle" href="odeme.php">
                        Yeni Adres Gir
                    </a>
                </div>
            </div>
        </div>

<?php }else

     header("Location:/index.php/odeme.php");

    ?>


<script>

    $("input:checkbox").on('click', function () {

        var $box = $(this);

        if ($box.is(":chcked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        }else {
            $box.prop("checked", false);
        }

    });


</script>

</body>
</html>