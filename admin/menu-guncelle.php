<?php include "index.php"; include "controller/baglan.php";

$menuSorgu = $db->prepare("SELECT * FROM tblmenuler where menu_id=:id");
$menuSorgu -> execute(array('id' => $_GET['menu_id']));
$menuCek = $menuSorgu->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/form.css">


<div class="container">
    <form id="contact" action="controller/MenuController.php" method="post">
        <h3>Menü Düzenle </h3>

        <fieldset>
            <label for="SeriNo">Seri No</label>
            <input id="SeriNo" name="menu_id" type="text" readonly tabindex="1" value="<?php echo $menuCek['menu_id'];?>">
        </fieldset>

        <fieldset>
            <label for="MenuAd">Menü Ad</label>
            <input id="MenuAd" name="menu_ad" type="text"  required value="<?php echo $menuCek['menu_ad'];?>">
        </fieldset>

        <fieldset>
            <label for="MenuUrl">Menü Url</label>
            <input id="MenuUrl" name="menu_url" type="text" tabindex="1" required value="<?php echo $menuCek['menu_url'];?>">
        </fieldset>

        <fieldset>
            <label for="">Menü Sıra</label>
            <input id="MenuSira" name="menu_sira" type="number" tabindex="1" value="<?php echo $menuCek['menu_sira'];?>">
        </fieldset>

        <fieldset>
            <label for="MenuDurum">Menü Durum</label>
            <select id="MenuDurum" class="form-control" name="menu_durumu" required>

                <?php echo $menuCek['menu_durumu'] == '1' ? 'selected=""' : ''; ?>

                <option value="1" <?php echo $menuCek['menu_durumu'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                <option value="0" <?php if ($menuCek['menu_durumu']==0) { echo 'selected=""'; } ?>>Pasif</option>
            </select>
        </fieldset>

        <fieldset>
            <button name="menuGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>



