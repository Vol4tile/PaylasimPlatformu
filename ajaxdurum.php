<?php
require_once("baglan.php");
if($_POST){
$sorgu = $VeriTabaniBaglantisi->prepare("UPDATE members SET durum = 1 WHERE id = $id");
$sorgu->execute();
}
else{
    echo'<meta http-equiv="refresh" content="0;URL=main.php">';
}
