<?php include "baglan.php"; include "Fonksiyonlar.php";

$sorgu = $db -> prepare("Select * from tblurunfoto");
$sorgu ->execute();
$sayi = $sorgu -> rowCount();

if ($sayi == 0) {
    $sil = $db->prepare("TRUNCATE TABLE tblurunfoto");
    $sil->execute();
}

if (isset($_POST['siraGuncelle'])) {

    $veriKaydet = $db -> prepare("Update tblurunfoto set sira={$_POST['sira']} where urun_foto_id={$_POST['urun_foto_id']}");
    $update = $veriKaydet->execute();

    if ($update)
        Header("Location:../urunler.php?&durum=ok");
    else
        Header("Location:../urunler.php?&durum=no");


}

if ($_GET['resimSil'] == 'ok') {

    $resim_yol = $_GET['urun_resim_yol'];
    $delete = $db -> prepare("DELETE FROM tblurunfoto WHERE resim_yol=:resim_yol");
    $kontrol = $delete -> execute(array('resim_yol' => $resim_yol));
    unlink('../../'.$resim_yol);

    if ($kontrol)
        Header("Location:../urunler.php?durum=ok");
    else
        Header("Location:../urunler.php?durum=no");
}


if ($_GET['durum'] == 'ok') {

    $urun_foto_id = $_GET['urun_foto_id'];
    $urun_id = $_GET['urun_id'];

    $update = $db -> prepare("update tblurunfoto set is_profile = 0 where urun_id={$urun_id}");
    $update->execute();

    if ($update) {
        $update = $db -> prepare("update tblurunfoto set is_profile = 1 where urun_foto_id={$urun_foto_id}");
        $update->execute();
        header("Location:../urun-resim.php?urun_id=$urun_id");
    }else
        header("Location:../urun-resim.php?durum=no");


}

if (isset($_POST['fotoEkle'])) {

    $uploads_dir = '../../img/urun-foto';
    @$tmp_name = $_FILES['resim_yol']["tmp_name"];
    @$name = $_FILES['resim_yol']["name"];
    $benzersizsayi1=rand(20000,32000);
    $benzersizsayi2=rand(20000,32000);
    $benzersizsayi3=rand(20000,32000);
    $benzersizsayi4=rand(20000,32000);

    $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
    $resimYol = substr($uploads_dir, 6)."/".$benzersizad.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $urun_id=$_POST['urun_id'];

    if ($_POST['is_profile']) {
        $is_profile = 1;
        $sorgu = $db -> prepare("Select * from tblurunfoto where urun_id=$urun_id and is_profile = 1");
        $sorgu -> execute();
        $sayi = $sorgu ->rowCount();

        if ($sayi > 0) {
            $update = $db -> prepare("update tblurunfoto set is_profile = 0 where urun_id=$urun_id");
            $update->execute();
        }
    }
    else {
        $is_profile = 0;
    }

    $kaydet = $db ->prepare("INSERT INTO tblurunfoto SET 
        urun_id=:urun_id,
        resim_yol=:resim_yol,
        sira=:sira,
        is_profile=:is_profile
    ");

    $insert = $kaydet -> execute(array(
        'urun_id' => $urun_id,
        'resim_yol' => $resimYol,
        'sira' => $_POST['sira'],
        'is_profile' => $is_profile
    ));

    if ($insert)
        header("Location:../urun-resim.php?urun_id=$urun_id");
    else
        header("Location:../urun-resim.php?durum=no");

}


