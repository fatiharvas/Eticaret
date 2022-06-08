<?php
//TODO Sitedeki açıkları tespit et
try {

    $db = new PDO("mysql:host=localhost;dbname=eticaret;charset=utf8",'root','');

} catch (PDOExpception $error) {

    echo $error->getMessage();
}

