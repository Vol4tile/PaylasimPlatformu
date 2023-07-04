<?php
require_once("baglan.php");
if ($_POST) {
    $value = $_POST["value"];

    if (!$value) {
    } else {
        $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE kullaniciadi=?");
        $row->execute([$value]);
        $goster = $row->fetchAll(PDO::FETCH_ASSOC);
        $x = $row->rowCount();
        if ($x) {

            echo "<span style='color:blue;'>Bu kullanıcı adı zaten kullanılıyor!</span>";
        } else {
            echo "<span style='color:red;'>(Minimum 8 - Maksimum 30 Karakter.)</span>";
        }
    }
} else {
    echo '<meta http-equiv="refresh" content="0;URL=main.php">';
}
