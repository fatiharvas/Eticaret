<?php include "index.php"; include"controller/baglan.php"; ?>
<link rel="stylesheet" href="css/form.css">

<div class="container">

    <form id="contact" action="controller/OdemeController.php" method="post">
        <h3>Kasa Seç </h3>

        <?php

        $sorgu = $db ->prepare("Select * from tblkasa WHERE kasa_durum=1");
        $sorgu->execute();

        ?>
        <input type="hidden" name="siparis_id" value="<?php echo $_GET['siparis_id']?>">

        <fieldset>
            <label for="KasaId">Kasa Seç</label>
            <select name="kasa_id" id="KasaId">

                <?php

                while ($kasa = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $kasa['kasa_id']?>"><?php echo $kasa['kasa_adi']?></option>
                <?php } ?>
            </select>
        </fieldset>

        <fieldset>
            <button name="onayla" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>




