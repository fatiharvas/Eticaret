<?php include "baglan.php"; include "Fonksiyonlar.php";


$kategoriSorgu = $db -> prepare("Select * from tblkategori");
$kategoriSorgu -> execute();


if (isset($_POST['kategoriGuncelle'])) {

    $kategori_seo_url = SEOLink($_POST['kategori_ad']);

    $veriGuncelle = $db -> prepare("UPDATE tblkategori set
        kategori_ad=:kategori_ad,
        kategori_seo_url=:kategori_seo_url,
        kategori_sira=:kategori_sira,
        kategori_durum=:kategori_durum
        where kategori_id={$_POST['kategori_id']}
    ");

    $update = $veriGuncelle -> execute(array(
        'kategori_ad' => $_POST['kategori_ad'],
        'kategori_seo_url' => $kategori_seo_url,
        'kategori_sira' => $_POST['kategori_sira'],
        'kategori_durum' => $_POST['kategori_durum']
    ));

    if ($update)
        Header("Location:../kategoriler.php?&durum=ok");
    else
        Header("Location:../kategoriler.php?&durum=no");


}

if (isset($_POST['kategoriEkle'])) {

    $kategori_seo_url = SEOLink($_POST['kategori_ad']);

    $veriEkle = $db -> prepare("Insert Into tblkategori set 
        kategori_ad=:kategori_ad,
        kategori_seo_url=:kategori_seo_url,
        kategori_sira=:kategori_sira,
        kategori_durum=:kategori_durum
    ");

    $insert = $veriEkle -> execute(array(
        'kategori_ad' => $_POST['kategori_ad'],
        'kategori_seo_url' => $kategori_seo_url,
        'kategori_sira' => $_POST['kategori_sira'],
        'kategori_durum' => $_POST['kategori_durum']
    ));

    if ($insert)
        Header("Location:../kategoriler.php?&durum=ok");
    else
        Header("Location:../kategoriler.php?&durum=no");

}

if ($_GET['kategoridurum'] == 'no') {

    islemKontrol();
    $update = $db ->prepare("Update tblkategori set kategori_durum = 0 where kategori_id={$_GET['kategori_id']}");
    $kontrol = $update -> execute();

    if ($kontrol)
        Header("Location:../kategoriler.php?&durum=ok");
    else
        Header("Location:../kategoriler.php?&durum=no");

}

if ($_GET['kategoridurum'] == 'ok') {

    islemKontrol();
    $update = $db ->prepare("Update tblkategori set kategori_durum = 1 where kategori_id={$_GET['kategori_id']}");
    $kontrol = $update -> execute();

    if ($kontrol)
        Header("Location:../kategoriler.php?&durum=ok");
    else
        Header("Location:../kategoriler.php?&durum=no");

}







