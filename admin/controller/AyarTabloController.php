<?php include "baglan.php";
$ayarSorgu = $db->prepare("SELECT * FROM tblayarlar where ayarId=:id");
$ayarSorgu->execute(array('id' => 1));
$ayarcek = $ayarSorgu->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['genelAyarGuncelle'])) {

    $ayarKaydet = $db -> prepare("UPDATE tblayarlar SET
        ayarLogo=:ayarLogo,
        ayarTitle=:ayarTitle,
        ayarDescription=:ayarDescription,
        ayarKeywords=:ayarKeywords,
        ayarAuthor=:ayarAuthor
        WHERE ayarId = 1 ");

    $update = $ayarKaydet -> execute(array(
       'ayarLogo' => $_POST['ayarLogo'],
       'ayarTitle' => $_POST['ayarTitle'],
       'ayarDescription' => $_POST['ayarDescription'],
       'ayarKeywords' => $_POST['ayarKeywords'],
       'ayarAuthor' => $_POST['ayarAuthor']
    ));

    if ($update) {
        header("Location:../genel-ayar.php?durum=ok");
    }else {
        header("Location:../genel-ayar.php?durum=no");
    }

}

if (isset($_POST['iletisimAyarGuncelle'])) {

    $ayarKaydet = $db -> prepare("UPDATE tblayarlar SET
        ayarTelefon=:ayarTelefon,
        ayarFaks=:ayarFaks,
        ayarMail=:ayarMail,
        ayarIl=:ayarIl,
        ayarIlce=:ayarIlce,
        ayarAdres=:ayarAdres,
        ayarCagriMerkezi=:ayarCagriMerkezi,
        ayarMesai=:ayarMesai
        WHERE ayarId = 1 ");

    $update = $ayarKaydet -> execute(array(
        'ayarTelefon' => $_POST['ayarTelefon'],
        'ayarFaks' => $_POST['ayarFaks'],
        'ayarMail' => $_POST['ayarMail'],
        'ayarIl' => $_POST['ayarIl'],
        'ayarIlce' => $_POST['ayarIlce'],
        'ayarAdres' => $_POST['ayarAdres'],
        'ayarCagriMerkezi' => $_POST['ayarCagriMerkezi'],
        'ayarMesai' => $_POST['ayarMesai']));

    if ($update) {
        header("Location:../iletisim-ayar.php?durum=ok");
    }else {
        header("Location:../iletisim-ayar.php?durum=no");
    }
}

if (isset($_POST['sosyalMedyaAyarGuncelle'])) {

    $ayarKaydet = $db -> prepare("UPDATE tblayarlar SET
        ayarFacebook=:ayarFacebook,
        ayarInstagram=:ayarInstagram,
        ayarTwitter=:ayarTwitter,
        ayarYoutube=:ayarYoutube
        WHERE ayarId = 1 ");

    $update = $ayarKaydet -> execute(array(
        'ayarFacebook' => $_POST['ayarFacebook'],
        'ayarInstagram' => $_POST['ayarInstagram'],
        'ayarTwitter' => $_POST['ayarTwitter'],
        'ayarYoutube' => $_POST['ayarYoutube']));

    if ($update) {
        header("Location:../sosyal-medya-ayar.php?durum=ok");
    }else {
        header("Location:../sosyal-medya-ayar.php?durum=no");
    }
}

if (isset($_POST['mailAyarGuncelle'])) {

    if ($_POST['parola1'] != "" or $_POST['parola2'] != "" or $_POST['parola3'] != "") {

        if (password_verify($_POST['parola1'], $ayarcek['ayarParola'])){

            if ($_POST['parola2'] == $_POST['parola3']) {

                if (trim(strlen($_POST['parola2'])) > 5) {

                    $parola = password_hash($_POST['parola2'],PASSWORD_DEFAULT);

                    $ayarKaydet = $db -> prepare("UPDATE tblayarlar SET
                         ayarMail=:ayarMail,
                         ayarParola=:ayarParola
                         WHERE ayarId = 1 ");

                    $update = $ayarKaydet -> execute(array(
                        'ayarMail' => $_POST['ayarMail'],
                        'ayarParola' => $parola
                    ));

                    if ($update) {
                        header("Location:../mail-ayar.php?durum=ok");
                    }else {
                        header("Location:../mail-ayar.php?durum=no");
                    }

                }else {
                    header("Location:../mail-ayar.php?durum=kisa");
                }
            }else {
                header("Location:../mail-ayar.php?durum=uyusmuyor");
            }

        }else {
            header("Location:../mail-ayar.php?durum=sifreyanlis");
        }

    }else {

        $ayarKaydet = $db -> prepare("UPDATE tblayarlar SET
            ayarMail=:ayarMail
            WHERE ayarId = 1 ");

        $update = $ayarKaydet -> execute(array(
            'ayarMail' => $_POST['ayarMail']
        ));

        if ($update) {
            header("Location:../mail-ayar.php?durum=ok");
        }else {
            header("Location:../mail-ayar.php?durum=no");
        }
    }


}




