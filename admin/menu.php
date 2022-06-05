<?php include "index.php"; include "controller/MenuController.php"; ?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Menüler
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
    <a href="menu-ekle.php" class="add">Menü Ekle</a>

    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> S.No</th>
            <th><i class="flaticon-menu"></i> Menü Ad</th>
            <th><i class="flaticon-link"></i> Menü Url</th>
            <th><i class="flaticon-link"></i> Menü SeoUrl</th>
            <th><i class="flaticon-layout"></i> Menü Sıra</th>
            <th><i class="flaticon-correct"></i> Durum</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

        <?php

            while ($menuCek = $menuSorgu->fetch(PDO::FETCH_ASSOC)){?>

                <tr class="tr-body">
                    <td><?php echo $menuCek['menu_id'];?></td>
                    <td><?php echo $menuCek['menu_ad'];?></td>
                    <td><?php echo $menuCek['menu_url'];?></td>
                    <td><?php echo $menuCek['menu_seo_url'];?></td>
                    <td><?php echo $menuCek['menu_sira'];?></td>

                    <td>
                        <?php
                        if ($menuCek['menu_durumu']) {?>
                            <button class="btn btn-info">Aktif</button>
                        <?php }
                        else {?>
                            <button class="btn btn-danger">Pasif</button>
                        <?php } ?>
                    </td>

                    <td>
                        <a href="menu-guncelle.php?menu_id=<?php echo $menuCek['menu_id'];?>">
                            <i class="flaticon-refresh"></i>
                            <span class="updateButton">Güncelle</span>
                        </a>
                    </td>
                    <td>
                        <a href="controller/MenuController.php?menu_id=<?php echo $menuCek['menu_id'];?>&menusil=ok">
                            <i class="flaticon-remove"></i>
                            <span class="deleteButton">Sil</span>
                        </a>
                    </td>
                </tr>
        <?php } ?>

        </tbody>
    </table>
</div>


