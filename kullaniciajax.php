<?php
require_once("baglan.php");
if ($_POST) {
    $limit = $_POST['limit'];
    $offset = $_POST['offset'];
    $kullaniciid = $_POST['id'];
    $sayac = 0;
    $paylasim = $VeriTabaniBaglantisi->prepare("SELECT * FROM resimlerson  WHERE resim_paylasan_id=:id ORDER BY resim_id DESC LIMIT $limit OFFSET $offset ");
    $paylasim->execute(["id" => $kullaniciid]);
    $paylasimlar = $paylasim->fetchAll(PDO::FETCH_OBJ);
    if ($paylasim->rowCount()) {
        $sayac = 1;
        foreach ($paylasimlar as $rowYorum) {
?>
            <div id="paylasim">

                <img src="Resimler/<?= $rowYorum->resim_ad ?>" alt="" class='resimboyut'>
                <div id="yazi"><?= $rowYorum->resim_yazi ?></div>
                <a href="yorumlar.php?id=<?php echo $rowYorum->resim_id;  ?>">
                    <div id="yorumlarigor">Tüm Yorumları Görmek İçin Tıkla</div>
                </a>
            </div>
            </div>



            <script>

            </script>
        <?php
        }
    } else { ?>



    <?php }

    ?>





<?php  } else {

    header("Location:index.php");
    exit(); ?>
<?php } ?>