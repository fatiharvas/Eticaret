<?php include "baglan.php"; include "Fonksiyonlar.php";

if ($_GET['yorumSil'] == 'ok') {

    islemKontrol();
    $delete = $db->prepare("delete from tblyorumlar where yorum_id={$_GET['yorum_id']}");
    $delete->execute();

    if ($delete)
        Header("Location:../yorumlar.php?durum=ok");
    else
        Header("Location:../yorumlar.php?durum=no");

}

if ($_GET['yorumsil'] == 'ok') {

    islemKontrol();
    $delete = $db->prepare("delete from tblyorumlar where yorum_id={$_GET['yorum_id']} ");
    $delete->execute();

    if ($delete)
        Header("Location:../../urun-detay.php?urun_id={$_GET['urun_id']}");
    else
        Header("Location:../../kategoriler.php?durum=no");

}

if (isset($_POST['yorumEkle'])) {

    $sorgu = $db -> prepare("INSERT INTO tblyorumlar set
        urun_id=:urun_id,
        kullanici_id=:kullanici_id,
        yorum=:yorum,
        yorum_siniri=:yorum_siniri
    ");

    $insert = $sorgu -> execute(array(
       'urun_id' => $_POST['urun_id'],
       'kullanici_id' => $_POST['kullanici_id'],
       'yorum' => $_POST['yorum'],
       'yorum_siniri' => 1
    ));

    if ($insert)
        Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}");
    else
        Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}");
}
