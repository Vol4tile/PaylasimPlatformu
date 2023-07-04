<?php
require_once("baglan.php");

$kaynak = $_FILES["fileUp"]["tmp_name"];

$ad =  $_FILES["fileUp"]["name"];

$tip = $_FILES["fileUp"]["type"];

$boyut = $_FILES["fileUp"]["size"];

$hedef = "Resimler";
$GelenYazi = Filtre($_POST["grupAdi"]);
$GelenYazi2 = Filtre($_POST["grupAciklamasi"]);
$ad = rand(1000, 5000) . rand(1000, 5000) . $ad;

$kaydet = move_uploaded_file($kaynak, $hedef . "/" . $ad);
$nokta = explode('.', $ad);
$nokta = $nokta[count($nokta) - 1];

if (($tip != "image/jpeg" || $nokta != "jpg") && ($tip != "image/svg+xml" || $nokta != "svg") && ($tip != "image/png" || $nokta != "png")) {
    echo '<div style="color:red;">Bu bölümde .jpg, .png veya .svg uzantılı dosya  yüklemeniz zorunludur.</div>';


    exit;
}
if ($kaydet) {
    $resimsor = $VeriTabaniBaglantisi->prepare("insert into grup (grup_adi,grup_aciklamasi,grup_resmi,grup_kurucusu) VALUES (:resim_ad,:resim_paylas,:resim_yazi,:resim_paylasan_id)");
    $resimsor->execute(
        array(
            ':resim_ad' => $GelenYazi,
            ':resim_paylas' => $GelenYazi2,
            ':resim_yazi' => $ad,
            ':resim_paylasan_id' => $id,
        )

    );
    $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup WHERE grup_kurucusu=:id ORDER BY grup_id DESC LIMIT 1");
    $yorumlar->execute(["id" =>  $id]);
    $yorum = $yorumlar->fetch(PDO::FETCH_OBJ);
    $x = $yorum->grup_id;
    $sorgu = $VeriTabaniBaglantisi->prepare("INSERT INTO grup_uyelik(uye_id, grup_id,uyelik_durum) VALUES($id, $x,1)");

    $sorgu->execute();

    echo '<div style="color:green;">işlem başarılı</div>';
} else {
    echo '<div style="color:red;">Lütfen resim seçiniz. Anasayfaya üç saniye içinde yönlendirileceksiniz.</div>';
}
?>
        <?php if (isset($_SESSION["Kullanici"])) { ?> 
        
        <?php } else {
            exit();
        } ?>