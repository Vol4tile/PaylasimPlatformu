<?php
require_once("baglan.php");

?>
<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <title>Paylaşım platformu</title>
    <link href="./css/anasayfa.css" rel="stylesheet">

</head>

<body>
    <?php if (isset($_SESSION["Kullanici"])) { ?>
        <div id="postsonuc" style="position:absolute; left:40%;top:23%; display:none;">ssasasa</div>
        <?php if ($UyeninDurum == 0) {
        ?>

            <style>
                #main {
                    display: none;
                }
            </style>
            <div id="sorular">
                <div id="soru1">Merhaba <?php echo $UyeninAdiSoyadi; ?> Paylaşım platformu'na hoşgeldin. Burada ilgini çeken topluluklara katılabilir veya topluluk oluşturabilirsin.</div>
                <div id="soru2">Şimdi senden ilgini çeken seçeneklerden 3 tane seçmeni istiyoruz. İlgi alanlarına göre sana topluluk önereceğiz.</div>
                <div id="soru3">
                    <form>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" class="single-checkbox">
                        <label for="vehicle1"> Oyun</label>
                        <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" class="single-checkbox">
                        <label for="vehicle2"> Teknoloji</label>
                        <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat" class="single-checkbox">
                        <label for="vehicle3"> Eğlence</label>
                        <br>
                        <input type="checkbox" id="vehicle4" name="vehicle3" value="Boat" class="single-checkbox">
                        <label for="vehicle4"> Haber</label>
                        <input type="checkbox" id="vehicle5" name="vehicle3" value="Boat" class="single-checkbox">
                        <label for="vehicle5"> Manzara</label>
                        <input type="checkbox" id="vehicle6" name="vehicle3" value="Boat" class="single-checkbox">
                        <label for="vehicle6"> Mizah</label>
                    </form>
                    <div>Eğer seçimini yaptıysan butona tıklayıp gönlünce gezinebilirsin.</div>
                    <div><button id="soru4">Gezmeye başla</button> </div>
                </div>

            </div>
        <?php } ?>

        <div id="menus">
            <div id="menusin">
                <a href="main.php">
                    <div id="sitename"><img src="./images/Payplatlogo.png" alt="" style="padding:5px;"> </div>
                </a>

                <div id="ara"><input type="text" autocomplete="off" name="ara" placeholder="Ara"> <img src="./images/search.svg" alt="Ara" id="aralogo">
                    <div id="triangle"><img src="./images/triangle.svg" alt="triangle"></div>
                    <div id="sonuc"><span></span></div>
                </div>

                <div id="mainmenu">
                    <a href="cıkış.php"><img src="./images/exit.svg" alt="Çıkış"></a>
                    <a href="grup.php"><img src="./images/grup.svg" alt="Grup"></a>
                    <a href="mesajlar.php"><img src="./images/mesaj.svg" alt="Mesaj"></a>
                    <a href="settings.php" id="settings"><img src="./images/settings.svg" alt="Ayarlar"></a>

                    <a href="arkadas.php"> <img src="./images/kesfet.svg" alt="Keşfet"></a>

                    <a href="paylasim.php?id=<?php echo $id;  ?>"><img src="./images/hesap.svg" alt="Paylaşımlar"></a>
                </div>
            </div>
        </div>

        <div id="main">
            <div id="content">

                <div id="top">
                    <div id="avatar"><img src="<?php echo $UyeninAvatar; ?>" alt="" style="float:left;">
                        <div id="me"> <span style="margin-left:20px;"><?php echo $UyeninAdiSoyadi; ?></span> </div>
                    </div>

                </div>


                <div id="contentimage">
                    <form action="ajaxkaydet.php" id="poster" method="POST" enctype="multipart/form-data">
                        <textarea class="subject" id="textarena1" name="yazi" placeholder="Bir şeyler yaz.." maxlength="250" style="font-family: 'Staatliches', cursive;"></textarea>
                        <hr style="width:100%; height:1px;">
                        <input style="display:none;" id="fileUp" class="form-control" type="file" name="fileUp" />
                        <label for="fileUp" id="dosya"><img src="images/resimyolla.svg" alt="" style="float:left; ">Resim Ekle</label>

                        <input type="submit" id="gonderbuton" value="Gonder" />

                    </form>
                </div>

                <div id="contentword">

                </div>
            </div>

        </div>

        <script src="jquery.js"></script>
        <script>
            var limit = 3;
            $('input.single-checkbox').on('change', function(evt) {
                if ($(this).siblings(':checked').length >= limit) {
                    this.checked = false;
                }
            });


            $("*").click(function() {
                if (!$(event.target).is("input[name=ara]")) {
                    $("#sonuc").css("display", "none")
                    $("#aralogo").show()
                    $("#ara input").css("text-indent", "20px");
                    $("#triangle").hide()
                }


            });

            $("input[name=ara]").click(function() {
                var button = $("input[name=ara]");
                $("#aralogo").hide()
                $("#ara input").css("text-indent", "0px");
                $("#sonuc").show()
                $("#triangle").show()

            });

            $("input[name=ara]").keyup(function() {
                var value = $(this).val();
                var konu = "value=" + value;

                $.ajax({
                    type: "POST",
                    url: "ajaxarama.php",
                    data: konu,
                    success: function(sonuc) {
                        $("#sonuc").html(sonuc);
                    }


                });
            });

            $("#soru4").click(function() {

                var konu = "value="
                $.ajax({
                    type: "POST",
                    url: "ajaxdurum.php",
                    data: konu,
                    success: function() {
                        $("#main").show();
                        $("#sorular").hide();
                    }


                });
            });
            $("#settings").click(function(e) {
                e.preventDefault();
                $("#settingsdiv").remove();
                window.scrollTo(0, 0);
                $("#contentimage").after("<div id='settingsdiv' style='text-align:center;border:1px solid white;'></div>");
                var degisken1 = ` <a href="adisoyadisifirla.php"><div class="sifirla" style="color:red; ">Ad Soyad Değiştirmek İçin Tıklayın.</div></a>
                                  <a href="sifresifirla.php"><div class="sifirla" style="color:red; ">Şifre Değiştirmek İçin Tıklayın.</div></a>
                                  <a href="avatarsifirla.php"><div class="sifirla" style="color:red; ">Profil Resminizi Değiştirmek İçin Tıklayın.</div></a>
                                  <div style="color:green; cursor:pointer;" onclick='sil(this)'>vazgec</div>
                                  `
                $("#settingsdiv").append(degisken1);

            });

            function sil(s) {
                console.log("tikladim");
                $(s).parent().remove();

            }


            $("#poster").on("submit", function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#poster").trigger("reset");


                    },
                    error: function(data) {


                        $("#poster").trigger("reset");
                        $("#postsonuc").show().html(data.responseText);
                        setTimeout(function() {
                            $("#postsonuc").hide()
                        }, 3000);

                    }
                });

            });

            $(document).ready(function() {
                var loadLogs = 0;

                $.ajax({
                    type: 'POST',
                    url: 'mainajax.php',
                    data: {
                        'offset': 0,
                        'limit': 5
                    },
                    success: function(data) {
                        $("#contentword").append(data);
                        loadLogs += 5;


                    }

                });

                $(window).scroll(function() {
                    if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
                        $.ajax({
                            type: 'POST',
                            url: 'mainajax.php',
                            data: {
                                'offset': loadLogs,
                                'limit': 5
                            },
                            success: function(data) {
                                $("#contentword").append(data);
                                loadLogs += 5;

                            }
                        });
                    }
                });
            });

            var resimler = document.getElementsByClassName("resimboyut")
            MaxPreviewDimension = 698;
            MaxPreviewDimension2 = 600;
            for (var i = 0; i < resimler.length; i++) {
                if (resimler[i].width > resimler[i].height) {
                    resimler[i].style.width = MaxPreviewDimension + 'px';
                    resimler[i].style.height = 'auto';

                } else {

                    resimler[i].style.width = 'auto';
                    resimler[i].style.height = MaxPreviewDimension2 + 'px';
                }
            }
        </script>



    <?php } else {

        header("Location:index.php");
        exit(); ?>
    <?php } ?>

    <?php



    ?>

    <?php
    if (isset($_GET['begen'])) {
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



</body>

</html>
<?php
$VeriTabaniBaglantisi = null;
?>