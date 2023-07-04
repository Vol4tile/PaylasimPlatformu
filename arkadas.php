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
  <?php if (isset($_SESSION["Kullanici"])) { ?>
    <div id="menus">
      <div id="menusin">
        <a href="main.php">
          <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:1px;" alt=""> </div>
        </a>
        <div class="spacemenu"></div>
        <div class="spacemenu"></div>
        <div id="mainmenu">
          <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>

          <a href="mesajlar.php"> <img src="./images/mesaj.svg" alt="Mesajlar"></a>
          <a href="main.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
        </div>
      </div>
    </div>
    <br>
    <div id="contentword"></div>




    <script src="jquery.js"></script>
    <script>
      $(document).ready(function() {
        var loadLogs = 0;

        $.ajax({
          type: 'POST',
          url: 'arkadasajax.php',
          data: {
            'offset': 0,
            'limit': 16
          },
          success: function(data) {
            $("#contentword").append(data)
            loadLogs += 16;
          }
        });

        $(window).scroll(function() {
          if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
            $.ajax({
              type: 'POST',
              url: 'arkadasajax.php',
              data: {
                'offset': loadLogs,
                'limit': 16
              },
              success: function(data) {
                $("#contentword").append(data);
                loadLogs += 16;
              }
            });
          }
        });
      });
    </script>





  <?php } else ?>
</body>

</html>

<?php if (isset($_GET['begen'])) {
  $blogid =  $_GET['blogid'];

  $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM begen WHERE begenen_id=:id AND begenilen_paylasim_id=$blogid");
  $yorumlar->execute(["id" =>  $id]);
  $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);


  if ($yorumlar->rowCount()) {
    $yorumlar = $VeriTabaniBaglantisi->prepare("DELETE  FROM begen WHERE begenen_id=:id AND begenilen_paylasim_id=$blogid");
    $yorumlar->execute(["id" =>  $id]);
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);

    header("Location:index.php");
  } else {

    $sonuc = $VeriTabaniBaglantisi->exec("INSERT INTO begen SET durum=1,begenilen_paylasim_id=$blogid,begenen_id=$id");

    header("Location:index.php");
  }
}


?>