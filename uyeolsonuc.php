<?php
require_once("baglan.php");

if (isset($_POST["kullaniciadi"])) {
    $GelenKullaniciAdi = Filtre($_POST["kullaniciadi"]);
} else {
    $GelenKullaniciAdi = "";
}

if (isset($_POST["sifre"])) {
    $GelenSifre = Filtre($_POST["sifre"]);
} else {
    $GelenSifre = "";
}


if (isset($_POST["adsoyad"])) {
    $GelenIsimSoyisim = Filtre($_POST["adsoyad"]);
} else {
    $GelenIsimSoyisim = "";
}

if (isset($_POST["emailadresi"])) {
    $GelenEmailAdresi = Filtre($_POST["emailadresi"]);
} else {
    $GelenEmailAdresi = "";
}
$avatar = "images/avatar.svg";

$KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where kullaniciadi=? OR emailadresi=?");
$KontrolSorgusu->execute([$GelenKullaniciAdi, $GelenEmailAdresi]);
$KontrolSayisi = $KontrolSorgusu->rowCount();
if ($KontrolSayisi > 0) {

?> <div style="height:90vh; width:90vw; box-sizing:border-box; padding:0; margin:0;">
        <div style="margin:0; text-align:center;">Aynı kullanıcı adı veya e mail ikinci kez kullanılamaz.</div>
        <div style="text-align:center; height:50px; width:50px; padding:0; margin:auto; "><img src="images/fail.svg" alt="Başarısız"></div>
    </div>
<?php
    echo '<meta http-equiv="refresh" content="2;URL=kayitol.php">';
    exit();
} else {
    $KayitEkle = $VeriTabaniBaglantisi->prepare("INSERT INTO members (kullaniciadi,sifre,adisoyadi,emailadresi,kayittarihi,avatar) values(?,?,?,?,?,?)");
    $KayitEkle->execute([$GelenKullaniciAdi, $GelenSifre, $GelenIsimSoyisim, $GelenEmailAdresi, $ZamanDamgasi, $avatar]);
    $KayitKontrol = $KayitEkle->rowCount();
}

if ($KayitKontrol > 0) {

    echo '<meta http-equiv="refresh" content="2;URL=main.php">';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <title>Paylaşım Platformu</title>
    </head>

    <body style="text-align:center;">


        <div style="width :auto; height:20px; padding:0; line-height:20px; margin:auto; margin-top:100px ">Kayıt Başarıyla Yapıldı.</div>
        <img src="/images/onay.gif" style="width:445px;height:350px; margin:auto;" alt="Başarılı!">

    </body>

    </html>
<?php
} else {

?> <div style="height:90vh; width:90vw; box-sizing:border-box; padding:0; margin:0;">
        <div style="margin:0; text-align:center;">Bir Hata oluştu.</div>
        <div style="text-align:center; height:50px; width:50px; padding:0; margin:auto; "><img src="images/fail.svg" alt="Başarısız"></div>
    </div>
<?php
}




?>