<?php include "index.php"; include "controller/KasaController.php"?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Kasalar
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
    <a href="kasa-ekle.php" class="add">Kasa Ekle</a>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> Kasa Id</th>
            <th>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-safe" viewBox="0 0 16 16">
                    <path d="M1 1.5A1.5 1.5 0 0 1 2.5 0h12A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 1 14.5V13H.5a.5.5 0 0 1 0-1H1V8.5H.5a.5.5 0 0 1 0-1H1V4H.5a.5.5 0 0 1 0-1H1V1.5zM2.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-12z"/>
                    <path d="M13.5 6a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zM4.828 4.464a.5.5 0 0 1 .708 0l1.09 1.09a3.003 3.003 0 0 1 3.476 0l1.09-1.09a.5.5 0 1 1 .707.708l-1.09 1.09c.74 1.037.74 2.44 0 3.476l1.09 1.09a.5.5 0 1 1-.707.708l-1.09-1.09a3.002 3.002 0 0 1-3.476 0l-1.09 1.09a.5.5 0 1 1-.708-.708l1.09-1.09a3.003 3.003 0 0 1 0-3.476l-1.09-1.09a.5.5 0 0 1 0-.708zM6.95 6.586a2 2 0 1 0 2.828 2.828A2 2 0 0 0 6.95 6.586z"/>
                </svg>
                <i class="bi bi-safe"></i>
                Kasa Adı
            </th>
            <th><i class="flaticon-presentation"></i> Kasa Miktarı</th>
            <th><i class="flaticon-correct"></i> Durum</th>
            <th><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

        <?php

            while($kasa = $sorgu -> fetch(PDO::FETCH_ASSOC)) {?>

                <tr class="tr-body">
                    <td><?php echo $kasa['kasa_id']?></td>
                    <td><?php echo $kasa['kasa_adi']?></td>
                    <td><?php echo $kasa['kasa_miktari']?></td>
                    <td>
                        <?php if ($kasa['kasa_durum']) {?>
                            <button class="btn btn-info">Aktif</button>
                        <?php }else { ?>
                            <button class="btn btn-danger">Pasif</button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="kasa-guncelle.php?kasa_id=<?php echo $kasa['kasa_id'] ?>">
                            <i class="flaticon-refresh"></i>
                            Güncelle
                        </a>
                    </td>
                </tr>


            <?php } ?>

        </tbody>
    </table>
</div>

