<?php include "baglan.php"; ob_start(); session_start(); include "Fonksiyonlar.php";

if (isset($_POST['siparis_iptal'])) {
    islemKontrol();
}

if ($_GET['siparisiptal'] == "ok") {

    $siparisDurum = $db->prepare("update tblsiparis set siparis_durum=null where siparis_id={$_GET['siparis_id']}");
    $siparisDurum->execute();

    $stokKontrol = $db->prepare("select * from tblsiparisdetay,tblurunler,tblstok where tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunler.urun_id = tblstok.urun_id and tblsiparisdetay.siparis_id = {$_GET['siparis_id']}");
    $stokKontrol->execute();

    while ($stokGuncelle = $stokKontrol->fetch(PDO::FETCH_ASSOC)) {
        $stok = $stokGuncelle['stok'] += $stokGuncelle['urun_adet'];
        $guncelle = $db->prepare("update tblstok set stok = {$stok} where urun_id = {$stokGuncelle['urun_id']}");
        $guncelle->execute();
    }

    if ($stokKontrol)
        Header("Location:../siparis.php");
    else
        Header("Location:../siparis.php?durum=no");


}

if ($_GET['siparissil'] == "ok") {

    $siparisDurum = $db->prepare("update tblsiparis set siparis_durum=null where siparis_id={$_GET['siparis_id']}");
    $siparisDurum->execute();

    $stokKontrol = $db->prepare("select * from tblsiparisdetay,tblurunler,tblstok where tblsiparisdetay.urun_id = tblurunler.urun_id and tblurunler.urun_id = tblstok.urun_id and tblsiparisdetay.siparis_id = {$_GET['siparis_id']}");
    $stokKontrol->execute();

    while ($stokGuncelle = $stokKontrol->fetch(PDO::FETCH_ASSOC)) {
        $stok = $stokGuncelle['stok'] += $stokGuncelle['urun_adet'];
        $guncelle = $db->prepare("update tblstok set stok = {$stok} where urun_id = {$stokGuncelle['urun_id']}");
        $guncelle->execute();
    }

    if ($stokKontrol)
        Header("Location:../../siparis.php");
    else
        Header("Location:../../siparis.php?durum=no");


}

if (isset($_POST['onayla'])) {

    $sorgu = $db->prepare("select * from tblkasa,tblsiparis where tblkasa.kasa_id = {$_POST['kasa_id']} and tblsiparis.siparis_id = {$_POST['siparis_id']}");
    $sorgu->execute();
    $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

    $kasa_miktari = $veriCek['kasa_miktari'] + $veriCek['siparis_toplam'];
    $kasa = $db->prepare("update tblkasa set kasa_miktari = {$kasa_miktari} where kasa_id={$_POST['kasa_id']}");
    $insert = $kasa->execute();

    $durum = $db->prepare("update tblsiparis set siparis_durum=1 where siparis_id = {$_POST['siparis_id']}");
    $siparisDurum = $durum->execute();

    if ($insert and $siparisDurum)
        Header("Location:../siparis.php");

}

