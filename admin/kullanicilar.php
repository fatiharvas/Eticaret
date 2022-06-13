<?php include "index.php"; include "controller/KullaniciController.php";?>
<link rel="stylesheet" href="css/table.css">
<div class="container-fluid">
    <h1 class="table-title">Kullanıcılar
        <small>
            <?php
            error_reporting(0);
            if ($_GET['durum']=="ok") {?>
                <b style="color:green;">İşlem Başarılı...</b>

            <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

            <?php } ?>
        </small>
    </h1>
    <table class="table-active">
        <thead class="table-header">
            <tr>
                <th><i class="flaticon-down-arrow"></i> S.No</th>
                <th><i class="flaticon-calendar"></i> Kayıt Tarih</th>
                <th><i class="flaticon-credit-card"></i> Ad Soyad</th>
                <th><i class="flaticon-envelope"></i> Mail Adresi</th>
                <th><i class="flaticon-smartphone"></i> Telefon</th>
                <th><i class="flaticon-correct"></i> Durum</th>
                <th><i class="flaticon-edit"></i> İşlem</th>
            </tr>
        </thead>

        <tbody class="table-body">

        <?php

            while ($kullaniciCek = $kullaniciSorgu->fetch(PDO::FETCH_ASSOC)){?>

                <tr class="tr-body">
                    <td><?php echo $kullaniciCek['kullanici_id'];?></td>
                    <td><?php echo $kullaniciCek['kullanici_zaman'];?></td>
                    <td><?php echo $kullaniciCek['kullanici_ad']," - ",$kullaniciCek['kullanici_soyad'];?></td>
                    <td><?php echo hideInformation($kullaniciCek['kullanici_mail'], 2, (strlen($kullaniciCek['kullanici_mail']) - 6));?></td>
                    <td>
                        <?php if ($kullaniciCek['kullanici_telefon'] == null) {
                            echo "-";

                        }else {
                            echo hideInformation($kullaniciCek['kullanici_telefon'], 2, (strlen($kullaniciCek['kullanici_telefon']) - 4));
                         }?>
                    </td>
                    <td>
                        <?php
                            if ($kullaniciCek['kullanici_durum']) {?>
                                <button class="btn btn-info">Aktif</button>
                            <?php }
                             else {?>
                                <button class="btn btn-danger">Pasif</button>
                             <?php } ?>
                    </td>
                    <td>
                        <a href="controller/KullaniciController.php?kullanici_id=<?php echo $kullaniciCek['kullanici_id'];?>&sil=ok">
                            <button class="btn btn-danger">Sil</button>
                        </a>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

