<?php include "index.php"; include "controller/baglan.php";

$sorgu = $db->prepare("select * from tblsiparis order by siparis_durum = 0 desc ");
$sorgu->execute();

?>

<link rel="stylesheet" href="css/table.css">

<div class="container-fluid">
    <h1 class="table-title">Siparişler</h1>
    <table class="table-active">
        <thead class="table-header">
        <tr>
            <th><i class="flaticon-down-arrow"></i> Sipariş No</th>
            <th><i class="flaticon-clock"></i> Sipraiş Zamanı</th>
            <th><i class="flaticon-profile"></i> Sipariş Toplamı</th>
            <th><i class="flaticon-shopping-cart"></i> Sipariş Durumu</th>
            <th><i class="flaticon-down-arrow"></i> Sipariş Detay</th>
            <th colspan="2"><i class="flaticon-edit"></i> İşlem</th>
        </tr>
        </thead>

        <tbody class="table-body">

            <?php
                $say = 1;
                while($veriCek = $sorgu->fetch(PDO::FETCH_ASSOC)) {?>

                    <tr class="tr-body">
                        <td><?php echo $veriCek['siparis_id'] ?></td>
                        <td><?php echo $veriCek['siparis_zaman'] ?></td>
                        <td><?php echo $veriCek['siparis_toplam']?></td>
                        <td>
                            <?php if ($veriCek['siparis_durum'] == null) { ?>
                                <span>Sipariş İptal Edildi.</span>
                            <?php }else if ($veriCek['siparis_durum']){?>
                                <span>Onaylandı</span>
                            <?php }else { ?>
                                <a href="kasa-sec.php?siparis_id=<?php echo $veriCek['siparis_id']?>">
                                    <i class="flaticon-add"></i>
                                    Onayla
                                </a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="siparis-detay.php?siparis_id=<?php echo $veriCek['siparis_id']?>">
                                <i class="flaticon-add"></i>
                                Detay
                            </a>
                        </td>
                        <td>
                            <?php if ($veriCek['siparis_durum'] == null) { ?>

                                <span>Sipariş İptal Edildi</span>
                            <?php }else if($veriCek['siparis_durum']) { ?>
                                <span>Sipariş Teslim Edildi</span>
                            <?php }else { ?>
                                <a href="controller/OdemeController.php?siparis_id=<?php echo $veriCek['siparis_id']?>&siparisiptal=ok">
                                    <i class="flaticon-remove"></i>
                                    Siparişi İptal Et
                                </a>
                            <?php } ?>

                        </td>
                    </tr>


                <?php } ?>



        </tbody>
    </table>
</div>

