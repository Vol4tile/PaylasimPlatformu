<?php
require_once("baglan.php");
if ($_POST) {
    $value = $_POST["value"];

    if (!$value) {
    } else {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Paylaşım Platformu</title>
        </head>

        <body>
            <div id="loading"><img src="/images/loading.gif" style="width:20%;height:20%; display:absolute; left:40%; top:40%;" alt="Başarılı!"></div>
            <script src="jquery.js"></script>
            <script>
                function hideLoader() {
                    $('#loading').hide();
                }

                $(window).ready(hideLoader);


                setTimeout(hideLoader, 20 * 1000);
            </script>
        </body>

        </html> <?php
                $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE adisoyadi LIKE ?");
                $row->execute(array("%" . $value . "%"));
                $goster = $row->fetchAll(PDO::FETCH_ASSOC);
                $x = $row->rowCount();

                if ($x) {
                    foreach ($goster as $liste) {
                        if ($liste['id'] == $id) {
                        }
                ?>
                <div class="liste" style=" word-wrap: break-word; height:60px; width:400px; position:relative; left:0px; overflow:hidden; "> <a href="kullanici.php?id=<?php echo $liste['id']; ?>">
                        <img src="<?php echo $liste['avatar']; ?>" alt="proflresmi" style="height:60px; width:40px; position:absolute; left:5px; top:0px;  border-radius:20px;">
                        <p style="position:absolute; left:60px; top:0px; height:25px;"> <?php echo  $liste['adisoyadi']; ?> </p>
                        <p style="position:absolute; left:60px; top:25px; height:25px;">@<?php echo $liste['kullaniciadi']; ?></p>
                    </a></div>

<?php

                    }
                } else {
                }
            }
        } else {
            echo '<meta http-equiv="refresh" content="0;URL=main.php">';
        }
?>