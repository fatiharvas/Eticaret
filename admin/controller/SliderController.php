<?php include "baglan.php";

$sliderSorgu = $db ->prepare("SELECT * FROM tblslider");
$sliderSorgu -> execute();

$sayi = $sliderSorgu -> rowCount();

if ($sayi == 0) {
    $sil = $db->prepare("TRUNCATE TABLE tblslider");
    $sil->execute();
}

if (isset($_POST['sliderGuncelle'])) {

    $uploads_dir = '../../img';
    @$tmp_name = $_FILES['sliderResimYol']["tmp_name"];
    @$name = $_FILES['sliderResimYol']["name"];

    $randomSayi1 = rand(20000, 32000);
    $randomSayi2 = rand(20000, 32000);
    $randomSayi3 = rand(20000, 32000);
    $randomSayi4 = rand(20000, 32000);

    $randomAd = $randomSayi1.$randomSayi2.$randomSayi3.$randomSayi4;
    $resimYol = substr($uploads_dir, 6)."/".$randomAd.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$randomAd$name");

    $veriKaydet = $db -> prepare("Update tblslider set 
        sliderAd=:sliderAd,            
        sliderDetay=:sliderDetay,            
        sliderResimYol=:sliderResimYol,            
        sliderSira=:sliderSira,            
        sliderLink=:sliderLink where sliderId={$_POST['sliderId']}
        ");

    $update = $veriKaydet -> execute(array(
        'sliderAd' => $_POST['sliderAd'],
        'sliderDetay' => $_POST['sliderDetay'],
        'sliderResimYol' => $resimYol,
        'sliderSira' => $_POST['sliderSira'],
        'sliderLink' => $_POST['sliderLink']
    ));


    if ($update)
        header("Location:../slider.php?durum=ok");
    else
        header("Location:../slider.php?durum=no");

}

if ($_GET['slidersil'] == 'ok') {

    $delete = $db -> prepare("DELETE FROM tblslider WHERE sliderId=:id");
    $kontrol = $delete -> execute(array('id' => $_GET['sliderId']));

    if ($kontrol)
        Header("Location:../slider.php?&durum=ok");
    else
        Header("Location:../slider.php?&durum=no");


}

if (isset($_POST['sliderEkle'])) {


    $uploads_dir = '../../img';
    @$tmp_name = $_FILES['sliderResimYol']["tmp_name"];
    @$name = $_FILES['sliderResimYol']["name"];

    $randomSayi1 = rand(20000, 32000);
    $randomSayi2 = rand(20000, 32000);
    $randomSayi3 = rand(20000, 32000);
    $randomSayi4 = rand(20000, 32000);

    $randomAd = $randomSayi1.$randomSayi2.$randomSayi3.$randomSayi4;
    $resimYol = substr($uploads_dir, 6)."/".$randomAd.$name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$randomAd$name");

    $kaydet = $db -> prepare('INSERT INTO tblslider SET 
              sliderAd=:sliderAd,            
              sliderDetay=:sliderDetay,            
              sliderResimYol=:sliderResimYol,            
              sliderSira=:sliderSira,            
              sliderLink=:sliderLink,            
              sliderDurumu=:sliderDurumu
              ');


    $insert = $kaydet -> execute(array(
        'sliderAd' => $_POST['sliderAd'],
        'sliderDetay' => $_POST['sliderDetay'],
        'sliderResimYol' => $resimYol,
        'sliderSira' => $_POST['sliderSira'],
        'sliderLink' => $_POST['sliderLink'],
        'sliderDurumu' => $_POST['sliderDurumu']
    ));

    if ($insert)
        header("Location:../slider.php?durum=ok");
    else
        header("Location:../slider.php?durum=no");
}


if ($_GET['sliderDurum'] == "no") {
    $update = $db -> prepare("UPDATE tblslider SET sliderDurumu = 0 WHERE sliderId = {$_GET['sliderId']}");
    $kontrol = $update -> execute();

    if ($kontrol)
        header("Location:../slider.php");
    else
        header("Location:../slider.php?&durum=no");
}

if ($_GET['sliderDurum'] == "ok") {
    $update = $db -> prepare("UPDATE tblslider SET sliderDurumu = 1 WHERE sliderId = {$_GET['sliderId']}");
    $kontrol = $update -> execute();

    if ($kontrol)
        header("Location:../slider.php");
    else
        header("Location:../slider.php?&durum=no");
}

if ($_GET['slidersil'] == 'ok') {

    $sliderResimYol = $_GET['sliderResimYol'];
    $delete = $db -> prepare("DELETE FROM tblslider WHERE sliderResimYol={$sliderResimYol}");
    $kontrol = $delete -> execute();
    unlink('../../'.$sliderResimYol);

    if ($kontrol) {

        Header("Location:../slider.php");

    } else {

        Header("Location:../slider.php&durum=no");
    }

}
