<?php include "index.php";

$sorgu = $db -> prepare("Select * from tblkategori where kategori_id=:id");
$sorgu -> execute(array('id' => $_GET['kategori_id']));
$veriCek = $sorgu -> fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/KategoriController.php" method="post">
        <h3>Kategori Düzenle </h3>

        <fieldset>
            <label for="SeriNo">Seri No</label>
            <input id="SeriNo" name="kategori_id" type="text" readonly tabindex="1" value="<?php echo $veriCek['kategori_id'];?>">
        </fieldset>

        <fieldset>
            <label for="KategoriAd">Kategori Ad</label>
            <input id="KategoriAd" name="kategori_ad" value="<?php echo $veriCek['kategori_ad']?>" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="KategoriSira">Kategori Sira</label>
            <input type="number" name="kategori_sira" value="<?php echo $veriCek['kategori_sira']?>" min="1" required tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="KategoriDurum">Kategori Durum</label>
            <select id="KategoriDurum" class="form-control" name="kategori_durum" required>

                <?php echo $veriCek['kategori_durum'] == '1' ? 'selected=""' : ''; ?>

                <option value="1" <?php echo $veriCek['kategori_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                <option value="0" <?php if ($veriCek['kategori_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>
            </select>
        </fieldset>

        <fieldset>
            <button name="kategoriGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>


