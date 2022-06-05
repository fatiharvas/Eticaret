<?php include "baglan.php";

if (isset($_POST['stokEkle'])) {

    $veriEkle = $db ->prepare("Insert into tblstok set 
        urun_id=:urun_id,
        alis_fiyat=:alis_fiyat,
        stok=:stok      
    ");

    $insert = $veriEkle -> execute(array(

        'urun_id' => $_POST['urun_id'],
        'alis_fiyat' => $_POST['alis_fiyat'],
        'stok' => $_POST['stok']

    ));

    if ($insert)
        header("Location:../stok.php?urun_id={$_POST['urun_id']}");
    else
        header("Location:../stok.php?durum=no");
}

if (isset($_POST['stokGuncelle'])) {

    $veriKaydet = $db -> prepare("Update tblstok set
        alis_fiyat=:alis_fiyat,
        stok=:stok where urun_id={$_POST['urun_id']}               
    ");

    $update = $veriKaydet -> execute(array(
        'alis_fiyat'=>$_POST['alis_fiyat'],
        'stok'=>$_POST['stok']
    ));

    if ($update)
        header("Location:../stok.php?urun_id={$_POST['urun_id']}");
    else
        header("Location:../stok.php?durum=no");
}

