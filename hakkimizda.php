<?php include "header.php"; include "admin/controller/HakkimizdaController.php";

$hakkimizdasor=$db->prepare("SELECT * FROM tblhakkimizda where hakkimizdaId=:id");
$hakkimizdasor->execute(array(
    'id' => 1
));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


?>

<link rel="stylesheet" href="bootstrap/css/bootstrapcss.css">
<link rel="stylesheet" href="css/hakkimizda.css">

<div id="fh5co-about">
    <div class="container">
        <div class="about-content">
            <div class="row animate-box">
                <div class="col-md-12">
                    <div class="desc">
                        <h3><?php echo $hakkimizdacek['baslik']?></h3>
                        <p><?php echo $hakkimizdacek['icerik']?></p>
                    </div>
                    <div class="desc">
                        <h3>Misyon &amp; Vizyon</h3>
                        <p><?php echo $hakkimizdacek['misyon']?></p>
                        <p><?php echo $hakkimizdacek['vizyon']?></p>
                    </div>
                    <div class="desc">

                        <h3>Tanıtım</h3>
                        <iframe width="100%" height="600px" src="https://www.youtube.com/embed/<?php echo substr($hakkimizdacek['video'],32) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
