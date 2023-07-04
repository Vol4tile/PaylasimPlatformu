<?php
require_once("baglan.php");
if($_POST){
 


echo $_POST['blogid'];
$blogid=$_POST['blogid'];
$gelenyorumbaslik=$_POST['blogbaslik'];

$gelenblogyazi=$_POST['blogyazi'];
$gelenyorum=Filtre($_POST['yorum']);
echo ' ';
echo $blogid; echo ' ';
echo $gelenyorumbaslik; echo ' ';
echo ' ';
echo $gelenblogyazi;echo ' ';
echo $gelenyorum; 



    
$query  = $VeriTabaniBaglantisi -> prepare("SELECT * FROM members WHERE id = :id");
$query -> execute(['id' => $blogid]);
$row    = $query -> fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $item) {
  $blogid= $item['adisoyadi'];
}
   



$Yorumeklex = $VeriTabaniBaglantisi->prepare("INSERT INTO yorumlar (yorum_adisoyadi,yorum_icerik,yorum_blog_id,yorum_baslik) values(?,?,?,?)");
$Yorumeklex->execute([$blogid,$gelenyorum,$gelenyorumbaslik,$gelenblogyazi]);
$yorumkontrol = $Yorumeklex->rowCount();

if($yorumkontrol>0){
    echo'yorum tamam';
}
else{

    echo'hata oluştu';
}
}
