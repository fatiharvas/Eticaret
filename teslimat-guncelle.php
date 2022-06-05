<?php include "admin/controller/baglan.php";

$sorgu = $db->prepare("select * from tbladres,tblkullanicilar where tbladres.kullanici_id = tblkullanicilar.kullanici_id and adres_id = {$_GET['adres_id']}");
$sorgu->execute();
$veriCek = $sorgu->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/teslimat.css">

    <title>Adres Bilgilerini Güncelle</title>
</head>
<body>


<div class="content">

    <div class="container">
        <div class="row align-items-stretch no-gutters contact-wrap">
            <div class="col-md-12">
                <div class="form h-100">
                    <h3 style="text-align: center">Adres Bilgileri</h3>
                    <form class="mb-5" method="post" id="contactForm" name="contactForm" action="admin/controller/OdemeController.php">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="ad" class="col-form-label">Ad</label>
                                <input type="text" class="form-control" name="ad" value="<?php echo $veriCek['ad']?>" id="ad" placeholder="Adınız" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="soyad" class="col-form-label">Soyad</label>
                                <input type="text" class="form-control" name="soyad" id="soyad" value="<?php echo $veriCek['soyad']?>" placeholder="Soyadınız" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="telefon">Telefon</label>
                                <input type="text" class="form-control" name="telefon" value="<?php echo $veriCek['telefon']?>" placeholder="Telefon" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="il" class="col-form-label">İl</label>
                                <select name="il" id="il" class="form-control" required>
                                    <option value="">Seçin...</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="ilce" class="col-form-label">İlçe</label>
                                <select name="ilce" id="ilce" class="form-control" disabled="disabled" required >
                                    <option value="">Seçin...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="message" class="col-form-label">Adres</label>
                                <textarea class="form-control" name="adres" id="message" cols="30" rows="4"  placeholder="Adres" required><?php echo $veriCek['adres']?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="hidden" name="adres_id" value="<?php echo $veriCek['adres_id']?>">
                                <button type="submit" name="adresGuncelle" class="btn btn-primary rounded-0 py-2 px-4">Güncelle</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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