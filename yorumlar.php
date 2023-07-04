<?php
require_once("baglan.php");

if ($_GET['id']) {
    $id = $_GET['id'];
    $detay = $VeriTabaniBaglantisi->prepare("SELECT * FROM resimlerson WHERE resim_id=:id");
    $detay->execute(["id" => $_GET['id']]);
    $row = $detay->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="./css/yorumlar.css" rel="stylesheet">
    <title>Paylaşım Platformu</title>
</head>
<script src="./jquery.js"></script>
<script>
    function resimboyut() {
        var resimler = document.getElementById("resimim")

        MaxPreviewDimension = 900;
        MaxPreviewDimension2 = 500;


        if (resimler.width > resimler.height) {
            resimler.style.width = MaxPreviewDimension + 'px';
            resimler.style.height = 'auto';

        } else {

            resimler.style.width = 'auto';
            resimler.style.height = MaxPreviewDimension2 + 'px';


        }
    }
</script>

<body>
    <div id="menus">
        <div id="menusin">
            <a href="main.php">
                <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:22px;" alt=""> </div>
            </a>
            <div class="spacemenu"></div>
            <div class="spacemenu"></div>
            <div id="mainmenu">
                <?php if (isset($_SESSION["Kullanici"])) { ?>
                    <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>
                    <a href="settings.php"> <img src="./images/settings.svg" alt="Ayarlar"></a>
                    <a href="mesajlar.php"> <img src="./images/mesaj.svg" alt="Mesajlar"></a>

                    <a href="main.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
                <?php } else { ?>
                    <a href="misafir.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
                <?php } ?>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div id="main">

        <div id="paylasanavatar"><img src="<?php echo $row['avatar']; ?>" alt=""></div>
        <div id="span"><?php echo $row['resim_paylas']; ?></div>


        <div id="resim"><img src="<?php echo 'Resimler/' . $row['resim_ad']; ?>" alt="" id="resimim" onload="resimboyut();"></div>


        <div id="yazi"><?php echo $row['resim_yazi']; ?></div>
    </div>

    <?php
    $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE yorum_blog_id=:id");
    $yorumlar->execute(["id" => $_GET["id"]]);
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
    if ($yorumlar->rowCount()) {
        foreach ($yorum as $rowYorum) {
    ?>
            <div id="yorumlarsatiri">
                <h3><?= $rowYorum->yorum_adisoyadi ?>'tarafından gelen yorum</h3>
                <hr>
                <h3 id="yorumyazisi"><?= $rowYorum->yorum_icerik ?></h3>
            </div>


        <?php
        }
    } else {
        ?><div id="yorumlarsatiri"><?php echo "Bu Yazıya yorum yapilmamış"; ?> </div>
    <?php } ?>


</body>

</html>