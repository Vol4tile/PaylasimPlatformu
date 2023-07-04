<?php
require_once("baglan.php");

?>



<?php if ($_GET['id']) {
  $id = $_GET['id'];
  $detay = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE id=:id");
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
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link href="./css/paylasim.css" rel="stylesheet">
  <title>Paylaşım Platformu</title>
</head>

<body>





  <div id="menus">
    <div id="menusin">
      <a href="main.php">
        <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px; margin-left:5px;" alt=""> </div>
      </a>
      <div class="spacemenu"></div>
      <div class="spacemenu"></div>
      <div id="mainmenu">
        <?php if (isset($_SESSION["Kullanici"])) { ?>
          <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>

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
  </div>
  <div id="soltaraf">
    <div id="absolute">
      <div id="span"><?php echo $row['adisoyadi']; ?></div>
      <div id="avatar"><img src="<?php echo $row['avatar']; ?>" alt=""></div>
    </div>
  </div>
  <div id="anasayfa"></div>

  <script src="jquery.js"></script>
  <script>
    $(document).ready(function() {

      var id = <?php echo $_GET['id']; ?>

      var loadLogs = 0;

      $.ajax({
        type: 'POST',
        url: 'kullaniciajax.php',
        data: {
          'offset': 0,
          'limit': 5,
          'id': id
        },
        success: function(data) {
          $("#anasayfa").html(data)
          loadLogs += 5;

          $('.resimboyut').on('load', function() {
            var resimler = document.getElementsByClassName("resimboyut")

            MaxPreviewDimension = 598;
            MaxPreviewDimension2 = 400;
            for (var i = 0; i < resimler.length; i++) {

              if (resimler[i].width > resimler[i].height) {
                resimler[i].style.width = MaxPreviewDimension + 'px';
                resimler[i].style.height = 'auto';

              } else {

                resimler[i].style.width = 'auto';
                resimler[i].style.height = MaxPreviewDimension2 + 'px';

              }
            }
          });

        }

      });

      $(window).scroll(function() {
        if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
          $.ajax({
            type: 'POST',
            url: 'kullaniciajax.php',
            data: {
              'offset': loadLogs,
              'limit': 5,
              'id': id
            },
            success: function(data) {
              $("#anasayfa").append(data);
              loadLogs += 5;
              $('.resimboyut').on('load', function() {
                var resimler = document.getElementsByClassName("resimboyut")

                MaxPreviewDimension = 598;
                MaxPreviewDimension2 = 400;
                for (var i = 0; i < resimler.length; i++) {

                  if (resimler[i].width > resimler[i].height) {
                    resimler[i].style.width = MaxPreviewDimension + 'px';
                    resimler[i].style.height = 'auto';

                  } else {

                    resimler[i].style.width = 'auto';
                    resimler[i].style.height = MaxPreviewDimension2 + 'px';

                  }
                  resimler[i].maxWidth = 598 + "px";
                  resimler[i].maxHeight = 400 + "px";
                }
              });
            }
          });


        }
      });

    });
  </script>

</body>

</html> <?php  ?>