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
    <link rel="stylesheet" href="./css/kayitol.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

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
            <div id="resim"><img src="./images/kaydol.svg" alt="kayitol"></div>
            <div id="main">
                <form action="uyeolsonuc.php" method="post">
                    <div class="container">
                        <h1 style="text-align:center; color:rgb(104, 104, 104);">Kayıt Ol</h1>

                        <hr>
                        <label for="kullaniciadi"><b>Kullanıcı Adı <span id='sonuc'>(Minimum 8 - Maksimum 30 Karakter.)</span></b></label>

                        <input type="text" autocomplete="off" placeholder="Kullanıcı Adı Giriniz" name="kullaniciadi" id="kullaniciadi" maxlength="30" minlength="8" required>
                        <label for="psw-repeat"><b>İsim Soyisim <span style="color:red;  ">(Minimum 5 - Maksimum 100 Karakter.)</span></b></label>
                        <input type="text" autocomplete="off" placeholder="Adınızı Soyadınızı Giriniz" name="adsoyad" id="psw-repeat" maxlength="100" minlength="5" required>
                        <label for="email"><b>E-Mail <span id='sonucemail' style="color:red; ">(Minimum 5 - Maksimum 50 Karakter.)</span> </b></label>
                        <input type="email" autocomplete="off" placeholder="E-Mail Giriniz" name="emailadresi" maxlength="50" minlength="5" required>
                        <label for="psw"><b>Şifre <span style="color:red;  ">(Minimum 8 - Maksimum 50 Karakter.)</span></b></label>
                        <input type="password" autocomplete="off" placeholder="Şifre Giriniz" name="sifre" id="psw" maxlength="50" minlength="8" required>

                        <hr>
                        <button type="submit" class="registerbtn">Kaydı Tamamla</button>
                    </div>

                    <div class="container signin">
                        <p>Zaten bir hesabın var mı? <a href="index.php">Giriş Yap</a>.</p>
                    </div>
                </form>
            </div>
        </div>



    <?php } ?>
    <script src="jquery.js"></script>
    <script>
        $("input[name=kullaniciadi]").keyup(function() {
            var value = $(this).val();
            var konu = "value=" + value;

            $.ajax({
                type: "POST",
                url: "girisajax.php",
                data: konu,
                success: function(sonuc) {
                    $("#sonuc").html(sonuc);

                }


            });
        });
        $("input[name=emailadresi]").keyup(function() {
            var value = $(this).val();
            var konu = "value=" + value;

            $.ajax({
                type: "POST",
                url: "emailajax.php",
                data: konu,
                success: function(sonuc) {
                    $("#sonucemail").html(sonuc);

                }


            });
        });
    </script>

</body>

</html>
<?php
$VeriTabaniBaglantisi = null;
?>