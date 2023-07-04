<?php

require_once("baglan.php");


if (isset($_POST)) {


    $blogid =  $_POST['blogid'];

    $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM begen WHERE begenen_id=:id AND begenilen_paylasim_id=$blogid");
    $yorumlar->execute(["id" =>  $id]);
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);


    if ($yorumlar->rowCount()) {
        $yorumlar = $VeriTabaniBaglantisi->prepare("DELETE  FROM begen WHERE begenen_id=:id AND begenilen_paylasim_id=$blogid");
        $yorumlar->execute(["id" =>  $id]);
        $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);

        header("Location:index.php");
    } else {

        $sonuc = $VeriTabaniBaglantisi->exec("INSERT INTO begen SET durum=1,begenilen_paylasim_id=$blogid,begenen_id=$id");

        header("Location:index.php");
    }
}
