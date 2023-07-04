<?php
require_once("baglan.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/girisyap.css">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />

  <title>Paylaşım Platformu</title>
</head>

<body>
  <?php if (isset($_SESSION["Kullanici"])) {
    header("Location:main.php"); ?>


  <?php } else { ?>

    <div id="menus">
      <div id="menusin">
        <img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:5px;" alt="">
        <div class="spacemenu"></div>
        <div class="spacemenu"></div>
        <div class="spacemenu"></div>
      </div>
    </div>



    <div id="kapsayici">
      <div id="main">
        <form action="uyegiris.php" method="post">
          <div class="container">
            <h1 style="text-align:center; color:rgb(104, 104, 104);">Giriş Yap</h1>
            <hr>
            <label for="text"><b>Kullanıcı adı</b></label>
            <input type="text" placeholder="Kullanıcı adı giriniz" autocomplete="off" name="kullaniciadi" id="email" required>
            <label for="psw"><b>Şifre</b></label>
            <input type="password" placeholder="Şifre giriniz" autocomplete="off" name="sifre" id="psw" required>

            <hr>
            <button type="submit" class="registerbtn">Giriş Yap</button>
          </div>

          <div class="container signin">
            <p style="text-align:center; color:rgb(104, 104, 104);">Hesabın yok mu? <a href="kayitol.php">Kayıt Ol</a>.</p>
            <p style="text-align:center; color:green;">Hesap açmak veya kayıt olmak istemiyor musun? <a href="misafir.php">Misafir olarak devam et</a>.</p>
          </div>
        </form>
      </div>
    </div>

















  <?php } ?>



</body>

</html>
<?php
$VeriTabaniBaglantisi = null;
?>