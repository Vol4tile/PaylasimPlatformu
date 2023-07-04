<?php
require_once("baglan.php");

$kaynak = $_FILES["file"]["tmp_name"];

$ad =  $_FILES["file"]["name"];

$tip = $_FILES["file"]["type"];

$boyut = $_FILES["file"]["size"];

$hedef = "Resimler";


$ad = rand(1000, 5000) . rand(1000, 5000) . $ad;
$kaydet = move_uploaded_file($kaynak, $hedef . "/" . $ad);
$avatar = $hedef . "/" . $ad;
if ($kaydet) {

  $guncelle = $VeriTabaniBaglantisi->prepare("UPDATE members SET avatar=:avatar  WHERE id=$id ");
  $guncelle->execute(array(":avatar" => $avatar));
  echo ' <div style="color:green; position:absolute; text-align:center; width:300px; margin-left:800px;">Profil resmi başarıyla değiştirildi, iki saniye içinde anasayfaya yönlendirileceksiniz.</div>';
  echo '<meta http-equiv="refresh" content="2;URL=main.php">';
} else {
  echo 'Bir Hata Oluştu';
  echo '<meta http-equiv="refresh" content="1;URL=main.php">';
}
?>
<?php if (isset($_SESSION["Kullanici"])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPlat</title>
  </head>

  <body>
    <?php

    ?>
  </body>

  </html>
<?php } else {
  header("Location:index.php");
  exit();
} ?>