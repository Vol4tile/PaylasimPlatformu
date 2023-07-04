<?php
session_start();
ob_start();
try {

  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "projeX";
  $VeriTabaniBaglantisi = new PDO("mysql:host=$host;charset=UTF8", $username, $password);
  $VeriTabaniBaglantisi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
  $VeriTabaniBaglantisi->exec($sql);
} catch (PDOException $Hata) {
  echo "Bağlanti Hatasi<br/>" . $Hata->GetMessage();
  die();
}
try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->query("SET NAMES 'utf8'");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Bağlantı Hatası: " . $e->getMessage();
}


$sql = "CREATE TABLE IF NOT EXISTS members (
  id INT(10)  AUTO_INCREMENT PRIMARY KEY, 
  adisoyadi VARCHAR(100) NOT NULL,
  kullaniciadi VARCHAR(50) NOT NULL,
  sifre VARCHAR(50) NOT NULL ,
  emailadresi VARCHAR(100) NOT NULL,
  kayittarihi int(10) UNSIGNED NOT NULL,
  durum INT(1) ,
  avatar BLOB
  )
  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS resimlerson (
    resim_id INT(11)  AUTO_INCREMENT PRIMARY KEY, 
    resim_ad BLOB,
    resim_paylas VARCHAR(250) NOT NULL,
    resim_yazi VARCHAR(250) NOT NULL ,
    avatar BLOB,
    resim_paylasan_id INT(11)
    )
    ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);


$sql = "CREATE TABLE IF NOT EXISTS yorumlar (
      yorum_id INT(11)  AUTO_INCREMENT PRIMARY KEY, 
      yorum_adisoyadi VARCHAR(200) NOT NULL,
      yorum_icerik VARCHAR(200) NOT NULL,
      yorum_blog_id INT(11),
      yorum_baslik VARCHAR(200)
      )
      ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS begen (
        yorum_id INT(10)  AUTO_INCREMENT PRIMARY KEY, 
        begenen_id INT(10)  NOT NULL,
        begenilen_paylasim_id INT(10)  NOT NULL,
        yorum_blog_id INT(10),
        durum INT(1)
        )
        ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS mesaj (
          mesaj_id INT(10)  AUTO_INCREMENT PRIMARY KEY, 
          atan_id INT(10)  NOT NULL,
          gelen_id INT(10)  NOT NULL,
          mesaj_yazi VARCHAR(200) NOT NULL
         
          )
          ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS arkadas (
            arkadas_id INT(10)  AUTO_INCREMENT PRIMARY KEY, 
            kullanici_id INT(10)  NOT NULL,
            eklenen_id INT(10)  NOT NULL
       
           
            )
            ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS grup (
              grup_id INT(10)  AUTO_INCREMENT PRIMARY KEY, 
              grup_adi VARCHAR(100)  NOT NULL,
              grup_aciklamasi VARCHAR(100)  NOT NULL,
              grup_resmi BLOB,
              grup_kurucusu INT(10) NOT NULL
             
              )
              ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS grup_paylasim (
                grup_paylasim_id INT(11)  AUTO_INCREMENT PRIMARY KEY, 
                paylasim_yapan_id INT(100)  NOT NULL,
                paylasim_yazi VARCHAR(100)  NOT NULL,
                paylasim_resim BLOB,
                grup_id INT(100) NOT NULL
               
                )
                ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS grup_uyelik (
                 uyelik_id INT(10) AUTO_INCREMENT PRIMARY KEY,
                 uye_id INT(10) NOT NULL,
                 grup_id INT(10) NOT NULL,
                 uyelik_durum INT(2) NOT NULL
                  )
                  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);
$sql = "CREATE TABLE IF NOT EXISTS grup_yorum (
                    grup_yorum_id INT(100) AUTO_INCREMENT PRIMARY KEY,
                    grup_id INT(100) NOT NULL,
                    paylasim_id INT(100) NOT NULL,
                    yorum_yapan_id INT(100) NOT NULL,
                    yorum VARCHAR(500) NOT NULL
                     )
                     ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->exec($sql);

try {
  $VeriTabaniBaglantisi = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
} catch (PDOException $Hata) {
  echo "Bağlanti Hatasi<br/>" . $Hata->GetMessage();
  die();
}

function Filtre($Deger)
{
  $Bir = trim($Deger);
  $İki = strip_tags($Bir);
  $Uc  = htmlspecialchars($İki, ENT_QUOTES);
  return $Uc;
}

$ZamanDamgasi = time();
if (isset($_SESSION["Kullanici"])) {
  $UyelerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where kullaniciadi=? ");
  $UyelerSorgusu->execute([$_SESSION["Kullanici"]]);
  $UyelerKayitSayisi = $UyelerSorgusu->rowCount();
  $UyelerKaydi = $UyelerSorgusu->fetch(PDO::FETCH_ASSOC);

  if ($UyelerKayitSayisi > 0) {
    $id = $UyelerKaydi['id'];
    $UyeninAdiSoyadi = $UyelerKaydi["adisoyadi"];
    $Uyeninid = $UyelerKaydi["kullaniciadi"];
    $UyeninAvatar = $UyelerKaydi["avatar"];
    $UyeninDurum = $UyelerKaydi["durum"];
  } else {
  }
}
