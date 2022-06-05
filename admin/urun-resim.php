<?php include "index.php"; include "controller/baglan.php";

$urunSorgu = $db ->prepare("select * from tblurunfoto where urun_id={$_GET['urun_id']} order by sira ");
$urunSorgu->execute();

?>

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
    <a href="urun-resim-ekle.php?urun_id=<?php echo $_GET['urun_id']?>" class="add">Resim Ekle</a>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-gallery"></i> Yüklü Resimler</th>
            <th><i class="flaticon-target"></i> Sırası</th>
            <th><i class="flaticon-gallery"></i> Profil Fotoğrafı</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

        <?php

        while ($urunCek = $urunSorgu->fetch(PDO::FETCH_ASSOC)) {?>

            <tr class="tr-body">
                <td><img style="width: 60px" src="../../<?php echo $urunCek['resim_yol']?>""></td>
                <td><?php echo $urunCek['sira']?></td>
                <td>
                    <?php
                    if ($urunCek['is_profile']) {?>
                       <button class="btn btn-info">Aktif</button>
                    <?php }
                    else {?>
                        <a href="controller/UrunFotoController.php?urun_id=<?php echo $urunCek['urun_id'];?>&urun_foto_id=<?php echo $urunCek['urun_foto_id']?>&durum=ok"><button class="btn btn-danger">Pasif</button></a>
                    <?php } ?>
                </td>
                
                <td>
                    <a href="controller/UrunFotoController.php?urun_resim_yol=<?php echo $urunCek['resim_yol']?>&resimSil=ok">
                        <i class="flaticon-remove"></i>
                        Sil
                    </a>
                </td>
                
                <td>
                    <a href="sira-guncelle.php?urun_foto_id=<?php echo $urunCek['urun_foto_id'];?>">
                    <i class="flaticon-target"></i>
                    Sıra Güncelle
                    </a>
                </td>
            </tr>

        <?php } ?>

        </tbody>
    </table>
</div>

