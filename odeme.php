<?php
include "admin/controller/baglan.php";
ob_start();session_start();

$kullanici_id = $db->prepare("select * from tblkullanicilar where kullanici_mail='{$_SESSION['user_mail']}'");
$kullanici_id->execute();
$veri = $kullanici_id->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/odeme.css">

</head>
<body>

<div class="container">
    <div class="card">
        <form class="form" action="admin/controller/OdemeController.php" method="post">

            <?php
            if (isset($_GET['adres_id'])) {
                $sorgu = $db->prepare("select * from tbladres where adres_id = {$_GET['adres_id']}");
                $sorgu->execute();
                $veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);
                ?>

                <div class="left-side">
                    <div class="left-heading">
                        <h3>Ödeme Sayfası</h3>
                    </div>
                    <div class="steps-content">
                        <h3>Adım <span class="step-number">1</span></h3>
                    </div>
                    <ul class="progress-bar">
                        <li class="active">Adres Bilgileri</li>
                        <li>Kart Bilgileri</li>
                    </ul>

                </div>
                <div class="right-side">
                    <div class="main active">
                        <div class="text">
                            <h2>Adres Bilgileri</h2>
                        </div>
                        <div class="input-text">
                            <div class="input-div">

                                <input type="hidden" name="adres_id" value="<?php echo $veriCek['adres_id']?>">
                                <input type="hidden" name="kullanici_id" value="<?php echo $veri['kullanici_id']?>">
                                <input type="text" name="ad" value="<?php echo $veriCek['ad']?>" readonly  id="user_name">
                            </div>
                            <div class="input-div">
                                <input type="text" name="soyad" value="<?php echo $veriCek['soyad']?>" readonly>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="telefon" readonly value="<?php echo $veriCek['telefon']?>" >
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="il" readonly value="<?php echo $veriCek['il']?>" >

                            </div>
                            <div class="input-div">
                                <input type="text" name="ilce" readonly value="<?php echo $veriCek['ilce']?>" >
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="adres" readonly value="<?php echo $veriCek['adres']?>">
                            </div>
                        </div>

                        <div class="buttons">
                            <button class="next_button">Sonraki Adım</button>
                        </div>
                    </div>
                    <div class="main">
                        <div class="text">
                            <h2>Kart Bilgileri</h2>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="kart_numarasi" maxlength="16" minlength="16" required require>
                                <span>Kart Numarası</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input required type="date" name="son_kullanma_tarihi"
                                       placeholder="dd-mm-yyyy"
                                       min="1997-01-01" max="2030-12-31">
                            </div>
                        </div>

                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" maxlength="3" minlength="3" name="cvv" required require>
                                <span>CVV</span>
                            </div>
                        </div>

                        <div class="buttons button_space">
                            <button class="back_button">Geri Dön</button>
                            <button type="submit" name="odeme" class="submit_btn">Onayla</button>
                        </div>
                    </div>

            <?php } else { ?>


                <div class="left-side">
                    <div class="left-heading">
                        <h3>Ödeme Sayfası</h3>
                    </div>
                    <div class="steps-content">
                        <h3>Adım <span class="step-number">1</span></h3>
                    </div>
                    <ul class="progress-bar">
                        <li class="active">Adres Bilgileri</li>
                        <li>Kart Bilgileri</li>
                    </ul>

                </div>
                <div class="right-side">
                    <div class="main active">
                        <div class="text">
                            <h2>Adres Bilgileri</h2>
                        </div>
                        <div class="input-text">
                            <div class="input-div">

                                <input type="hidden" name="kullanici_id" value="<?php echo $veri['kullanici_id']?>">
                                <input type="text" name="ad" maxlength="50" required require id="user_name">
                                <span>Ad</span>
                            </div>
                            <div class="input-div">
                                <input type="text" name="soyad" maxlength="50" required require>
                                <span>Soyad</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="telefon" maxlength="11" minlength="11" required require>
                                <span>Telefon Numarası</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <select name="il" id="il" class="form-control" required require>
                                    <option value="">Seçin...</option>
                                </select>
                            </div>
                            <div class="input-div">
                                <select name="ilce" id="ilce" class="form-control" disabled="disabled" required require>
                                    <option value="">Seçin...</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" maxlength="100" name="adres" required require>
                                <span>Adres</span>
                            </div>
                        </div>
                        <div class="input-div" style="margin-bottom: 15px">
                            <input name="kaydet" type="checkbox">Adres Kayıt Edilsin mi?
                        </div>
                        <div class="buttons">
                            <button class="next_button">Sonraki Adım</button>
                        </div>
                    </div>
                    <div class="main">
                        <div class="text">
                            <h2>Kart Bilgileri</h2>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" maxlength="16" minlength="16" name="kart_numarasi" required require>
                                <span>Kart Numarası</span>
                            </div>
                        </div>
                        <div class="input-text">
                            <div class="input-div">
                                <input type="date" name="son_kullanma_tarihi"
                                       placeholder="dd-mm-yyyy" required
                                       min="1997-01-01" max="2030-12-31">
                            </div>
                        </div>

                        <div class="input-text">
                            <div class="input-div">
                                <input type="text" name="cvv" maxlength="3" minlength="3" required require>
                                <span>CVV</span>
                            </div>
                        </div>

                        <div class="buttons button_space">
                            <button class="back_button">Geri Dön</button>
                            <button type="submit" name="odeme" class="submit_btn">Onayla</button>
                        </div>
                    </div>

                <?php } ?>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/odeme.js"></script>
<script>
    $.getJSON("admin/text/il-bolge.json", function(sonuc){
        $.each(sonuc, function(index, value){
            var row="";
            row +='<option value="'+value.il+'">'+value.il+'</option>';
            $("#il").append(row);
        })
    });
    $("#il").on("change", function(){
        var il=$(this).val();
        $("#ilce").attr("disabled", false).html("<option value=''>Seçin..</option>");
        $.getJSON("admin/text/il-ilce.json", function(sonuc){
            $.each(sonuc, function(index, value){
                var row="";
                if(value.il==il)
                {
                    row +='<option value="'+value.ilce+'">'+value.ilce+'</option>';
                    $("#ilce").append(row);
                }
            });
        });
    });
</script>

</body>
</html>
