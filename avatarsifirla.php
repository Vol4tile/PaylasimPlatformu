<?php
require_once("baglan.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/sifirla.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <title>Paylaşım Platformu</title>
</head>

<body>

    <?php if (isset($_SESSION["Kullanici"])) { ?>

        <div id="menus">
            <div id="menusin">
                <a href="main.php">
                    <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px;margin-left:22px;" alt=""> </div>
                </a>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
            </div>
        </div>
        <div class="sifirla">
            <form action="avatarsifirlasonuc.php" method="POST" enctype="multipart/form-data">
                <label for="">Yeni Profil Resminizi Seçiniz...</label>
                <input type="file" name="file">
                <input type="submit" id="gonderbuton" value="Gonder" style="background-color:#1653a3; color:white; width:150px; height:40px; border-radius:5px;" />

            </form>
        </div>
    <?php } else {

        header("Location:index.php");
        exit(); ?>
    <?php } ?>



</body>

</html>