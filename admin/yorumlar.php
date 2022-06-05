<?php include "index.php"; include "controller/Fonksiyonlar.php";?>

<link rel="stylesheet" href="css/table.css">


<div class="container-fluid">
    <h1 class="table-title">Yorumlar
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
            <th><i class="flaticon-profile"></i> Kullanıcı</th>
            <th><i class="flaticon-bag"></i> Ürün</th>
            <th><i class="flaticon-envelope"></i> Yorum</th>
            <th><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

            <?php

                $sorgu = $db -> prepare("select * from tblyorumlar,tblkullanicilar,tblurunler where tblurunler.urun_id = tblyorumlar.urun_id and tblkullanicilar.kullanici_id = tblyorumlar.kullanici_id");
                $sorgu->execute();

                while ($yorumCek =$sorgu->fetch(PDO::FETCH_ASSOC)) {?>
                <tr class="tr-body">
                    <td><?php echo $yorumCek['yorum_id']?></td>
                    <td><?php echo hideInformation($yorumCek['kullanici_ad'].$yorumCek['kullanici_soyad'],3,6)?></td>
                    <td><?php echo $yorumCek['urun_ad']?></td>
                    <td><?php echo $yorumCek['yorum']?></td>
                    <td>
                        <a href="controller/YorumlarController.php?yorum_id=<?php echo $yorumCek['yorum_id']?>&yorumSil=ok">
                            <i class="flaticon-remove"></i>
                            Sil
                        </a>
                    </td>
                </tr>

                <?php } ?>
        </tbody>
    </table>
</div>

