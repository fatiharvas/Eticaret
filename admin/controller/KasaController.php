<?php include "baglan.php";

$sorgu = $db->prepare("select * from tblkasa");
$sorgu->execute();

if (isset($_POST['kasaGuncelle'])) {

    $veriGuncelle = $db->prepare("update tblkasa set
        
        kasa_adi=:kasa_adi,
        kasa_durum=:kasa_durum         
        where kasa_id={$_POST['kasa_id']}
    ");

    $update = $veriGuncelle->execute(array(

        'kasa_adi' => $_POST['kasa_adi'],
        'kasa_durum' => $_POST['kasa_durum']
    ));

    if ($update)
        Header("Location:../kasalar.php?&durum=ok");
    else
        Header("Location:../kasalar.php?&durum=no");

}

if (isset($_POST['kasaEkle'])) {

    $kasa = $db->prepare("insert into tblkasa set 
                 
         kasa_adi=:kasa_adi,
         kasa_miktari=:kasa_miktari,
         kasa_durum=:kasa_durum
                
         ");

    $insert = $kasa->execute(array(

        'kasa_adi' => $_POST['kasa_adi'],
        'kasa_miktari' => 0,
        'kasa_durum' => $_POST['kasa_durum']

    ));

    if ($insert)
        Header("Location:../kasalar.php?&durum=ok");
    else
        Header("Location:../kasalar.php?&durum=no");
}
