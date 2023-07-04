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
        <a href="misafirgrup.php"><img src="./images/grup.svg" alt="Gruplar"></a>



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
        url: 'arkadasajaxmisafir.php',
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
            url: 'arkadasajaxmisafir.php',
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