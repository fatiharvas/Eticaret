<?php include "baglan.php";

if ($_GET['sepetsil'] == 'ok') {

    $sorgu = $db->prepare("delete from tblsepet where sepet_id = {$_GET['sepet_id']}");
    $delete = $sorgu->execute();

    if ($delete)
        Header("Location:../../sepet.php?&durum=ok");
    else
        Header("Location:../../sepet.php&durum=no");

}

if (isset($_POST['sepetEkle'])) {

    $sorgu = $db->prepare("select * from tblstok,tblsepet,tblurunler where tblstok.urun_id={$_POST['urun_id']} and tblsepet.urun_id = {$_POST['urun_id']} and tblurunler.urun_id = {$_POST['urun_id']}");
    $sorgu->execute();
    $sepetCek = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($sorgu-> rowCount() > 0) {

        $adet_sayisi = $sepetCek['urun_adet']+=$_POST['urun_adet'];
        $adetGuncelle = $db->prepare("update tblsepet set urun_adet = {$adet_sayisi} where urun_id={$sepetCek['urun_id']}");
        $update = $adetGuncelle->execute();

        $toplam_fiyat = $adet_sayisi * $sepetCek['satis_fiyat'];

        $fiyat = $db->prepare("update tblsepet set toplam_fiyat = {$toplam_fiyat} where urun_id={$sepetCek['urun_id']}");
        $fiyat->execute();

        if ($update)
            Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}&durum=ok");
        else
            Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}&durum=no");

    }else {

        $sorgu = $db->prepare("select * from tblurunler,tblstok where tblurunler.urun_id = tblstok.urun_id and tblurunler.urun_id = {$_POST['urun_id']}");
        $sorgu->execute();
        $urunCek = $sorgu->fetch(PDO::FETCH_ASSOC);

        $toplam_fiyat = $_POST['urun_adet'] * $urunCek['satis_fiyat'];

        $sorgu = $db->prepare("Insert into tblsepet set
             urun_id=:urun_id,
             kullanici_id=:kullanici_id,
             urun_adet=:urun_adet,
             toplam_fiyat=:toplam_fiyat
         ");
        $insert = $sorgu ->execute(array(
            'urun_id' => $_POST['urun_id'],
            'kullanici_id' => $_POST['kullanici_id'],
            'urun_adet' => $_POST['urun_adet'],
            'toplam_fiyat' => $toplam_fiyat

        ));

        if ($insert)
            Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}&durum=ok");
        else
            Header("Location:../../urun-detay.php?urun_id={$_POST['urun_id']}&durum=no");

    }
}



