<?php if ($_POST) {
  require_once("baglan.php");
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

      <div class="Paylasim" style="height:auto;">
        <?php $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where id=? ");
        $KontrolSorgusu->execute([$resim_paylasan]);
        foreach ($KontrolSorgusu as $KontrolSorgusu) {
          $blog_icerik = $KontrolSorgusu['adisoyadi'];
          $avataryolu = $KontrolSorgusu['avatar'];
        } ?>

        <div id="paylasanavatar"><img src="<?php echo $avataryolu; ?>" alt="" style="float:left;"><span style="margin-left:20px;"><a href="kullanici.php?id=<?php echo $resim_paylasan;
                                                                                                                                                            ?>"><?php echo $blog_icerik; ?></a> </span><span class="takip"><span class="takipyazi">
              <?php
              ?>
            </span>


            <input class="xyz" type="text" value="<?php echo $resim_paylasan; ?>" style="display:none;">
          </span> </div>

        <img src="<?php echo $resimlerinyolu; ?>" />
        <div id="resimyazi"><?php echo $blog_yazi; ?></div>
        <?php
        $sayac = 0;
        $begenisayisi = $VeriTabaniBaglantisi->query("SELECT * FROM begen WHERE begenilen_paylasim_id=$blog_id");
        foreach ($begenisayisi as  $begenisayisi) {
          $sayac++;
        }
        ?> <div class="begeniSayac" style="padding-left:10px;"> <?php echo $sayac; ?> Kişi bu paylaşımı beğendi. </div>
        <div><?php
              ?> </div>






        <a href="yorumlar.php?id=<?php echo $blog_id;  ?>">
          <div id="yorumlarigor" style="margin-top:40px;">Tüm Yorumları Görmek İçin Tıkla</div>
        </a>
      </div>
      </div>
  <?php


    }
  } ?>











<?php } else ?>