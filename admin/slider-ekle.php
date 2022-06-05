<?php include "index.php" ?>
<link rel="stylesheet" href="css/form.css">

<head>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>

<div class="container">
    <form id="contact" action="controller/SliderController.php" method="post" enctype="multipart/form-data">
        <h3>Slider Ekle </h3>

        <fieldset>
            <label for="ResimEkle">Resim Ekle</label>
            <input id="ResimEkle" name="sliderResimYol" required type="file" accept="image/png, image/gif, image/jpeg"  tabindex="1">
        </fieldset>

        <fieldset>
            <label for="SliderAdı">Slider Adı</label>
            <input id="SliderAdı" name="sliderAd" required type="text" tabindex="1">
        </fieldset>

        <fieldset>
            <label for="SliderDetay">Slider Detay</label>
            <textarea class="ckeditor" name="sliderDetay" id="SliderDetay" required ></textarea>
        </fieldset>


        <fieldset>
            <label for="SliderLink">Slider Url</label>
            <input id="SliderLink" name="sliderLink" required type="text" tabindex="1">
        </fieldset>


        <fieldset>
            <label for="SliderSira">Slider Sıra</label>
            <input id="SliderSira" type="number" name="sliderSira" min="1" required tabindex="1" >
        </fieldset>

        <fieldset>
            <label for="SliderDurum">Slider Durum</label>
            <select id="SliderDurum" class="form-control" name="sliderDurumu" required>

                <option value="1" >Aktif</option>
                <option value="0">Pasif</option>

            </select><br>
        </fieldset>

        <fieldset>
            <button name="sliderEkle" type="submit">Ekle</button>
        </fieldset>

    </form>
</div>


