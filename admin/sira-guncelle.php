<?php include "index.php";

$sira = $db -> prepare("select * from tblurunfoto where urun_foto_id={$_GET['urun_foto_id']}");
$sira -> execute();
$veriCek = $sira->fetch(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="css/form.css">

<div class="container">
    <form id="contact" action="controller/UrunFotoController.php" method="post">
        <h3>Sıra Güncelle</h3>

        <fieldset>
            <label for="Sira">Sıra</label>
            <input id="Sira" name="sira" type="number" min="1" tabindex="1" value="<?php echo $veriCek['sira']?>" required >
        </fieldset>

        <input type="hidden" name="urun_foto_id" value="<?php echo $veriCek['urun_foto_id']?>">

        <fieldset>
            <button name="siraGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>
