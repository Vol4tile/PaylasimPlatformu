<?php
require_once("baglan.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/settings.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <title>Paylaşım Platformu</title>
</head>

<body>

    <?php if (isset($_SESSION["Kullanici"])) { ?>

        <div id="menus">
            <div id="menusin">
                <a href="main.php">
                    <div id="sitename"><img src="images/guvercin.png" alt=""></div>
                </a>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
                <div id="mainmenu">

                    <a href="main.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
                </div>
            </div>
        </div>

        <div id="center">
            <a href="adisoyadisifirla.php">
                <div class="sifirla">Ad Soyad Değiştirmek İçin Tıklayın.</div>
            </a>
            <a href="sifresifirla.php">
                <div class="sifirla">Şifre Değiştirmek İçin Tıklayın.</div>
            </a>
            <a href="avatarsifirla.php">
                <div class="sifirla">Profil Resminizi Değiştirmek İçin Tıklayın.</div>
            </a>
        </div>

    <?php } else {

        header("Location:index.php");
        exit(); ?>
    <?php } ?>


</body>

</html>