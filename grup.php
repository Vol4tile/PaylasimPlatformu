<?php
require_once("baglan.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/grup.css">

    <title>Paylaşım Platformu</title>
</head>

<body>
    <?php if (isset($_SESSION["Kullanici"])) { ?>
        <input id="userid" style="display:none;" type="text" name="data" value="<?php echo  $id ?>">



        <div class="container">
            <div id="menus">
                <div id="menusin">
                    <a href="main.php">
                        <div id="sitename"><img src="images/Payplatlogo.png" style=" width:135px; padding-top:5px;padding-bottom:5px;" alt=""> </div>
                    </a>

                    <div id="ara"><input type="text" autocomplete="off" name="ara" placeholder="Ara"> <img src="./images/search.svg" alt="Ara" id="aralogo">
                        <div id="triangle"><img src="./images/triangle.svg" alt="triangle"></div>
                        <div id="sonuc"><span></span></div>
                    </div>

                    <div id="mainmenu">

                        <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>
                        <div>
                            <a href="" id="bildirim"><img src="./images/bildirim.svg" alt="Çıkış"></a>
                            <div id="bildirimucgen">
                                <div><img src="./images/triangle.svg" alt="triangle" id="bildirimphoto"></div>
                            </div>
                            <div id="bildirimsonuc"><span></span></div>
                        </div>






                        <a href="main.php"><img src="./images/mainmenu.svg" alt="Paylaşımlar"></a>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="leftbar">
                    <div id="grupolustur">
                        <div id="yazi" class="isActive">Grup Oluştur</div>
                        <div id="gruplariListele" class="isActive">Grupları Listele</div>
                        <div id="benimGruplar" class="isActive">Gruplarım</div>
                    </div>
                    <div id="gruplar"></div>

                </div>
                <div id="posts">
                    <div id="xcontainer">
                        <div id="grupisimleri" style="display:none;"></div>
                        <div id="innercontainer" style="display:block;">
                            <div id="Company">Grup oluştur</div>

                            <form action="" id="grupOlustur">

                                <input type="text" id="Name" name="grupAdi" placeholder="Grup adını yazınız..." autocomplete="off">

                                <input type="text" name="grupAciklamasi" id="userid" class="change" placeholder="Grup açıklamasını yazınız..." autocomplete="off">

                                <input type="file" name="fileUp" id="resim" style="display:none;">
                                <label for="resim" id="resimekle" style="margin-left:100px"><img src="images/resimyolla.svg" alt="" style="float:left; width:50px;
                                 height:50px; ">Resim Ekle</label>

                                <input type="submit" value="Grup oluştur" id="Button" style="margin-right:100px; margin-bottom:10px; line-height:10px; height:40px">
                                <div id="onizlediv" style="display:none"><img alt="Resim" id="onizle"></div>
                            </form>

                        </div>

                    </div>

                    <div class="paylasimlar"></div>
                </div>

            </div>

        </div>

        <script src="jquery.js"></script>
        <script>
            function Yorumat(x, y) {

                var value = $("#yorumtext").val();
                $.ajax({
                    url: 'grupyorumyap.php',
                    type: 'POST',
                    data: {
                        x,
                        y,
                        value,

                    },

                    success: function(data) {

                        console.log(data)
                        alert("Yorum gönderildi")

                    }
                })
            }
        </script>
        <script src="jquery.js"></script>
        <script src="javascript/grup.js"></script>
    <?php } else {
    } ?>
</body>

</html>