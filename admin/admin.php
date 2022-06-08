<?php include "index.php"; include "controller/AdminController.php"; include "controller/Fonksiyonlar.php";
$adminSorgu = $db -> prepare("SELECT * FROM tblkullanicilar WHERE kullanici_yetkisi=:kullanici_yetkisi");
$adminSorgu->execute(array('kullanici_yetkisi' => 1));
?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Admin-Ayarları
        <?php
        error_reporting(0);
        if ($_GET['durum']=="ok") {?>
            <b style="color:green;">İşlem Başarılı...</b>

        <?php } elseif ($_GET['durum']=="no") {?>

            <b style="color:red;">İşlem Başarısız...</b>

        <?php } ?>
    </h1>
    <a href="admin-ekle.php" class="add">Admin Ekle</a>
    <table class="table-active">
        <thead class="table-header">
            <tr>
                <th><i class="flaticon-down-arrow"></i> S.No</th>
                <th><i class="flaticon-calendar"></i> Kayıt Tarih</th>
                <th><i class="flaticon-credit-card"></i> Ad Soyad</th>
                <th><i class="flaticon-envelope"></i> Mail Adresi</th>
                <th><i class="flaticon-smartphone"></i> Telefon</th>
                <th><i class="flaticon-correct"></i> Durum</th>
                <th ><i class="flaticon-edit"></i> İşlem</th>
            </tr>

        </thead>

        <tbody class="table-body">

        <?php

            while ($veriCek = $adminSorgu -> fetch(PDO::FETCH_ASSOC)) { ?>

                <tr class="tr-body">

                    <td><?php echo $veriCek['kullanici_id']?></td>
                    <td><?php echo $veriCek['kullanici_zaman']?></td>
                    <td><?php echo $veriCek['kullanici_ad']," - ",$veriCek['kullanici_soyad'];?></td>
                    <td><?php echo hideInformation($veriCek['kullanici_mail'], 2, (strlen($veriCek['kullanici_mail']) - 4));?></td>
                    <td><?php echo hideInformation($veriCek['kullanici_telefon'], 2, (strlen($veriCek['kullanici_telefon']) - 4));?></td>
                    <td>
                        <?php
                        if ($veriCek['kullanici_durum']) {?>
                            <a href="controller/AdminController.php?kullanici_id=<?php echo $veriCek['kullanici_id'];?>&kullanicidurum=no"<button class="btn btn-info">Aktif</button></a>
                        <?php }
                        else {?>
                            <a href="controller/AdminController.php?kullanici_id=<?php echo $veriCek['kullanici_id'];?>&kullanicidurum=ok"<button class="btn btn-danger">Pasif</button></a>
                        <?php } ?>
                    </td>

                    <td>
                        <a href="admin-guncelle.php?kullanici_id=<?php echo $veriCek['kullanici_id'];?>">
                            <i class="flaticon-refresh"></i>
                            <span class="updateButton">Güncelle</span>
                        </a>
                    </td>

                    <td>
                        <a href="controller/AdminController.php?kullanici_id=<?php echo $veriCek['kullanici_id'];?>&kullanicisil=ok">
                            <i class="flaticon-remove"></i>
                            <span class="deleteButton">Sil</span>
                        </a>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
</div>