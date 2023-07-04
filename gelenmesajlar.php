<?php
require_once("baglan.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/gelenmesajlar.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
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
                <div id="mainmenu">
                    <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>

                    <a href="mesajlar.php"> <img src="./images/mesaj.svg" alt="Mesajlar"></a>
                    <a href="paylasim.php?id=<?php echo $id;  ?>"><img src="./images/hesap.svg" alt="Paylaşımlar"></a>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <div id="contentword"><?php $resim = $VeriTabaniBaglantisi->query("SELECT * FROM mesaj WHERE gelen_id=$id ORDER BY mesaj_id DESC ");
                                if ($resim->rowcount()) {
                                    foreach ($resim as $resim) { ?>
                    <div id=mesajlar style="margin-bottom:10px;">
                        <div id="mesajyollayan"><img src="<?php

                                                            $kisi = $resim['atan_id'];
                                                            $isim = $VeriTabaniBaglantisi->query("SELECT * FROM members WHERE id=$kisi");
                                                            if ($isim->rowcount()) {
                                                                foreach ($isim as $isim) {
                                                                    echo $isim['avatar'];
                                                                }
                                                            }






                                                            ?>" alt="">
                            <?php
                                        $kisi = $resim['atan_id'];
                                        $isim = $VeriTabaniBaglantisi->query("SELECT * FROM members WHERE id=$kisi");
                                        if ($isim->rowcount()) {
                                            foreach ($isim as $isim) {
                                                echo $isim['adisoyadi'];
                                            }
                                        }


                            ?>
                        </div>

                        <div id="mesaj"><?php echo $resim['mesaj_yazi']; ?></div>
                    </div>

        <?php
                                    }
                                }
                            } else
                                echo 'Hiç mesajınız yok ';
        ?>


</body>

</html>