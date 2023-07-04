<?php

require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="./css/arkadas.css" rel="stylesheet">
    <title>Paylaşım Platformu</title>

</head>

<body>

    <div id="menus">
        <div id="menusin">
            <a href="main.php">
                <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:1px;" alt=""> </div>
            </a>
            <div class="spacemenu"></div>
            <div class="spacemenu"></div>
            <div id="mainmenu">
                <a href="misafir.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>



            </div>
        </div>
    </div>
    <br>
    <?php
    $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup ORDER BY grup_id DESC");
    $row->execute();
    $goster = $row->fetchAll(PDO::FETCH_ASSOC);
    $x = $row->rowCount();

    if ($x) {
        foreach ($goster as $liste) {
            $sayac = $liste['grup_id'];
    ?>

            <div class="liste" style=" word-wrap: break-word;   overflow:hidden; height:auto; padding:0px;margin:0px; padding-bottom:15px; width:100%;">
                <div style="margin:auto; width:50%;  height:100%; text-align:center;">
                    <img src="Resimler/<?php echo $liste['grup_resmi']; ?>" alt="proflresmi" style="width:100%; height:auto; max-height:300px;  ">
                    <p style="  height:auto;">Grup Adı : <?php echo  $liste['grup_adi']; ?></p>
                    <p style=" height:auto;">Grup Açıklaması: <?php echo  $liste['grup_aciklamasi']; ?></p>
                    <?php
                    $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_uyelik WHERE grup_id= $sayac AND uyelik_durum=1");
                    $row->execute();
                    $goster = $row->fetchAll(PDO::FETCH_ASSOC);
                    $x = $row->rowCount();
                    echo 'Üye sayısı : ' . $x;
                    ?>
                    <p>Eğer gruplara katılıp paylaşımları görmek istiyorsun <a href="index.php">Giriş yap</a></p>
                </div>
            </div>
    <?php
        }
    } ?>
</body>

</html>