if (isset($_POST['adresGuncelle'])) {

    $adresId = $_POST['adres_id'];

    $sorgu = $db->prepare("Update tbladres set
            ad=:ad,
            soyad=:soyad,
            il=:il,
            ilce=:ilce,
            adres=:adres,
            telefon=:telefon
            where adres_id={$adresId}
            ");

    $update = $sorgu->execute(array(

        'ad' => $_POST['ad'],
        'soyad' => $_POST['soyad'],
        'il' => $_POST['il'],
        'ilce' => $_POST['ilce'],
        'adres' => $_POST['adres'],
        'telefon' => $_POST['telefon']

    ));

    if ($update)
        Header("Location:../../teslimat.php?durum=ok");
    else
        Header("Location:../../teslimat.php?durum=no");


}

if ($_GET['adressil'] == 'ok') {

    $sorgu = $db->prepare("delete from tbladres where adres_id={$_GET['adres_id']}");
    $delete = $sorgu->execute();

    if ($delete)
        Header("Location:../../teslimat.php?durum=ok");
    else
        Header("Location:../../teslimat.php?durum=no");

}

if (isset($_POST['odeme'])) {

    if (stokKontrol($db,$_POST['kullanici_id'])) {

        Header("Location:../../sepet.php?durum=yok");

    }else {

        $adres_id = 0;

        if ($_POST['adres_id']) {
            $adres_id = $_POST['adres_id'];
        }else {
            $kaydet = 0;

            if ($_POST['kaydet'])
                $kaydet = 1;

            $adresEkle = $db->prepare("insert into tbladres set 
                 kullanici_id=:kullanici_id,
                 ad=:ad,
                 soyad=:soyad,
                 il=:il,
                 ilce=:ilce,
                 adres=:adres,
                 telefon=:telefon,
                 kaydet=:kaydet    
                 ");

            $adres = $adresEkle->execute(array(

                'kullanici_id' => $_POST['kullanici_id'],
                'ad' => $_POST['ad'],
                'soyad' => $_POST['soyad'],
                'il' => $_POST['il'],
                'ilce' => $_POST['ilce'],
                'adres' => $_POST['adres'],
                'telefon' => $_POST['telefon'],
                'kaydet' => $kaydet

            ));

            $veri = $db->prepare("select * from tbladres where kullanici_id = {$_POST['kullanici_id']} order by adres_id desc limit 1");
            $veri->execute();
            $veriCek = $veri->fetch(PDO::FETCH_ASSOC);

            $adres_id = $veriCek['adres_id'];
        }

        $sepet = $db->prepare("select * from tblsepet,tblurunler,tblstok where tblsepet.urun_id = tblurunler.urun_id and tblurunler.urun_id = tblstok.urun_id and tblsepet.kullanici_id={$_POST['kullanici_id']}");
        $sepet->execute();
        $siparisToplam = 0;

        while ($sepetCek = $sepet->fetch(PDO::FETCH_ASSOC)){

            $siparisToplam += $sepetCek['toplam_fiyat'];
        }

        $siparis = $db->prepare("insert into tblsiparis set 
            
        kullanici_id=:kullanici_id,
        adres_id=:adres_id,
        siparis_toplam=:siparis_toplam,
        siparis_durum=:siparis_durum,
        kart_numarasi=:kart_numarasi,
        son_kullanma_tarihi=:son_kullanma_tarihi,
        cvv=:cvv
    
        ");

        $siparisEkle = $siparis->execute(array(

            'kullanici_id' => $_POST['kullanici_id'],
            'adres_id' => $adres_id,
            'siparis_toplam' => $siparisToplam,
            'siparis_durum' => 0,
            'kart_numarasi' => $_POST['kart_numarasi'],
            'son_kullanma_tarihi' => $_POST['son_kullanma_tarihi'],
            'cvv' => $_POST['cvv']

        ));

        if ($siparisEkle) {

            $siparis_id = $db->lastInsertId();

            $urun = $db->prepare("select * from tblsepet, tblurunler where kullanici_id = {$_POST['kullanici_id']} and tblsepet.urun_id = tblurunler.urun_id");
            $urun->execute();

            while ($urunler = $urun->fetch(PDO::FETCH_ASSOC)) {

                $siparis = $db->prepare("insert into tblsiparisdetay set

                siparis_id=:siparis_id,
                urun_id=:urun_id,
                urun_fiyat=:urun_fiyat,
                urun_adet=:urun_adet
                ");

                $siparisEkle = $siparis->execute(array(

                    'siparis_id' => $siparis_id,
                    'urun_id' => $urunler['urun_id'],
                    'urun_fiyat' => $urunler['satis_fiyat'],
                    'urun_adet' => $urunler['urun_adet']

                ));

                $stok = $db->prepare("select * from tblstok where urun_id = {$urunler['urun_id']}");
                $stok->execute();
                $stokCek = $stok->fetch(PDO::FETCH_ASSOC);

                $stokSayisi = $stokCek['stok'] -= $urunler['urun_adet'];

                $stokGuncelle = $db->prepare("update tblstok set stok = {$stokSayisi} where urun_id = {$urunler['urun_id']}");
                $stokGuncelle->execute();
            }

            if ($siparisEkle) {

                $sil = $db->prepare("delete from tblsepet where kullanici_id={$_POST['kullanici_id']}");
                $kontrol = $sil->execute();

                if ($kontrol){
                    Header("Location:../../siparis.php");
                }
            }

        }
    }


}
function stokKontrol($db,$id) {

    $sepet = $db->prepare("select * from tblsepet,tblurunler,tblstok where tblsepet.urun_id = tblurunler.urun_id and tblurunler.urun_id = tblstok.urun_id and tblsepet.kullanici_id={$id}");
    $sepet->execute();

    $flag = 0;
    while ($sepetCek = $sepet->fetch(PDO::FETCH_ASSOC)){
        if ($sepetCek['urun_adet'] > $sepetCek['stok']) {
            $sil = $db->prepare("delete from tblsepet where urun_id={$sepetCek['urun_id']}");
            $sil->execute();

            $flag = 1;
        }
    }
    if ($flag)
        return 1;
    else
        return 0;

}

