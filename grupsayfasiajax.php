<?php
require_once("baglan.php");
if ($_POST) {

    $grupid = filtre($_POST['degisken']);
    $y = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup WHERE grup_id=$grupid LIMIT 1");
    $y->execute();
    $ekran = $y->fetchAll(PDO::FETCH_ASSOC);
    $x = $y->rowCount();
    if ($x) {
?>
        <html>

        <body>
            <div style=" text-align:center; height:auto;  ">
                <div style="color:black;  ">
                    <img src="Resimler/<?php echo $ekran[0]['grup_resmi']; ?>" alt="" title="Grup resmi" style="width:40%; margin-left:150px;  max-height:270px;margin-top:10px; border-radius:10px;padding:5px;float:left;">
                    <br>
                    <div style="line-height:80px; height:80px; width:350px;  background-color:white; border-radius:10px;margin:auto; margin-right:150px; margin-top:25px;"> Grup Adi :<?php echo $ekran[0]['grup_adi']; ?></div>
                    <br>
                    <div style="color:black;line-height:80px; height:80px; width:350px;  background-color:white; border-radius:10px;margin:auto; margin-right:150px; "> Grup Acıklaması: <?php echo $ekran[0]['grup_aciklamasi']; ?></div>
                </div>

            </div>
            <div style="height:7vh;">&nbsp;</div>



            <div id="contentimage" style="border:none; margin:auto; margin-top:10px; width:60%;">
                <form id="grup_post" method="POST" enctype="multipart/form-data">
                    <textarea class="subject" id="textarena1" name="yazi" placeholder="Bir şeyler yaz.." maxlength="250" style="font-family: 'Staatliches', cursive;width:100%"></textarea>
                    <hr style="width:100%; height:1px;">
                    <input style="display:none;" id="fileUp" class="form-control" type="file" name="fileUp" />
                    <label for="fileUp" id="dosya" style="width:100px; height:50px; padding:0px; margin:0px;"><img src="images/resimyolla.svg" alt="" style="width:50px; float:left;"><span style=" float:left;"> Resim Seç</span></label>
                    <input type="text " name="grup_id" style="display:none;" value="<?php echo $ekran[0]['grup_id'] ?> ">
                    <input type="submit" id="gonderbuton" value="Gonder" />

                </form>
                <br>
                <br>
            </div>
            <div style="height:3vw; ">&nbsp;</div>
            <script src="jquery.js"></script>
            <script>

            </script>
            <?php
            $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_paylasim WHERE grup_id=$grupid");
            $row->execute();
            $goster = $row->fetchAll(PDO::FETCH_ASSOC);
            $x = $row->rowCount();

            if ($x) {
                foreach ($goster as $liste) {

                    $kullaniciid = $liste['paylasim_yapan_id'];
                    $kullanici = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE id=$kullaniciid");
                    $kullanici->execute();
                    $sayi = $kullanici->fetchAll(PDO::FETCH_ASSOC);
                    $denemeler = $kullanici->rowCount();
            ?> <div style="height:auto; background-color:red; display:block;"><?php
                                                                    if ($denemeler) {
                                                                    ?>

                            <div style="width:90%;  border-radius:5px; display:block; height:auto; max-height:500px; margin:5px; ">
                                <div style="width:20%; height:auto; float:left; "><img src="<?php echo $sayi[0]['avatar']; ?>" alt="avatar" style="width:100px; height:100px; border-radius:50%;">
                                    <div><?php echo $sayi[0]['adisoyadi']; ?></div>
                                </div>
                                <div style="width:80%; height:auto; float:left; "><img style="width:100%; height:auto; max-height:400px; border-radius:10px;" src="./Resimler/<?php echo $liste['paylasim_resim']; ?>" alt="">
                                    <div><?php echo $liste['paylasim_yazi'];
                                                                        $paylasimid = $liste['grup_paylasim_id']
                                            ?></div>
                                    <div id="yorumyap" style="width: 100%; height:50px;">
                                        <form action="">
                                            <input type="text" id="yorumtext" style="width: 80%; height:50px;" placeholder="Yorum Yaz">
                                            <input type="button" value="Gönder" style="width:20%; height:50px;" id="yorumgonder" onclick="Yorumat(<?php echo $paylasimid; ?>,<?php echo $grupid; ?>)">
                                        </form>
                                    </div>
                                    <br>
                                    <div id="yorumlarıgor" style="width:100%;  height:100px; overflow-x:auto; word-wrap:break-word;">
                                        <?php
                                                                        $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_yorum WHERE grup_id=$grupid AND paylasim_id=$paylasimid");
                                                                        $row->execute();
                                                                        $goster = $row->fetchAll(PDO::FETCH_ASSOC);
                                                                        $x = $row->rowCount();

                                                                        if ($x) {
                                                                            foreach ($goster as $liste) {
                                        ?> <div style="text-align:left;">
                                                    <?php $yeniid =  $liste['yorum_yapan_id'];
                                                                                $row = $VeriTabaniBaglantisi->prepare("SELECT * FROM members WHERE id=$yeniid ");
                                                                                $row->execute();
                                                                                $goster = $row->fetch(PDO::FETCH_ASSOC);
                                                                                $x = $row->rowCount();
                                                                                if ($x) {
                                                                                    echo $goster['adisoyadi'];
                                                    ?> <img style="height: 50px; width:50px; border-radius:50%; float:left;" src="<?php echo $goster['avatar']; ?>" alt=""> <?php
                                                                                                                            }
                                                                                                                                ?><div>
                                                        <?php echo $liste['yorum']; ?> </div>
                                                    <br>
                                                </div> <?php
                                                                            } ?>







                                        <?php

                                                                        }
                                        ?> </div>
                                </div>
                            </div>
                    </div> <?php
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                        }

                            ?>

<?php } else {
}
?>


        </body>

        </html>