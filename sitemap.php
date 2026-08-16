<?php
require_once('Connections/Conn.php');

header('Content-Type: application/xml; charset=UTF-8');

$adresler = array();
$statikSayfalar = array('anasayfa', 'hakkimizda', 'referanslar', 'haberler', 'danismanlar', 'blog', 'iletisim', 'kvkk');
foreach ($DesteklenenDiller as $dilKodu) {
    if (!dil_yayinda($dilKodu)) {
        continue;
    }
    foreach ($statikSayfalar as $sayfa) {
        $adresler[] = sayfa_linki($sayfa, $dilKodu);
    }
}

$urlSonucu = mysqli_query($Conn, 'SELECT * FROM tablo_url WHERE ID IS NOT NULL');
if ($urlSonucu) {
    while ($urlKaydi = mysqli_fetch_assoc($urlSonucu)) {
        if (!empty($urlKaydi['Link'])) {
            $adresler[] = $SiteURL.$urlKaydi['Link'];
        }
        $ceviriSonucu = mysqli_query($Conn, 'SELECT DilKodu, Link FROM tablo_url_ceviri WHERE UrlID='.(int) $urlKaydi['UrlID'].' AND YayinDurumu=1');
        if ($ceviriSonucu) {
            while ($ceviri = mysqli_fetch_assoc($ceviriSonucu)) {
                if (!empty($ceviri['Link'])) {
                    $adresler[] = $SiteURL.dil_on_eki($ceviri['DilKodu']).$ceviri['Link'];
                }
            }
        }
    }
}

$adresler = array_values(array_unique($adresler));
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($adresler as $adres) { ?>
  <url><loc><?php echo htmlspecialchars($adres, ENT_XML1 | ENT_QUOTES, 'UTF-8'); ?></loc></url>
<?php } ?>
</urlset>
