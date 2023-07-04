<?php
require_once("baglan.php");

?>
<?php if (isset($_SESSION["Kullanici"])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/mesajlar.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <title>Paylaşım Platformu</title>
    </head>

    <body>
        <div id="menus">
            <div id="menusin">
                <a href="main.php">
                    <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:22px;" alt=""> </div>
                </a>
                <div class="spacemenu"></div>
                <div class="spacemenu"></div>
                <div id="mainmenu">
                    <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>



                    <a href="main.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
                </div>
            </div>
        </div>







        <div id="main">
            <form action="mesajgonder.php">


                <select name="uye" id="">
                    <?php
                    $uyeler = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE id !=:id");
                    $uyeler->execute([':id' => $id]);
                    if ($uyeler->rowCount()) {
                        foreach ($uyeler as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['adisoyadi'] . '</option>';
                        }
                    } else {
                        echo '<option value="' . $row['id'] . '">' . "Tek kullanıcı sensin" . '</option>';
                    }

                    ?>
                </select>
                <br>
                <textarea name="mesaj" maxlength="300"></textarea>
                <br>
                <button type="submit" name="mesajgonder">Mesaj Gönder</button>
            </form>



        </div>

        <a href="gelenmesajlar.php">
            <div id="gelen">Gelen Kutusu<img src="images/messages.svg" alt="Gelen Kutusu" name="gelen"></div>
        </a>
    <?php  } else {
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
} ?>
    </body>

    </html>