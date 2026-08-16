<?php

if (!defined('ORGANIK_I18N_LOADED')) {
    define('ORGANIK_I18N_LOADED', true);

    $DesteklenenDiller = array('tr', 'en', 'de');
    $VarsayilanDil = 'tr';

    $hamLink = isset($_GET['Link']) ? trim((string) $_GET['Link'], '/') : '';
    $linkParcalari = $hamLink === '' ? array() : explode('/', $hamLink);
    $ilkParca = count($linkParcalari) > 0 ? strtolower($linkParcalari[0]) : '';

    $Dil = in_array($ilkParca, $DesteklenenDiller, true) ? $ilkParca : $VarsayilanDil;
    if (in_array($ilkParca, $DesteklenenDiller, true)) {
        array_shift($linkParcalari);
    }

    $RouteLink = implode('/', $linkParcalari);
    if ($RouteLink === '') {
        $RouteLink = 'anasayfa';
    }

    $DilOnEki = $Dil === $VarsayilanDil ? '' : $Dil.'/';
    $dilDosyasi = dirname(__DIR__).'/lang/'.$Dil.'.php';
    $DilMetinleri = is_file($dilDosyasi) ? require($dilDosyasi) : array();

    function dil()
    {
        global $Dil;
        return $Dil;
    }

    function dil_on_eki($dilKodu = null)
    {
        global $VarsayilanDil;
        $dilKodu = $dilKodu ?: dil();
        return $dilKodu === $VarsayilanDil ? '' : $dilKodu.'/';
    }

    function t($anahtar, $degiskenler = array())
    {
        global $DilMetinleri;
        $metin = isset($DilMetinleri[$anahtar]) ? $DilMetinleri[$anahtar] : $anahtar;
        foreach ($degiskenler as $isim => $deger) {
            $metin = str_replace('{'.$isim.'}', $deger, $metin);
        }
        return $metin;
    }

    function sayfa_linki($sayfa, $dilKodu = null)
    {
        global $SiteURL, $Conn;
        $dilKodu = $dilKodu ?: dil();
        if ($dilKodu !== 'tr' && $sayfa !== 'anasayfa' && isset($Conn)) {
            $sayfaEsc = mysqli_real_escape_string($Conn, $sayfa);
            $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
            $sonuc = mysqli_query($Conn, "SELECT c.Link FROM tablo_url_ceviri c INNER JOIN tablo_url u ON u.UrlID=c.UrlID WHERE u.Sayfa='{$sayfaEsc}' AND COALESCE(u.ID,0)=0 AND c.DilKodu='{$dilEsc}' AND c.YayinDurumu=1 LIMIT 1");
            $urlCevirisi = $sonuc ? mysqli_fetch_assoc($sonuc) : null;
            if ($urlCevirisi && !empty($urlCevirisi['Link'])) {
                return $SiteURL.dil_on_eki($dilKodu).$urlCevirisi['Link'];
            }
        }
        $rotaAnahtari = 'route.'.$sayfa;
        $rota = t_dil($rotaAnahtari, $dilKodu);
        if ($rota === $rotaAnahtari || $sayfa === 'anasayfa') {
            $rota = $sayfa === 'anasayfa' ? '' : $sayfa;
        }
        return $SiteURL.dil_on_eki($dilKodu).ltrim($rota, '/');
    }

    function route_sayfa_kodu($rota, $dilKodu = null)
    {
        $dilKodu = $dilKodu ?: dil();
        $sayfalar = array('anasayfa', 'hakkimizda', 'referanslar', 'haberler', 'danismanlar', 'blog', 'iletisim', 'kvkk', 'arama');
        foreach ($sayfalar as $sayfa) {
            $beklenen = t_dil('route.'.$sayfa, $dilKodu);
            if ($sayfa === 'anasayfa' && $rota === 'anasayfa') {
                return 'anasayfa';
            }
            if ($beklenen !== 'route.'.$sayfa && trim($beklenen, '/') === trim($rota, '/')) {
                return $sayfa;
            }
        }
        return null;
    }

    function aktif_sayfa_dil_linki($hedefDil, $yalnizMevcut = false)
    {
        global $SayfaKodu, $ID;
        $dinamikSayfalar = array('blog_detay', 'haberler_detay', 'danismanlar_detay', 'hizmetler_detay');
        if (isset($SayfaKodu) && in_array($SayfaKodu, $dinamikSayfalar, true) && isset($ID)) {
            $detayLinki = url_dil($SayfaKodu, $ID, $hedefDil, false);
            if ($detayLinki) {
                return $detayLinki;
            }
            if ($yalnizMevcut) {
                return null;
            }
            $listeSayfalari = array(
                'blog_detay' => 'blog',
                'haberler_detay' => 'haberler',
                'danismanlar_detay' => 'danismanlar',
                'hizmetler_detay' => 'anasayfa'
            );
            return sayfa_linki($listeSayfalari[$SayfaKodu], $hedefDil);
        }
        return sayfa_linki(isset($SayfaKodu) ? $SayfaKodu : 'anasayfa', $hedefDil);
    }

    function t_dil($anahtar, $dilKodu)
    {
        $dosya = dirname(__DIR__).'/lang/'.$dilKodu.'.php';
        $sozluk = is_file($dosya) ? require($dosya) : array();
        return isset($sozluk[$anahtar]) ? $sozluk[$anahtar] : $anahtar;
    }

    function dil_yayinda($dilKodu)
    {
        global $Conn;
        if ($dilKodu === 'tr') {
            return true;
        }
        $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
        $sonuc = mysqli_query($Conn, "SELECT CeviriID FROM tablo_ayarlar_ceviri WHERE DilKodu='{$dilEsc}' AND YayinDurumu=1 LIMIT 1");
        return $sonuc && mysqli_num_rows($sonuc) > 0;
    }

    function i18n_varliklar()
    {
        return array(
            'ayarlar' => array('tablo_ayarlar', 'tablo_ayarlar_ceviri', 'ID', array('Baslik', 'Aciklama')),
            'blog' => array('tablo_blog', 'tablo_blog_ceviri', 'ID', array('Baslik', 'KisaBilgi', 'Detay', 'Kategori')),
            'danismanlar' => array('tablo_danismanlar', 'tablo_danismanlar_ceviri', 'ID', array('Baslik', 'Unvan', 'Veri1', 'Veri2', 'Veri3', 'Veri4', 'Veri5', 'Veri6')),
            'haberler' => array('tablo_haberler', 'tablo_haberler_ceviri', 'ID', array('Baslik', 'KisaBilgi', 'Detay', 'Kategori')),
            'hizmetler' => array('tablo_hizmetler', 'tablo_hizmetler_ceviri', 'ID', array('Baslik', 'Baslik2', 'Veri1', 'Veri2', 'Veri3', 'Veri4', 'Veri5', 'Veri6', 'Veri7', 'Veri8', 'Veri9', 'Veri10', 'Veri11', 'Veri12', 'BaslikTab1', 'BaslikTab2', 'BaslikTab3', 'BaslikTab4', 'BaslikTab5')),
            'iletisim_bilgileri' => array('tablo_iletisim_bilgileri', 'tablo_iletisim_bilgileri_ceviri', 'ID', array('Adres', 'Adres2')),
            'metinler' => array('tablo_metinler', 'tablo_metinler_ceviri', 'ID', array('Metin0', 'Metin1', 'Metin2', 'Metin3', 'Metin4', 'Metin5', 'Metin6', 'Metin7', 'Metin8', 'Metin9', 'Metin10', 'Metin11', 'Metin12', 'Metin13', 'Metin14', 'Metin15')),
            'referanslar' => array('tablo_referanslar', 'tablo_referanslar_ceviri', 'ID', array('Baslik')),
            'sayfalar' => array('tablo_sayfalar', 'tablo_sayfalar_ceviri', 'ID', array('Baslik', 'KisaBilgi', 'Detay', 'Link')),
            'slider' => array('tablo_slider', 'tablo_slider_ceviri', 'ID', array('Baslik', 'Baslik2', 'Detay', 'Link'))
        );
    }

    function i18n_select_sql($varlik, $where = '', $orderBy = '', $limit = '')
    {
        global $Conn;
        $harita = i18n_varliklar();
        if (!isset($harita[$varlik])) {
            throw new InvalidArgumentException('Gecersiz ceviri varligi: '.$varlik);
        }

        list($anaTablo, $ceviriTablo, $idAlani, $alanlar) = $harita[$varlik];
        $sql = 'SELECT b.*';
        if (dil() !== 'tr') {
            foreach ($alanlar as $alan) {
                $sql .= ', c.`'.$alan.'` AS `'.$alan.'`';
            }
        }
        $sql .= ' FROM `'.$anaTablo.'` b';
        if (dil() !== 'tr') {
            $dilKodu = mysqli_real_escape_string($Conn, dil());
            $sql .= ' INNER JOIN `'.$ceviriTablo.'` c ON c.`KayitID` = b.`'.$idAlani.'`';
            $sql .= " AND c.`DilKodu` = '".$dilKodu."' AND c.`YayinDurumu` = 1";
        }
        if ($where !== '') {
            $sql .= ' WHERE '.$where;
        }
        if ($orderBy !== '') {
            $sql .= ' ORDER BY '.$orderBy;
        }
        if ($limit !== '') {
            $sql .= ' LIMIT '.$limit;
        }
        return $sql;
    }

    function i18n_satir_uygula($satir, $varlik, $fallback = true)
    {
        global $Conn;
        if (!$satir || dil() === 'tr') {
            return $satir;
        }
        $harita = i18n_varliklar();
        if (!isset($harita[$varlik])) {
            return $satir;
        }
        list(, $ceviriTablo, $idAlani, $alanlar) = $harita[$varlik];
        if (!isset($satir[$idAlani])) {
            return $satir;
        }
        $kayitID = (int) $satir[$idAlani];
        $dilKodu = mysqli_real_escape_string($Conn, dil());
        $sonuc = mysqli_query($Conn, "SELECT * FROM `{$ceviriTablo}` WHERE `KayitID`={$kayitID} AND `DilKodu`='{$dilKodu}' AND `YayinDurumu`=1 LIMIT 1");
        $ceviri = $sonuc ? mysqli_fetch_assoc($sonuc) : null;
        if (!$ceviri) {
            return $fallback ? $satir : null;
        }
        foreach ($alanlar as $alan) {
            if (array_key_exists($alan, $ceviri)) {
                $satir[$alan] = $ceviri[$alan];
            }
        }
        return $satir;
    }

    function i18n_url_cevirisi($sayfa, $kayitID, $dilKodu = null)
    {
        global $Conn;
        $dilKodu = $dilKodu ?: dil();
        if ($dilKodu === 'tr') {
            return null;
        }
        $sayfaEsc = mysqli_real_escape_string($Conn, $sayfa);
        $dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
        $kayitID = (int) $kayitID;
        $sql = "SELECT c.* FROM tablo_url_ceviri c INNER JOIN tablo_url u ON u.UrlID=c.UrlID WHERE u.Sayfa='{$sayfaEsc}' AND COALESCE(u.ID,0)={$kayitID} AND c.DilKodu='{$dilEsc}' AND c.YayinDurumu=1 LIMIT 1";
        $sonuc = mysqli_query($Conn, $sql);
        return $sonuc ? mysqli_fetch_assoc($sonuc) : null;
    }
}
