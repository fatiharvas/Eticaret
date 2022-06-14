<?php include "header.php"; include "admin/controller/Fonksiyonlar.php";

$sorgu = $db -> prepare("select * from tblurunler,tblkategori,tblstok where tblurunler.urun_id = {$_GET['urun_id']} and tblstok.urun_id=tblurunler.urun_id and tblkategori.kategori_id=tblurunler.kategori_id");
$sorgu->execute();
$urunCek = $sorgu->fetch(PDO::FETCH_ASSOC);


if ($_SESSION['user_mail']) {
    $kullanici = $db->prepare("select * from tblkullanicilar where kullanici_mail='{$_SESSION['user_mail']}'");
    $kullanici->execute();
    $kullaniciVeri = $kullanici->fetch(PDO::FETCH_ASSOC);
}

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ürün Detay</title>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>

<body>

<div style="padding: 50px" class="product_image_area section_padding">
    <div class="container">
        <div class="row s_product_inner justify-content-between">
            <div style="width: 780px" >
                <div class="product_slider_img" style="margin-right: 50px">
                    <div id="vertical">

                    <?php
                    $resim = $db-> prepare("select * from tblurunfoto where urun_id={$_GET['urun_id']} order by sira asc limit 4");
                    $resim->execute();
                    while ($resimCek = $resim->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div data-thumb="<?php echo $resimCek['resim_yol']?>">
                                <img src="<?php echo $resimCek['resim_yol']?>" />
                            </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="s_product_text">
                    <h3><?php echo $urunCek['urun_ad']?></h3>
                    <h2><?php echo $urunCek['satis_fiyat']."₺"?></h2>
                    <?php
                    error_reporting(0);
                    if ($_GET['durum']=="ok") {?>
                        <b style="color:green;">Ürün Sepete Eklendi</b>

                    <?php } elseif ($_GET['durum']=="no") {?>

                        <b style="color:red;">İşlem Başarısız...</b>

                    <?php }elseif ($_GET['stok'] == 'no') {?>
                        <b style="color:red;">Yeterli Stok Yok!</b>
                    <?php } ?>
                    <ul class="list">
                        <li>
                            <a class="active" href="kategoriler.php?kategori_id=<?php echo $urunCek['kategori_id']?>">
                                <span>Kategorisi</span> : <?php echo $urunCek['kategori_ad']?>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span>Stok Durumu</span> :
                                <?php
                                    if ($urunCek['stok'] > 0) {?>
                                    Stokta
                                <?php } else { ?>
                                    Stokta Değil
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                    <p>
                        <?php echo $urunCek['urun_tanitim']?>
                    </p>

                    <?php

                        if ($urunCek['stok'] > 0 and $_SESSION['user_mail']) {?>

                            <form action="admin/controller/SepetController.php" method="post">
                                <div class="card_area d-flex justify-content-between align-items-center">
                                    <div class="product_count">
                                        <input type="hidden" name="urun_id" value="<?php echo $urunCek['urun_id']?>">
                                        <input type="hidden" name="kullanici_id" value="<?php echo $kullaniciVeri['kullanici_id']?>">
                                        <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                        <input class="input-number" name="urun_adet" type="text" value="1" min="1" max="10">
                                        <span class="number-increment"> <i class="ti-plus"></i></span>
                                    </div>
                                    <button type="submit" name="sepetEkle" class="btn_3">Sepete ekle</button>
                                </div>
                            </form>

                        <?php }else if ($urunCek['stok'] <= 0) {?>

                            <div class="card_area d-flex justify-content-between align-items-center">
                                <a style="width: 100%; text-align: center;" href="#" class="btn_3">Ürün Mevcut Değil</a>
                            </div>

                        <?php } if (!$_SESSION['user_mail']) {?>

                                <div class="card_area d-flex justify-content-between align-items-center">
                                    <a style="width: 100%; text-align: center;" href="#" class="btn_3">Sepete Ürün Eklemek İçin Giriş Yapılmalıdır!</a>
                                </div>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                   aria-selected="true">Açıklama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                   aria-selected="false">Yorumlar</a>
            </li>

            <?php

            if ($urunCek['urun_video'] != null) {?>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#video" role="tab" aria-controls="contact"
                       aria-selected="false">Ürün Video</a>
                </li>
            <?php } ?>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p><?php echo $urunCek['urun_detay']?></p>
            </div>

            <?php

                if ($urunCek['urun_video'] != null) { ?>
                    <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <iframe width="100%" height="600px" src="https://www.youtube.com/embed/<?php echo substr($urunCek['urun_video'],32) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php } ?>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">

                            <?php

                                $yorum = $db->prepare("select * from tblyorumlar,tblurunler,tblkullanicilar where tblkullanicilar.kullanici_id = tblyorumlar.kullanici_id and tblurunler.urun_id = tblyorumlar.urun_id and tblyorumlar.urun_id={$_GET['urun_id']} limit 4");
                                $yorum->execute();
                                $sayi = $yorum->rowCount();

                                if ($yorum->rowCount() > 0 ) {

                                    while ($yorumCek = $yorum->fetch(PDO::FETCH_ASSOC)) {?>

                                            <div class="review_item">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4><?php echo hideInformation($yorumCek['kullanici_ad']." ".$yorumCek['kullanici_soyad'],2,8) ;?></h4>
                                                        <h5><?php echo $yorumCek['yorum_zaman'] ?></h5>
                                                        <?php

                                                        if ($yorumCek['kullanici_id'] == $kullaniciVeri['kullanici_id']) { ?>
                                                            <a class="reply_btn" href="admin/controller/YorumlarController.php?yorum_id=<?php echo $yorumCek['yorum_id']?>&urun_id=<?php echo $urunCek['urun_id']?>&yorumsil=ok">Yorumu Sil</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <p class="text-black-50">
                                                    <?php echo $yorumCek['yorum']?>
                                                </p>
                                            </div>

                                        <?php } ?>

                                <?php }else { ?>

                                        <h3>Bu ürün için yorum bulunmamaktadır!</h3>

                                    <?php }?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Yorum Yap</h4>
                            <form class="row contact_form" action="admin/controller/YorumlarController.php" method="post" id="contactForm" novalidate="novalidate">
                                <?php if ($_SESSION['user_mail']) {

                                        $yorumSiniri = $db->prepare("select * from tblyorumlar,tblkullanicilar,tblurunler where tblurunler.urun_id = tblyorumlar.urun_id and tblkullanicilar.kullanici_mail='{$_SESSION['user_mail']}' and tblurunler.urun_id = {$urunCek['urun_id']} and tblkullanicilar.kullanici_id = tblyorumlar.kullanici_id ");
                                        $yorumSiniri->execute();
                                        $yorum_siniri = $yorumSiniri->fetch(PDO::FETCH_ASSOC);

                                        if ($yorum_siniri['yorum_siniri'] == 0) { ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="ckeditor" name="yorum" id="message" maxlength="250" placeholder="Yorumunuz"></textarea>
                                                </div>
                                                <input type="hidden" name="kullanici_id" value="<?php echo $kullaniciVeri['kullanici_id']?>">
                                                <input type="hidden" name="urun_id" value="<?php echo $urunCek['urun_id']?>">
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button type="submit" name="yorumEkle" class="btn_3">
                                                    Gönder
                                                </button>
                                            </div>
                                        <?php }else { ?>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" id="message" cols="50" rows="4" placeholder="Yorumunuz">Bir ürün için sadece 1 adet yorum yapılabilir!</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12 text-right">
                                                <button type="button" value="submit" class="btn_3">
                                                    Gönder
                                                </button>
                                            </div>


                                        <?php } ?>


                                    <?php } else { ?>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="message" id="message" cols="50" rows="4" placeholder="Yorumunuz">Yorum yapabilmek için giriş yapılmalıdır!</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-right">
                                            <button type="button" value="submit" class="btn_3">
                                                Gönder
                                            </button>
                                        </div>

                                    <?php } ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>
</section>


<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/lightslider.min.js"></script>
<script src="js/masonry.pkgd.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/swiper.jquery.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/stellar.js"></script>
<script src="js/theme.js"></script>
<script src="js/custom.js"></script>
</body>

</html>

<?php include "footer.php"?>