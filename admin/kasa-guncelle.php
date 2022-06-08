<?php include "index.php"; include "controller/baglan.php";

$kasa = $db->prepare("select * from tblkasa where kasa_id = {$_GET['kasa_id']}");
$kasa->execute();
$kasaCek = $kasa->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/KasaController.php" method="post">
        <h3>Kasa Güncelle </h3>

        <fiedset>
            <label for="KasaId">Kasa Id</label>
            <input type="text" value="<?php echo $kasaCek['kasa_id']?>" readonly name="kasa_id">
        </fiedset>

        <fieldset>
            <label for="KasaAd">Kasa Ad</label>
            <input id="KasaAd" name="kasa_adi" required type="text" value="<?php echo $kasaCek['kasa_adi']?>" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="KasaDurum">Kasa Durumu</label>
            <select name="kasa_durum" id="KasaDurum">

                <?php echo $kasaCek['kasa_durum'] == '1' ? 'selected=""' : ''; ?>

                <option value="1" <?php echo $kasaCek['kasa_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                <option value="0" <?php if ($kasaCek['kasa_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>


            </select>
        </fieldset>

        <fieldset>
            <button name="kasaGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>

