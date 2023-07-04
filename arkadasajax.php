<?php
require_once("baglan.php");

?>
<?php if ($_POST) {

  $limit = $_POST['limit'];
  $offset = $_POST['offset'];
  $resim = $VeriTabaniBaglantisi->query("SELECT * FROM resimlerson ORDER BY resim_id DESC LIMIT $limit OFFSET $offset");
  if ($resim->rowcount()) {
    foreach ($resim as $resim) {

      $blog_id = $resim['resim_id'];

      $blog_baslik = $resim['resim_ad'];
      $blog_yazi = $resim['resim_yazi'];
      $blog_icerik = $resim['resim_paylas'];
      $blog_avatar = $resim['avatar'];
      $resim_paylasan = $resim['resim_paylasan_id'];
      $resimlerinyolu = "Resimler/" . $blog_baslik;
      $avataryolu = $blog_avatar;
      $resimlerinyolu = Filtre($resimlerinyolu); ?>

      <div class="Paylasim">
        <?php $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where id=? ");
        $KontrolSorgusu->execute([$resim_paylasan]);
        foreach ($KontrolSorgusu as $KontrolSorgusu) {
          $blog_icerik = $KontrolSorgusu['adisoyadi'];
          $avataryolu = $KontrolSorgusu['avatar'];
        } ?>

        <div id="paylasanavatar"><img src="<?php echo $avataryolu; ?>" alt="" style="float:left;"><span style="margin-left:20px;"><a href="kullanici.php?id=<?php echo $resim_paylasan;
                                                                                                                                                            ?>"><?php echo $blog_icerik; ?></a> </span><span class="takip"><span class="takipyazi">
              <?php
              $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM arkadas Where kullanici_id=? AND eklenen_id=?");
              $KontrolSorgusu->execute([$id, $resim_paylasan]);
              $KontrolSayisi = $KontrolSorgusu->rowCount();
              if ($KontrolSayisi > 0) {
                echo 'Takiptesin';
              } else {
                if ($id == $resim_paylasan) {
                  echo '';
                } else {
                  echo 'Takip Et';
                }
              } ?>
            </span>


            <input class="xyz" type="text" value="<?php echo $resim_paylasan; ?>" style="display:none;">
          </span> </div>

        <img src="<?php echo $resimlerinyolu; ?>" />
        <div id="resimyazi"><?php echo $blog_yazi; ?></div>
        <div class="begen"><img src="images/<?php
                                            $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM begen WHERE begenen_id=:id AND begenilen_paylasim_id=$blog_id");
                                            $yorumlar->execute(["id" =>  $id]);
                                            $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);


                                            if ($yorumlar->rowCount()) {
                                              echo 'nonlike.svg';
                                            } else {
                                              echo 'like.svg';
                                            }

                                            ?>" alt="<?php echo $blog_id; ?>" style="float:left;">





          <?php
          $sayac = 0;
          $begenisayisi = $VeriTabaniBaglantisi->query("SELECT * FROM begen WHERE begenilen_paylasim_id=$blog_id");
          foreach ($begenisayisi as  $begenisayisi) {
            $sayac++;
          }
          ?> <div class="begeniSayac"> <?php echo $sayac; ?> </div> <?php
                                                                                ?> Kişi bu paylaşımı beğendi.</div>

        <div id="yorumyap">
          <form action="yorumyap.php" method="GET" class="yorumajax">
            <textarea class="subject" name="yorum" placeholder="Bir şeyler yaz.." maxlength="250"></textarea>

            <input type="text" name="blogid" class="blogid" value="<?php echo $id; ?>" readonly style="display:none;">
            <input type="text" name="blogbaslik" class="blogbaslik" value="<?php echo $blog_id; ?>" readonly style="display:none;">
            <input type="text" name="blogyazi" class="blogyazi" value="<?php echo $blog_yazi; ?>" readonly style="display:none;">
            <input type="submit" id="gonderbuton2" value="Gonder" style="float:right;" />



          </form>
        </div>
        <a href="yorumlar.php?id=<?php echo $blog_id;  ?>">
          <div id="yorumlarigor">Tüm Yorumları Görmek İçin Tıkla</div>
        </a>
      </div>

  <?php


    }
  } ?>


  <script>
    $(".begen img").on('click', function(event) {
      event.stopPropagation();
      event.stopImmediatePropagation();

      event.preventDefault();
      var sayac = $(this).siblings(".begeniSayac").html();
      var thisLogo = $(this);
      var begenisayac = $(this).siblings(".begeniSayac")

      var value = $(this).attr("alt");
      var konu = "blogid=" + value;
      var x = $(this).attr("src")
      console.log("x")
      $.ajax({
        type: "POST",
        url: "begenajax.php",
        data: konu,

        success: function(sonuc) {
          if (x == 'images/nonlike.svg') {
            thisLogo.attr("src", "images/like.svg");
            sayac -= 1
            begenisayac.text(sayac)
            console.log(sayac)

          } else {

            thisLogo.attr("src", "images/nonlike.svg");
            sayac -= 1;
            sayac += 2
            begenisayac.text(sayac)
            console.log(sayac)
          }
        }


      });
    });
    $(".takip").click(function() {
      event.stopPropagation();
      event.stopImmediatePropagation();

      event.preventDefault();
      var i = 0
      var thisis = this;
      var value = $(".xyz", this).val();
      var konu = "value=" + value;
      console.log(konu)
      $.ajax({
        type: "POST",
        url: "arkadasekle.php",
        data: konu,
        success: function(y) {
          $(".xyz").each(function() {
            if ($(this).val() == value) {

              if ($(this).siblings(".takipyazi").text().trim() == "Takiptesin") {

                $(this).siblings(".takipyazi").text("Takip Et")
              } else if ($(this).siblings(".takipyazi").text().trim() == "Takip Et") {

                $(this).siblings(".takipyazi").text("Takiptesin")
              }
            }

          });
        }


      });
    });
    $(".yorumajax").on("submit", function(event) {
      event.stopPropagation();
      event.stopImmediatePropagation();
      event.preventDefault();
      var blogid = $(".blogid", this).val();
      console.log(blogid)

      var blogbaslik = $(".blogbaslik", this).val();

      var blogyazi = $(".blogyazi", this).val();

      var yorum = $("textarea[name='yorum']", this).val();
      console.log(yorum, blogid, blogbaslik, blogyazi, )

      $.ajax({
        url: 'yorumyap.php',
        type: 'POST',
        data: {
          blogid,
          blogbaslik,
          blogyazi,
          yorum
        },

        success: function(data) {

          console.log(data)
          alert("Yorum gönderildi")

        },
        error: function(data) {

          console.log(data.responseText)
          alert("Yorum gönderildi")


        }
      });

    });
  </script>







<?php } else ?>