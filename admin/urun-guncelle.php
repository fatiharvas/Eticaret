<?php include "index.php"; include "controller/baglan.php";

$sorgu = $db -> prepare("Select * from tblurunler where urun_id={$_GET['urun_id']}");
$sorgu -> execute();
$urunCek = $sorgu ->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/UrunController.php" method="post">
        <h3>Ürün Güncelle </h3>

        <?php

        $sorgu = $db ->prepare("Select * from tblkategori WHERE kategori_durum=1");
        $sorgu->execute();
        ?>

        <fieldset>
            <label for="urunNo">Seri No</label>
            <input id="urunNo" name="urun_id" value="<?php echo $urunCek['urun_id']?>" readonly type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="KategoriId">Kategori Seç</label>
            <select name="kategori_id" class="form-control" required id="KategoriId">

                <?php

                while ($kategoriCek=$sorgu->fetch(PDO::FETCH_ASSOC)) {
                    $kategori_id = $kategoriCek['kategori_id'];

                    ?>
                    <option value="<?php echo $kategoriCek['kategori_id'] ?>"><?php echo $kategoriCek['kategori_ad']?></option>
                <?php } ?>
            </select>
        </fieldset>

        <fieldset>
            <label for="urunAd">Ürün Ad</label>
            <input id="urunAd" name="urun_ad" maxlength="250" value="<?php echo $urunCek['urun_ad']?>" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="urunDetay">Ürün Detay</label>
            <textarea class="ckeditor" id="urunDetay" name="urun_detay" required style="width: 100%" ><?php echo $urunCek['urun_detay']?></textarea>
        </fieldset>

        <fieldset>
            <label for="urunDetay">Ürün Tanıtım</label>
            <textarea id="urunTanitim" name="urun_tanitim" maxlength="100" required style="width: 100%" ><?php echo $urunCek['urun_tanitim']?></textarea>
        </fieldset>

        <fieldset>
            <label for="urunVideo">Ürün Video Link</label>
            <input id="urunVideo" name="urun_video" maxlength="250" type="text" value="<?php echo $urunCek['urun_video']?>" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="satisFiyat">Satış Fiyatı</label>
            <input id="satisFiyat" name="satis_fiyat" type="number" min="1" required step="0.01" tabindex="1" value="<?php echo $urunCek['satis_fiyat']?>" ">
        </fieldset>

        <fieldset>
            <label for="urunDurum">Ürün Durum</label>
            <select id="urunDurum" class="form-control" name="urun_durum" required>

                <?php echo $urunCek['urun_durum'] == '1' ? 'selected=""' : ''; ?>

                <option value="1" <?php echo $urunCek['urun_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                <option value="0" <?php if ($urunCek['urun_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>
            </select>
            <br>
        </fieldset>

        <fieldset>
            <button name="urunGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>


