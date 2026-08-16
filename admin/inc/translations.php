<?php

if (!isset($ACCESS)) {
    die('ERROR!');
}

function admin_ceviri_kaydi($varlik, $kayitID, $dilKodu)
{
    global $Conn;
    $harita = i18n_varliklar();
    if (!isset($harita[$varlik]) || (int) $kayitID < 1) {
        return array();
    }
    $tablo = $harita[$varlik][1];
    $kayitID = (int) $kayitID;
    $dilKodu = mysqli_real_escape_string($Conn, $dilKodu);
    $sonuc = mysqli_query($Conn, "SELECT * FROM `{$tablo}` WHERE KayitID={$kayitID} AND DilKodu='{$dilKodu}' LIMIT 1");
    return $sonuc && mysqli_num_rows($sonuc) ? mysqli_fetch_assoc($sonuc) : array();
}

function admin_cevirileri_kaydet($varlik, $kayitID)
{
    global $Conn;
    $harita = i18n_varliklar();
    if (!isset($harita[$varlik]) || (int) $kayitID < 1 || !isset($_POST['Ceviri'])) {
        return;
    }
    $tablo = $harita[$varlik][1];
    $alanlar = $harita[$varlik][3];
    foreach (array('en', 'de') as $dilKodu) {
        $girdi = isset($_POST['Ceviri'][$dilKodu]) ? $_POST['Ceviri'][$dilKodu] : array();
        $kolonlar = array('KayitID', 'DilKodu');
        $degerler = array(escape($kayitID, 'int'), escape($dilKodu, 'text'));
        $guncellemeler = array();
        foreach ($alanlar as $alan) {
            $kolonlar[] = '`'.$alan.'`';
            $degerler[] = escape(isset($girdi[$alan]) ? $girdi[$alan] : '', 'text');
            $guncellemeler[] = '`'.$alan.'`=VALUES(`'.$alan.'`)';
        }
        $yayinDurumu = isset($girdi['YayinDurumu']) ? 1 : 0;
        $kolonlar[] = 'YayinDurumu';
        $degerler[] = (string) $yayinDurumu;
        $guncellemeler[] = 'YayinDurumu=VALUES(YayinDurumu)';
        $sql = 'INSERT INTO `'.$tablo.'` ('.implode(',', $kolonlar).') VALUES ('.implode(',', $degerler).') ON DUPLICATE KEY UPDATE '.implode(',', $guncellemeler);
        mysqli_query($Conn, $sql) or die(mysqli_error($Conn));
    }
}

function admin_cevirileri_sil($varlik, $kayitID)
{
    global $Conn;
    $harita = i18n_varliklar();
    if (!isset($harita[$varlik])) {
        return;
    }
    $tablo = $harita[$varlik][1];
    mysqli_query($Conn, 'DELETE FROM `'.$tablo.'` WHERE KayitID='.(int) $kayitID);
}

function admin_ceviri_durum_rozetleri($varlik, $kayitID)
{
    foreach (array('en' => 'EN', 'de' => 'DE') as $dilKodu => $etiket) {
        $kayit = admin_ceviri_kaydi($varlik, $kayitID, $dilKodu);
        $sinif = !empty($kayit['YayinDurumu']) ? 'badge-success' : 'badge-secondary';
        echo ' <span class="badge '.$sinif.'">'.$etiket.'</span>';
    }
}

function admin_url_ceviri_kaydi($sayfa, $kayitID, $dilKodu)
{
    global $Conn;
    $sayfaEsc = mysqli_real_escape_string($Conn, $sayfa);
    $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
    $kayitID = (int) $kayitID;
    $sql = "SELECT c.* FROM tablo_url_ceviri c INNER JOIN tablo_url u ON u.UrlID=c.UrlID WHERE u.Sayfa='{$sayfaEsc}' AND COALESCE(u.ID,0)={$kayitID} AND c.DilKodu='{$dilEsc}' LIMIT 1";
    $sonuc = mysqli_query($Conn, $sql);
    return $sonuc && mysqli_num_rows($sonuc) ? mysqli_fetch_assoc($sonuc) : array();
}

function admin_url_ceviri_kaydi_urlid($urlID, $dilKodu)
{
    global $Conn;
    $urlID = (int) $urlID;
    $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
    $sonuc = mysqli_query($Conn, "SELECT * FROM tablo_url_ceviri WHERE UrlID={$urlID} AND DilKodu='{$dilEsc}' LIMIT 1");
    return $sonuc && mysqli_num_rows($sonuc) ? mysqli_fetch_assoc($sonuc) : array();
}

function admin_url_ceviri_durum_rozetleri($urlID)
{
    foreach (array('en' => 'EN', 'de' => 'DE') as $dilKodu => $etiket) {
        $kayit = admin_url_ceviri_kaydi_urlid($urlID, $dilKodu);
        $sinif = !empty($kayit['YayinDurumu']) ? 'badge-success' : 'badge-secondary';
        echo ' <span class="badge '.$sinif.'">'.$etiket.'</span>';
    }
}

