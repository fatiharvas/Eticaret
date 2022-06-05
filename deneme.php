<?php
include "admin/controller/baglan.php";

$urun = $db->prepare("select * from tblsepet where kullanici_id=5");
$urun->execute();

$dizi = array(array(
    0 => 1,
    1 => 2,
    3 => 4
));

echo count($dizi[0]);

