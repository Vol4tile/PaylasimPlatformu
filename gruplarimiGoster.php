<?php

require_once("baglan.php");

if ($_POST) {

    $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_uyelik WHERE uye_id=:id ORDER BY uyelik_id DESC");
    $yorumlar->execute(["id" =>  $id]);
    $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
    $x = $yorumlar->rowCount();

    if ($x) {

        foreach ($yorum as $yas) {
            $uyeid = $yas->uye_id;
            $grupid = $yas->grup_id;
            $grup_durum = $yas->uyelik_durum;
            if ($uyeid == $id) {
                $yorumlar = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup WHERE grup_id=:id");
                $yorumlar->execute(["id" =>  $grupid]);
                $yorum = $yorumlar->fetchAll(PDO::FETCH_OBJ);
                $x = $yorumlar->rowCount();
                if ($x) {
                    foreach ($yorum as $yas) {
                        if ($grup_durum == 1) {
?>
                            <div class="grup_sayfasi" style="height:auto; border-bottom:1px solid black; box-sizing:border-box; margin-bottom:5px;" id="<?php echo $yas->grup_id ?>">
                                <div style=""><img src="Resimler/<?php echo $yas->grup_resmi ?>" alt="" style="width:50%; height:auto; max-height:300px;"></div>
                                <div style="height:50px;"><?php echo $yas->grup_adi ?></div>
                            </div>



<?php }
                    }
                }
            }
        }
    } else {
        echo 'sorun var';
    }
}
?>