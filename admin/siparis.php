<?php include "index.php"; include "controller/baglan.php";

$sorgu = $db->prepare("select * from tblsiparis");
$sorgu->execute();

?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Siparişler</h1>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> S.No</th>
            <th><i class="flaticon-clock"></i> Sipariş Zamanı</th>
            <th><i class="flaticon-profile"></i> Kullanıcı Id</th>
            <th><i class="flaticon-shopping-cart"></i> Ürün id</th>
            <th><i class="flaticon-down-arrow"></i> Adet</th>
            <th><i class="flaticon-correct"></i> Fiyat</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

            <?php
                $say = 1;
                while($veriCek = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>

                    <tr class="tr-body">
                        <td><?php echo $say ?></td>
                        <td><?php echo $veriCek['siparis_zaman'] ?></td>
                        <td><?php echo $veriCek['kullanici_id']?></td>
                        <td><?php echo $veriCek['urun_id']?></td>
                        <td><?php echo $veriCek['urun_adet']?></td>
                        <td><?php echo $veriCek['urun_adet']*$veriCek['satis_fiyat'] ?></td>
                        <td>
                            <a href="controller/OdemeController.php?kullanici_id=<?php echo $veriCek['kullanici_id']?>">
                                <i class="flaticon-add"></i>
                                Onayla
                            </a>
                        </td>
                    </tr>


                <?php $say++; } ?>



        </tbody>
    </table>
</div>

