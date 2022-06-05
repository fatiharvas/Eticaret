<?php include "header.php"; include "admin/controller/HakkimizdaController.php";

$hakkimizdasor=$db->prepare("SELECT * FROM tblhakkimizda where hakkimizdaId=:id");
$hakkimizdasor->execute(array(
    'id' => 0
));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-title-wrap">
                <div class="page-title-inner">
                    <div class="row">


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">

            <div class="title-bg">
                <div class="title"><?php echo $hakkimizdacek['baslik']; ?></div>
            </div>
            <div class="page-content">
                <p>
                    <?php echo $hakkimizdacek['icerik']; ?>
                </p>

            </div>

            <div class="title-bg">
                <div class="title">Misyon</div>
            </div>

            <blockquote><?php echo $hakkimizdacek['misyon']; ?></blockquote>

            <div class="title-bg">
                <div class="title"><h2>Vizyon</h2></div>
            </div>
            <blockquote><?php echo $hakkimizdacek['vizyon']; ?></blockquote>

            <div class="title-bg">
                <div class="title">Tanıtım Videosu</div>
            </div>

            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $hakkimizdacek['video'] ?>" frameborder="0" allowfullscreen></iframe>

        </div>
    </div>
    <div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>
