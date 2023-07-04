<?php
require_once("baglan.php");

$kaynak = $_FILES["fileUp"]["tmp_name"];

$ad =  $_FILES["fileUp"]["name"];

$tip = $_FILES["fileUp"]["type"];

$boyut = $_FILES["fileUp"]["size"];

$hedef = "Resimler";
$GelenYazi = Filtre($_POST["yazi"]);

$ad = rand(1000, 5000) . rand(1000, 5000) . $ad;
$kaydet = move_uploaded_file($kaynak, $hedef . "/" . $ad);
$nokta = explode('.', $ad);
$nokta = $nokta[count($nokta) - 1];

if (($tip != "image/jpeg" || $nokta != "jpg") && ($tip != "image/svg+xml" || $nokta != "svg") && ($tip != "image/png" || $nokta != "png")) {
    echo '<div style="color:red;">Bu bölümde .jpg, .png veya .svg uzantılı dosya  yüklemeniz zorunludur.</div>';


    exit;
}

if ($kaydet) {
    $resimsor = $VeriTabaniBaglantisi->prepare("insert into resimlerson (resim_ad,resim_paylas,resim_yazi,avatar,resim_paylasan_id) VALUES (:resim_ad,:resim_paylas,:resim_yazi,:avatar,:resim_paylasan_id)");
    $resimsor->execute(
        array(
            ':resim_ad' => $ad,
            ':resim_paylas' => $UyeninAdiSoyadi,
            ':resim_yazi' => $GelenYazi,
            ':avatar' => $UyeninAvatar,
            ':resim_paylasan_id' => $id,
        )

    );

    echo '<div style="color:green;">işlem başarılı</div>';
} else {
    echo '<div style="color:red;">Lütfen resim seçiniz. Anasayfaya üç saniye içinde yönlendirileceksiniz.</div>';
}
?>
        <?php if (isset($_SESSION["Kullanici"])) { ?> 
        
        <?php } else {
            exit();
        } ?>