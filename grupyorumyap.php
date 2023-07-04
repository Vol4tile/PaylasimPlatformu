<?php
require_once("baglan.php");
if ($_POST) {

    print_r($_POST);
    $paylasim = $_POST['x'];
    $grup = $_POST['y'];
    $yorum = $_POST['value'];

    $Yorumeklex = $VeriTabaniBaglantisi->prepare("INSERT INTO grup_yorum (grup_id,paylasim_id,yorum_yapan_id,yorum) values(?,?,?,?)");
    $Yorumeklex->execute([$grup, $paylasim, $id, $yorum]);
    $yorumkontrol = $Yorumeklex->rowCount();

    if ($yorumkontrol > 0) {
        echo 'yorum tamam';
    } else {

        echo 'hata oluştu';
    }
}
