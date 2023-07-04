<?php
require_once("baglan.php");
if ($_POST) {
        $grupid = $_POST['x'];

        $guncelle = $VeriTabaniBaglantisi->prepare("UPDATE grup_uyelik SET uyelik_durum=:adisoyadi  WHERE uyelik_id=$grupid ");
        $guncelle->execute(array(":adisoyadi" => 1));
}
