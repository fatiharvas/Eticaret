<?php include "baglan.php";

$sorgu = $db->prepare("SELECT * FROM tblhakkimizda where hakkimizdaId=:id");
$sorgu->execute(array('id' => 1));
$veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['hakkimizdaGuncelle'])) {

    $veriKaydet = $db -> prepare("UPDATE tblhakkimizda SET 
        baslik=:baslik,
        icerik=:icerik,
        video=:video,
        vizyon=:vizyon,
        misyon=:misyon
        WHERE hakkimizdaId = 1");

    $update = $veriKaydet ->execute(array(
        'baslik' => $_POST['baslik'],
        'icerik' => $_POST['icerik'],
        'video' => $_POST['video'],
        'vizyon' => $_POST['vizyon'],
        'misyon' => $_POST['misyon']
    ));

    if ($update) {
        header("Location:../hakkimizda.php?durum=ok");
    }else {
        header("Location:../hakkimizda.php?durum=no");
    }


}



?>