function admin_url_cevirilerini_kaydet($sayfa, $kayitID)
{
    global $Conn;
    if (!isset($_POST['CeviriUrl']) || (int) $kayitID < 0) {
        return;
    }
    $sayfaEsc = mysqli_real_escape_string($Conn, $sayfa);
    $kayitID = (int) $kayitID;
    $urlSonuc = mysqli_query($Conn, "SELECT UrlID FROM tablo_url WHERE Sayfa='{$sayfaEsc}' AND COALESCE(ID,0)={$kayitID} ORDER BY UrlID DESC LIMIT 1");
    $urlKaydi = $urlSonuc ? mysqli_fetch_assoc($urlSonuc) : null;
    if (!$urlKaydi) {
        return;
    }
    admin_url_cevirilerini_urlid_ile_kaydet((int) $urlKaydi['UrlID']);
}

function admin_url_cevirilerini_urlid_ile_kaydet($urlID)
{
    global $Conn;
    if (!isset($_POST['CeviriUrl']) || (int) $urlID < 1) {
        return;
    }
    $urlID = (int) $urlID;
    foreach (array('en', 'de') as $dilKodu) {
        $girdi = isset($_POST['CeviriUrl'][$dilKodu]) ? $_POST['CeviriUrl'][$dilKodu] : array();
        $link = isset($girdi['Link']) ? seoYap($girdi['Link']) : '';
        $title = isset($girdi['Title']) ? $girdi['Title'] : '';
        if ($title === '' && isset($_POST['Ceviri'][$dilKodu]['Baslik'])) {
            $title = $_POST['Ceviri'][$dilKodu]['Baslik'];
        }
        if ($link === '' && $title !== '') {
            $link = seoYap($title);
        }
        if ($link !== '') {
            $temelLink = $link;
            $sayac = 1;
            do {
                $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
                $linkEsc = mysqli_real_escape_string($Conn, $link);
                $kontrol = mysqli_query($Conn, "SELECT CeviriID FROM tablo_url_ceviri WHERE DilKodu='{$dilEsc}' AND Link='{$linkEsc}' AND UrlID<>".(int) $urlID.' LIMIT 1');
                $cakisma = $kontrol && mysqli_num_rows($kontrol) > 0;
                if ($cakisma) {
                    $link = $temelLink.'-'.$sayac++;
                }
            } while ($cakisma);
        }
        $icerikYayinda = isset($_POST['Ceviri'][$dilKodu]['YayinDurumu']);
        $yayinDurumu = (isset($girdi['YayinDurumu']) || $icerikYayinda) && $link !== '' ? 1 : 0;
        $sql = sprintf(
            'INSERT INTO tablo_url_ceviri (UrlID,DilKodu,Link,Title,Description,YayinDurumu) VALUES (%s,%s,%s,%s,%s,%s) ON DUPLICATE KEY UPDATE Link=VALUES(Link),Title=VALUES(Title),Description=VALUES(Description),YayinDurumu=VALUES(YayinDurumu)',
            escape($urlID, 'int'),
            escape($dilKodu, 'text'),
            escape($link, 'text'),
            escape($title, 'text'),
            escape(isset($girdi['Description']) ? $girdi['Description'] : '', 'text'),
            escape($yayinDurumu, 'int')
        );
        mysqli_query($Conn, $sql) or die(mysqli_error($Conn));
    }
}

