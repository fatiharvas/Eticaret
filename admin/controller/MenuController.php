<?php include "baglan.php"; include "Fonksiyonlar.php";

$menuSorgu = $db -> prepare("SELECT * FROM tblmenuler");
$menuSorgu -> execute();


if (isset($_POST['menuGuncelle'])) {

    $menu_id = $_POST['menu_id'];
    $menu_seo_url = SEOLink($_POST['menu_ad']);

    $veriKaydet = $db -> prepare("UPDATE tblmenuler SET
        menu_ad=:menu_ad,
        menu_url=:menu_url,
        menu_seo_url=:menu_seo_url,
        menu_sira=:menu_sira,
        menu_durumu=:menu_durumu
        WHERE menu_id={$_POST['menu_id']}
    ");

    $update = $veriKaydet->execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_url' => $_POST['menu_url'],
        'menu_seo_url' => $menu_seo_url,
        'menu_sira' => $_POST['menu_sira'],
        'menu_durumu' => $_POST['menu_durumu']
    ));

    if ($update) {

        Header("Location:../menu.php?menu_id=$menu_id&durum=ok");

    } else {

        Header("Location:../menu.php?menu_id=$menu_id&durum=no");
    }
}

if (isset($_POST['menuEkle'])) {

    $menu_seo_url = SEOLink($_POST['menu_ad']);

    $veriEkle = $db -> prepare("INSERT INTO tblmenuler SET 
        menu_ad=:menu_ad,
        menu_url=:menu_url,
        menu_sira=:menu_sira,
        menu_seo_url=:menu_seo_url,
        menu_durumu=:menu_durumu
    ");

    $insert = $veriEkle -> execute(array(
        'menu_ad' => $_POST['menu_ad'],
        'menu_url' => $_POST['menu_url'],
        'menu_sira' => $_POST['menu_sira'],
        'menu_seo_url' => $menu_seo_url,
        'menu_durumu' => $_POST['menu_durumu']
    ));

    if ($insert) {

        Header("Location:../menu.php?&durum=ok");

    } else {

        Header("Location:../menu.php?&durum=no");
    }

}

if ($_GET['menusil'] == 'ok') {

    $delete = $db -> prepare("DELETE FROM tblmenuler WHERE menu_id=:id");
    $kontrol = $delete -> execute(array(
        'id' => $_GET['menu_id']
    ));

    if ($kontrol) {

        Header("Location:../menu.php?&sil=ok");

    } else {

        Header("Location:../menu.php?&sil=no");
    }

}

