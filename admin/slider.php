<?php include "index.php"; include "controller/SliderController.php";?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Sliderlar

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
    <a href="slider-ekle.php" class="add">Slider Ekle</a>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> S.No</th>
            <th><i class="flaticon-info"></i> Ad</th>
            <th><i class="flaticon-info"></i> Detay</th>
            <th><i class="flaticon-gallery"></i> Resim</th>
            <th><i class="flaticon-link"></i> Link</th>
            <th><i class="flaticon-layout"></i> Sıra</th>
            <th><i class="flaticon-correct"></i> Durum</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

            <?php

            while ($sliderCek = $sliderSorgu -> fetch(PDO::FETCH_ASSOC)){?>

            <tr class="tr-body">
                <td><?php echo $sliderCek['sliderId']?></td>
                <td><?php echo $sliderCek['sliderAd']?></td>
                <td><?php echo $sliderCek['sliderDetay']?></td>
                <td><img width="60px" src="../../<?php echo $sliderCek['sliderResimYol']?>" alt=""></td>
                <td><?php echo $sliderCek['sliderLink']?></td>
                <td><?php echo $sliderCek['sliderSira']?></td>
                <td>
                    <?php
                    if ($sliderCek['sliderDurumu']) {?>
                        <a href="controller/SliderController.php?sliderId=<?php echo $sliderCek['sliderId'];?>&sliderDurum=no"<button class="btn btn-info">Aktif</button></a>
                    <?php }
                    else {?>
                        <a href="controller/SliderController.php?sliderId=<?php echo $sliderCek['sliderId'];?>&sliderDurum=ok"<button class="btn btn-danger">Pasif</button></a>
                    <?php } ?>
                </td>
                <td>
                    <a href="slider-guncelle.php?sliderId=<?php echo $sliderCek['sliderId'];?>">
                        <i class="flaticon-refresh"></i>
                        <span class="updateButton">Güncelle</span>
                    </a>
                </td>
                <td>
                    <a href="controller/SliderController.php?sliderId=<?php echo $sliderCek['sliderId'];?>&slidersil=ok">
                        <i class="flaticon-remove"></i>
                        <span class="deleteButton">Sil</span>
                    </a>
                </td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>

