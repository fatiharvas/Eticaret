<?php include "index.php"; include "controller/UrunController.php";?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Ürünler
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
    <a href="urun-ekle.php" class="add">Ürün Ekle</a>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> S.No</th>
            <th><i class="flaticon-bag"></i> Ürün Ad</th>
            <th><i class="flaticon-shopping-cart"></i> Ürün Kategorisi</th>
            <th><i class="flaticon-timer"></i> Ürün Ekleneme Tarihi</th>
            <th><i class="flaticon-add"></i> Öne Çıkar</th>
            <th><i class="flaticon-correct"></i> Durum</th>
            <th colspan="4"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

        <?php

            while ($urunCek = $urunSorgu->fetch(PDO::FETCH_ASSOC)) {?>

                <tr class="tr-body">

                    <td><?php echo $urunCek['urun_id'];?></td>
                    <td><?php echo $urunCek['urun_ad'];?></td>
                    <td><?php echo $urunCek['kategori_ad'];?></td>
                    <td><?php $date = new DateTime($urunCek['urun_zaman']); echo $date->format("d.m.y"); ?></td>
                    <td>
                        <?php if ($urunCek['one_cikar']) { ?>
                            <a href="controller/UrunController.php?urun_id=<?php echo $urunCek['urun_id'];?>&one-cikar=no"<button class="btn btn-info">Aktif</button></a>
                        <?php } else { ?>
                            <a href="controller/UrunController.php?urun_id=<?php echo $urunCek['urun_id'];?>&one-cikar=ok"<button class="btn btn-danger">Pasif</button></a>
                        <?php } ?>

                    </td>
                    <td>
                        <?php
                        if ($urunCek['urun_durum']) {?>
                            <button class="btn btn-info">Aktif</button>
                        <?php }
                        else {?>
                            <button class="btn btn-danger">Pasif</button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="urun-guncelle.php?urun_id=<?php echo $urunCek['urun_id'];?>">
                            <i class="flaticon-refresh"></i>
                            Güncelle
                        </a>
                    </td>
                    <td>
                        <a href="controller/UrunController.php?urun_id=<?php echo $urunCek['urun_id'];?>&urunsil=ok">
                            <i class="flaticon-remove"></i>
                            Sil
                        </a>
                    </td>

                    <td>
                        <a href="urun-resim.php?urun_id=<?php echo $urunCek['urun_id'];?>">
                            <i class="flaticon-gallery"></i>
                            Resim İşlemleri
                        </a>
                    </td>

                    <td>
                        <a href="stok.php?urun_id=<?php echo $urunCek['urun_id'];?>">
                            <i class="flaticon-add"></i>
                            Stok İşlemleri
                        </a>
                    </td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
</div>

