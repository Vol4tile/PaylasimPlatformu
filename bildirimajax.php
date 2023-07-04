<?php
require_once("baglan.php");
if ($_POST) {

    $grupkurucusu = $_POST['data'];
    $bildirim = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup WHERE  grup_kurucusu=$grupkurucusu");
    $bildirim->execute();
    $bildiri = $bildirim->fetchAll(PDO::FETCH_OBJ);


    if ($bildirim->rowCount()) {
        foreach ($bildiri as $bildiri) {
            $grubum =  $bildiri->grup_id;

            $grup = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup_uyelik WHERE  grup_id=$grubum");
            $grup->execute();
            $gr = $grup->fetchAll(PDO::FETCH_OBJ);


            if ($grup->rowCount()) {
                foreach ($gr as $gr) {
                    $result = (array)json_decode($gr->uye_id);
                    $uyelikno = $gr->uyelik_id;
                    $uyedurum = $gr->uyelik_durum;
                    $y = $result[0];

                    $us = $VeriTabaniBaglantisi->prepare("SELECT * FROM members Where id=$y ");
                    $us->execute();
                    $uks = $us->rowCount();
                    $uyebilgi = $us->fetch(PDO::FETCH_ASSOC);

                    $sonuc = (array)json_decode($gr->grup_id);
                    $c = $sonuc[0];
                    $yt = $VeriTabaniBaglantisi->prepare("SELECT * FROM grup Where grup_id=$c ");
                    $yt->execute();
                    $z = $yt->rowCount();
                    $uyebilgis = $yt->fetch(PDO::FETCH_ASSOC);


                    $uyeninadi = $uyebilgi["adisoyadi"];
                    $uyeninkuladi = $uyebilgi["kullaniciadi"];
                    $grupbilgisi = $uyebilgis['grup_adi'];

                    if ($uyedurum == 0) {

?>
                        <div>
                            <div><?php echo  $uyeninadi; ?>
                                (@<?php echo  $uyeninkuladi; ?>) adlı kullanıcı
                                <?php echo  $grupbilgisi; ?>grubuna katılmak istiyor. <span class="kabulet" onclick="kabulet(<?php echo $uyelikno; ?>)" style="color:green; cursor:pointer;">Kabul Et</span> <span class="kabulet" onclick="ret(<?php echo $uyelikno; ?>)" style="color:red; cursor:pointer;">Reddet</span></div>
                        </div>
                        <script src="jquery.js"></script>
                        <script>
                            $(".kabulet").on('click', function() {
                                $(this).parent().remove()
                            })
                        </script>
    <?php
                    }
                }
            }
        }
    }

    ?> <div style="position:absolute; bottom:0px; right:0px; color:brown; cursor:pointer;" onclick="kapat()">Kapat</div> <?php









                                                                                                                        }
