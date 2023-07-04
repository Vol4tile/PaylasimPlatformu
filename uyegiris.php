<?php
require_once("baglan.php");

if(isset($_POST["kullaniciadi"])){
    $GelenKullaniciAdi = Filtre($_POST["kullaniciadi"]);
}

else {
    $GelenKullaniciAdi = "";
}
    
if(isset($_POST["sifre"])){
    $GelenSifre = Filtre($_POST["sifre"]);
}

else {
    $GelenSifre ="";
}
    


$KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where kullaniciadi=? AND sifre=?");
$KontrolSorgusu->execute([$GelenKullaniciAdi,$GelenSifre]);
$KontrolSayisi = $KontrolSorgusu->rowCount();

if($KontrolSayisi>0){
    $_SESSION["Kullanici"] ="$GelenKullaniciAdi";
    header("Location:index.php");
    exit();
}else{
echo "Giriş Başarısız Lütfen Tekrar deneyin";
echo'<meta http-equiv="refresh" content="2;URL=index.php">';
exit();
}
