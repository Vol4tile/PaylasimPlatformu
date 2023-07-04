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
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <title>Paylaşım Platformu</title>
</head>

<body>

    <?php if (isset($_SESSION["Kullanici"])) { ?>

        <div id="menus">
            <div id="menusin">
                <a href="main.php">
                    <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:22px;" alt=""> </div>
                </a>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
            </div>
        </div>
        <div class="sifirla">
            <form action="" method="POST">
                <label for="">Yeni Ad Soyad</label>
                <input type="text" name="adisoyadi" autocomplete="off">
                <button type="submit">Kaydet</button>

            </form>
        </div>
    <?php } else {

        header("Location:index.php");
        exit(); ?>
    <?php } ?>


    <?php
    if ($_POST) {
        $adisoyadi = $_POST['adisoyadi'];
        if ($adisoyadi == "") {
            echo ' <div style="color:red; position:absolute; text-align:center; width:300px; margin-left:800px;">Hata, İsim boş olamaz!</div>';
        } else {
            $guncelle = $VeriTabaniBaglantisi->prepare("UPDATE members SET adisoyadi=:adisoyadi  WHERE id=$id ");
            $guncelle->execute(array(":adisoyadi" => $adisoyadi));
        }
        echo ' <div style="color:green; position:absolute; text-align:center; width:300px; margin-left:800px;">İsim başarıyla değiştirildi, iki saniye içinde anasayfaya yönlendirileceksiniz.</div>';
        echo '<meta http-equiv="refresh" content="2;URL=main.php">';
    }



    ?>
</body>

</html>