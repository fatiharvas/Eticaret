<?php include "index.php"; include "controller/KategoriController.php";?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Kategoriler
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

    <a href="kategori-ekle.php" class="add">Kategori Ekle</a>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> S.No</th>
            <th><i class="flaticon-screen"></i> Kategori Adı</th>
            <th><i class="flaticon-link"></i> Kategori Seo Url</th>
            <th><i class="flaticon-layout"></i> Kategori Sıra</th>
            <th><i class="flaticon-correct"></i> Durum</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

        <?php

            while ($kategoriCek = $kategoriSorgu -> fetch(PDO::FETCH_ASSOC)) {?>

            <tr class="tr-body">

                <td><?php echo $kategoriCek['kategori_id'];?></td>
                <td><?php echo $kategoriCek['kategori_ad'];?></td>
                <td><?php echo $kategoriCek['kategori_seo_url'];?></td>
                <td><?php echo $kategoriCek['kategori_sira'];?></td>
                <td>
                    <?php
                    if ($kategoriCek['kategori_durum']) {?>
                        <a href="controller/KategoriController.php?kategori_id=<?php echo $kategoriCek['kategori_id'];?>&kategoridurum=no"<button class="btn btn-info">Aktif</button></a>
                    <?php }
                    else {?>
                        <a href="controller/KategoriController.php?kategori_id=<?php echo $kategoriCek['kategori_id'];?>&kategoridurum=ok"<button class="btn btn-danger">Pasif</button></a>
                    <?php } ?>
                </td>
                <td>
                    <a href="kategori-guncelle.php?kategori_id=<?php echo $kategoriCek['kategori_id'];?>">
                        <i class="flaticon-refresh"></i>
                        <span class="updateButton">Güncelle</span>
                    </a>
                </td>
        <?php } ?>
        </tbody>
    </table>
</div>

