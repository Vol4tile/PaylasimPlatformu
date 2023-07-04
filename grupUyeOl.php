<?php 

require_once("baglan.php");


if (isset($_POST)) {
   
    
    $blogid =  $_POST['value'];
    echo $blogid;
    $y =$VeriTabaniBaglantisi->prepare("SELECT * FROM grup_uyelik WHERE grup_id=$blogid AND uye_id=$id ");
    $y->execute();
    $ekran = $y->fetchAll(PDO::FETCH_ASSOC);
    $x = $y->rowCount();
    if(!$x){
        $sorgu = $VeriTabaniBaglantisi->prepare("INSERT INTO grup_uyelik(uye_id, grup_id) VALUES($id, $blogid)");
     
        $sorgu->execute();
    }
    else{
       
       }
    
}
