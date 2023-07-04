<?php 

require_once("baglan.php");


if (isset($_POST)) {
   
    
    $blogid =  $_POST['value'];
    echo $blogid;
    $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM arkadas WHERE kullanici_id=:id AND eklenen_id=$blogid");
    $yorumlar->execute(["id" =>  $id]);
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
    echo $yorumlar->rowCount();

    if ($yorumlar->rowCount()) {
        $yorumlar = $VeriTabaniBaglantisi->prepare("DELETE  FROM arkadas WHERE kullanici_id=:id AND eklenen_id=$blogid");
        $yorumlar->execute(["id" =>  $id]);
        $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
        echo 'Arkadaş Silindi';
        
    } else {

        $sorgu = $VeriTabaniBaglantisi->prepare("INSERT INTO arkadas(kullanici_id, eklenen_id) VALUES(?, ?)");
        $sorgu->bindParam(1, $id, PDO::PARAM_STR);
        $sorgu->bindParam(2, $blogid, PDO::PARAM_STR);
     

        $sorgu->execute();
        echo 'Arkadaş Eklendi';
    }
}
