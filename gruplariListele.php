<?php

require_once("baglan.php");
$row = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup ORDER BY grup_id DESC");
$row->execute();
$goster = $row->fetchAll(PDO::FETCH_ASSOC);
$x = $row->rowCount();

if ($x) {
    foreach ($goster as $liste) { ?>

        <div class="liste" style=" word-wrap: break-word;   overflow:hidden; height:auto; padding:0px;margin:0px; padding-bottom:15px;">
            <img src="Resimler/<?php echo $liste['grup_resmi']; ?>" alt="proflresmi" style="width:50%; height:auto; max-height:300px;  ">
            <p style="  height:20px;"> <?php echo  $liste['grup_adi']; ?></p>
            <p style=" height:20px;"> <?php echo  $liste['grup_aciklamasi']; ?></p>
            <div class="join" style=" height:20px; " onclick="fun(<?php echo $liste['grup_id']; ?>,this)">
                <?php
                $grup = $liste['grup_id'];

                $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_uyelik WHERE uye_id=:id AND grup_id= $grup  ");
                $yorumlar->execute(["id" =>  $id]);
                $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);

                if (isset($yorum[0]->uyelik_durum)) {
                    $durum = $yorum[0]->uyelik_durum;
                } else {
                    $durum = -1;
                }
                if ($yorumlar->rowCount()) {

                    if ($durum == 1) {
                        echo 'Gruba katıldın';
                    } elseif ($durum == 0) {
                        echo  'Gruba katılma isteği gönderildi';
                    } else {
                        echo 'Başvurun reddedildi';
                    }
                } else {
                    echo 'gruba katil';
                }


                ?>
                <hr>
            </div>
        </div> <?php
            }
        }

                ?>