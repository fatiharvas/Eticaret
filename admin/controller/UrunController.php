<?php include "baglan.php"; include "Fonksiyonlar.php";

$urunSorgu = $db ->prepare("select *from tblurunler,tblkategori where tblurunler.kategori_id=tblkategori.kategori_id");
$urunSorgu ->execute();

if (isset($_POST['urunGuncelle'])) {

    $veriKaydet = $db -> prepare("UPDATE tblurunler SET
        urun_ad=:urun_ad,
        urun_detay=:urun_detay,
        urun_tanitim=:urun_tanitim,
        satis_fiyat=:satis_fiyat,
        urun_video=:urun_video,
        urun_durum=:urun_durum,
        kategori_id=:kategori_id where urun_id={$_POST['urun_id']}
    ");

    $update = $veriKaydet -> execute(array(
        'urun_ad' => $_POST['urun_ad'],
        'urun_detay' => $_POST['urun_detay'],
        'urun_tanitim' => $_POST['urun_tanitim'],
        'urun_durum' => $_POST['urun_durum'],
        'urun_video' => $_POST['urun_video'],
        'satis_fiyat' => $_POST['satis_fiyat'],
        'kategori_id' => $_POST['kategori_id']
    ));

    if ($update)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");

}


if (isset($_POST['urunEkle'])) {

    $veriEkle = $db -> prepare("INSERT INTO tblurunler SET    
        urun_ad=:urun_ad,
        urun_detay=:urun_detay,
        urun_tanitim=:urun_tanitim,
        satis_fiyat=:satis_fiyat,
        urun_video=:urun_video,
        urun_durum=:urun_durum,
        kategori_id=:kategori_id
    ");

    $insert = $veriEkle -> execute(array(
       'urun_ad' => $_POST['urun_ad'],
       'urun_detay' => $_POST['urun_detay'],
       'urun_tanitim' => $_POST['urun_tanitim'],
       'urun_video' => $_POST['urun_video'],
       'urun_durum' => $_POST['urun_durum'],
       'satis_fiyat' => $_POST['satis_fiyat'],
       'kategori_id' => $_POST['kategori_id']

    ));

    if ($insert)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");

}

if ($_GET['urunsil'] == 'ok') {

    islemKontrol();
    $delete = $db -> prepare("Delete from tblurunler where urun_id={$_GET['urun_id']}");
    $kontrol = $delete -> execute();
    if ($kontrol)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");


}

if ($_GET['one-cikar'] == 'no') {

    $update = $db-> prepare("update tblurunler set one_cikar = 0 where urun_id = {$_GET['urun_id']}");
    $kontrol = $update->execute();

    if ($kontrol)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");

}

if ($_GET['one-cikar'] == 'ok') {

    $update = $db-> prepare("update tblurunler set one_cikar = 1 where urun_id = {$_GET['urun_id']}");
    $kontrol = $update->execute();

    if ($kontrol)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");

}