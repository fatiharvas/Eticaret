<?php include "index.php"; include "controller/SliderController.php";

$sliderSorgu = $db -> prepare("SELECT * FROM tblslider where sliderId={$_GET['sliderId']}");
$sliderSorgu -> execute();
$sliderCek = $sliderSorgu ->fetch(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="css/form.css">

<head>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>

<div class="container">
    <form id="contact" method="post" action="controller/SliderController.php" enctype="multipart/form-data">
        <h3>Slider Güncelle </h3>

        <fieldset>
            <label for="SeriNo">Seri No</label>
            <input id="SeriNo" name="sliderId" type="text" readonly tabindex="1" value="<?php echo $sliderCek['sliderId'];?>">
        </fieldset>

        <fieldset>
            <label for="ResimEkle">Resim Ekle</label>
            <input id="ResimEkle" name="sliderResimYol"  type="file" accept="image/png, image/gif, image/jpeg"  tabindex="1">
        </fieldset>


        <fieldset>
            <label for="SliderAdı">Slider Adı</label>
            <input id="SliderAdı" name="sliderAd" value="<?php echo $sliderCek['sliderAd']?>" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="SliderDetay">Slider Detay</label>
            <textarea class="ckeditor" name="sliderDetay" id="SliderDetay"  required ><?php echo $sliderCek['sliderDetay']?></textarea>
        </fieldset>

        <fieldset>
            <label for="SliderLink">Slider Url</label>
            <input id="SliderLink" name="sliderLink" value="<?php echo $sliderCek['sliderLink']?>" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="SliderSira">Slider Sira</label>
            <input id="SliderSira" type="number" name="sliderSira" min="1" value="<?php echo $sliderCek['sliderSira']?>" required tabindex="1" >
        </fieldset>

        <fieldset>
            <button name="sliderGuncelle" type="submit">Güncelle</button>
        </fieldset>

    </form>
</div>


