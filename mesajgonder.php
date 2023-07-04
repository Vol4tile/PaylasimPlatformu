<?php
require_once("baglan.php");

?>
<?php
if (isset($_GET['mesajgonder'])) {
    if (isset($_GET['uye'])) {
        $uyebilgisi = $_GET['uye'];
    } else {
        $uyebilgisi = "";
    }
    $mesaj = Filtre($_GET['mesaj']);

    if (!$uyebilgisi || !$mesaj) {
        echo "Lütfen boş bırakmayınız";
        echo '<meta http-equiv="refresh" content="1;URL=main.php">';
    } else {
        $mesajekleme = $VeriTabaniBaglantisi->prepare("INSERT INTO mesaj SET atan_id =$id,gelen_id=:gonderilen,mesaj_yazi=:mesaj ");
        $mesajekleme->execute([':gonderilen' => $uyebilgisi, ':mesaj' => $mesaj]);
        if ($mesajekleme) {
            echo 'Mesaj gönderildi';
            echo '<meta http-equiv="refresh" content="1;URL=main.php">';
        } else {
            echo 'sorun';
        }
    }
} ?>