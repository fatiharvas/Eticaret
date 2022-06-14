<?php include "index.php"; include"controller/baglan.php"; ?>
<link rel="stylesheet" href="css/form.css">

<head>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>

<div class="container">
    <form id="contact" action="controller/UrunController.php" method="post">
        <h3>Ürün Ekle </h3>

        <?php

            $sorgu = $db ->prepare("Select * from tblkategori WHERE kategori_durum=1");
            $sorgu->execute();
        ?>
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
            <input id="urunAd" name="urun_ad" maxlength="250" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="urunDetay">Ürün Detay</label>
            <textarea class="ckeditor" id="urunDetay" name="urun_detay" required style="width: 100%" ></textarea>
        </fieldset>

        <fieldset>
            <label for="urunDetay">Ürün Tanıtım</label>
            <textarea id="urunTanitim" name="urun_tanitim" maxlength="100" required style="width: 100%" ></textarea>
        </fieldset>

        <fieldset>
            <label for="urunVideo">Ürün Video Link</label>
            <input id="urunVideo" name="urun_video" type="text" maxlength="250" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="satisFiyat">Satış Fiyatı</label>
            <input id="satisFiyat" name="satis_fiyat" type="number" min="1" required step="0.01" tabindex="1"">
        </fieldset>

        <fieldset>
            <label for="urunDurum">Ürün Durum</label>
            <select id="urunDurum" class="form-control" name="urun_durum" required>

                <option value="1" >Aktif</option>
                <option value="0">Pasif</option>

            </select>
            <br>
        </fieldset>

        <fieldset>
            <button name="urunEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>