function admin_ceviri_sekmeleri($varlik, $kayitID, $alanTanimlari, $seoSayfasi = null, $seoKayitID = null)
{
    $diller = array('en' => 'English', 'de' => 'Deutsch');
    $benzersiz = preg_replace('/[^a-z0-9_]/i', '', $varlik);
    echo '<div class="card card-secondary mt-4"><div class="card-header"><h3 class="card-title">Yabancı Dil İçerikleri</h3></div><div class="card-body">';
    echo '<ul class="nav nav-tabs" role="tablist">';
    $ilk = true;
    foreach ($diller as $dilKodu => $dilAdi) {
        echo '<li class="nav-item"><a class="nav-link'.($ilk ? ' active' : '').'" data-toggle="tab" href="#'.$benzersiz.'-'.$dilKodu.'">'.$dilAdi.'</a></li>';
        $ilk = false;
    }
    echo '</ul><div class="tab-content pt-3">';
    $ilk = true;
    foreach ($diller as $dilKodu => $dilAdi) {
        $kayit = admin_ceviri_kaydi($varlik, $kayitID, $dilKodu);
        $urlKaydiID = $seoKayitID === null ? $kayitID : $seoKayitID;
        $urlKaydi = $seoSayfasi ? admin_url_ceviri_kaydi($seoSayfasi, $urlKaydiID, $dilKodu) : array();
        echo '<div class="tab-pane fade'.($ilk ? ' show active' : '').'" id="'.$benzersiz.'-'.$dilKodu.'">';
        foreach ($alanTanimlari as $alan => $tanim) {
            $etiket = is_array($tanim) ? $tanim[0] : $tanim;
            $tip = is_array($tanim) && isset($tanim[1]) ? $tanim[1] : 'text';
            $deger = isset($kayit[$alan]) ? $kayit[$alan] : '';
            echo '<div class="form-group"><label>'.$etiket.' ('.$dilAdi.')</label>';
            if ($tip === 'textarea' || $tip === 'editor') {
                echo '<textarea name="Ceviri['.$dilKodu.']['.$alan.']" class="form-control'.($tip === 'editor' ? ' editor' : '').'" rows="'.($tip === 'editor' ? '8' : '3').'">'.htmlspecialchars($deger, ENT_QUOTES, 'UTF-8').'</textarea>';
            } else {
                echo '<input type="text" name="Ceviri['.$dilKodu.']['.$alan.']" class="form-control" value="'.htmlspecialchars($deger, ENT_QUOTES, 'UTF-8').'">';
            }
            echo '</div>';
        }
        if ($seoSayfasi) {
            echo '<hr><h5>SEO ve URL</h5>';
            echo '<div class="form-group"><label>URL ('.$dilAdi.')</label><input type="text" name="CeviriUrl['.$dilKodu.'][Link]" class="form-control" value="'.htmlspecialchars(isset($urlKaydi['Link']) ? $urlKaydi['Link'] : '', ENT_QUOTES, 'UTF-8').'"></div>';
            echo '<div class="form-group"><label>SEO Başlığı ('.$dilAdi.')</label><input type="text" name="CeviriUrl['.$dilKodu.'][Title]" class="form-control" value="'.htmlspecialchars(isset($urlKaydi['Title']) ? $urlKaydi['Title'] : '', ENT_QUOTES, 'UTF-8').'"></div>';
            echo '<div class="form-group"><label>SEO Açıklaması ('.$dilAdi.')</label><textarea name="CeviriUrl['.$dilKodu.'][Description]" class="form-control" rows="3">'.htmlspecialchars(isset($urlKaydi['Description']) ? $urlKaydi['Description'] : '', ENT_QUOTES, 'UTF-8').'</textarea></div>';
            echo '<div class="custom-control custom-switch mb-3"><input type="checkbox" class="custom-control-input" id="url-yayin-'.$benzersiz.'-'.$dilKodu.'" name="CeviriUrl['.$dilKodu.'][YayinDurumu]"'.(!empty($urlKaydi['YayinDurumu']) ? ' checked' : '').'><label class="custom-control-label" for="url-yayin-'.$benzersiz.'-'.$dilKodu.'">Bu dilde URL ve SEO bilgisini yayınla</label></div>';
        }
        echo '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="yayin-'.$benzersiz.'-'.$dilKodu.'" name="Ceviri['.$dilKodu.'][YayinDurumu]"'.(!empty($kayit['YayinDurumu']) ? ' checked' : '').'><label class="custom-control-label" for="yayin-'.$benzersiz.'-'.$dilKodu.'">Bu dilde içeriği yayınla</label></div>';
        echo '</div>';
        $ilk = false;
    }
    echo '</div></div></div>';
}

function admin_url_ceviri_sekmeleri($sayfa, $kayitID = 0, $urlID = null)
{
    $diller = array('en' => 'English', 'de' => 'Deutsch');
    echo '<div class="card card-secondary mt-4"><div class="card-header"><h3 class="card-title">Yabancı Dil URL ve SEO Bilgileri</h3></div><div class="card-body">';
    foreach ($diller as $dilKodu => $dilAdi) {
        $kayit = $urlID ? admin_url_ceviri_kaydi_urlid($urlID, $dilKodu) : admin_url_ceviri_kaydi($sayfa, $kayitID, $dilKodu);
        echo '<fieldset class="border rounded p-3 mb-3"><legend class="w-auto px-2 h6">'.$dilAdi.'</legend>';
        echo '<div class="form-group"><label>URL</label><input type="text" name="CeviriUrl['.$dilKodu.'][Link]" class="form-control" value="'.htmlspecialchars(isset($kayit['Link']) ? $kayit['Link'] : '', ENT_QUOTES, 'UTF-8').'"></div>';
        echo '<div class="form-group"><label>SEO Başlığı</label><input type="text" name="CeviriUrl['.$dilKodu.'][Title]" class="form-control" value="'.htmlspecialchars(isset($kayit['Title']) ? $kayit['Title'] : '', ENT_QUOTES, 'UTF-8').'"></div>';
        echo '<div class="form-group"><label>SEO Açıklaması</label><textarea name="CeviriUrl['.$dilKodu.'][Description]" class="form-control" rows="3">'.htmlspecialchars(isset($kayit['Description']) ? $kayit['Description'] : '', ENT_QUOTES, 'UTF-8').'</textarea></div>';
        echo '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="url-detay-yayin-'.$dilKodu.'" name="CeviriUrl['.$dilKodu.'][YayinDurumu]"'.(!empty($kayit['YayinDurumu']) ? ' checked' : '').'><label class="custom-control-label" for="url-detay-yayin-'.$dilKodu.'">Bu dilde yayınla</label></div>';
        echo '</fieldset>';
    }
    echo '</div></div>';
}
