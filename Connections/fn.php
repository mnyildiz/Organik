<?php 
$query_rsSeo = "SELECT * FROM tablo_url WHERE Sayfa='anasayfa'";
$rsSeo = mysqli_query($Conn, $query_rsSeo) or die(mysqli_error());
$row_rsSeo = mysqli_fetch_assoc($rsSeo);
$totalRows_rsSeo = mysqli_num_rows($rsSeo);
$Title = $row_rsSeo["Title"];
$Description = $row_rsSeo["Description"];

$v = "?v=5";

$query_rsIletisim = "SELECT * FROM tablo_iletisim_bilgileri";
$rsIletisim = mysqli_query($Conn, $query_rsIletisim) or die(mysqli_error());
$row_rsIletisim = mysqli_fetch_assoc($rsIletisim);
$totalRows_rsIletisim = mysqli_num_rows($rsIletisim);
$row_rsIletisim = i18n_satir_uygula($row_rsIletisim, 'iletisim_bilgileri', true);


$query_rsAyar = "SELECT * FROM tablo_ayarlar";
$rsAyar = mysqli_query($Conn, $query_rsAyar) or die(mysqli_error());
$row_rsAyar = mysqli_fetch_assoc($rsAyar);
$totalRows_rsAyar = mysqli_num_rows($rsAyar);
$row_rsAyar = i18n_satir_uygula($row_rsAyar, 'ayarlar', true);

$query_rsMetinler = "SELECT * FROM tablo_metinler";
$rsMetinler = mysqli_query($Conn, $query_rsMetinler) or die(mysqli_error());
$row_rsMetinler = mysqli_fetch_assoc($rsMetinler);
$totalRows_rsMetinler = mysqli_num_rows($rsMetinler);
$row_rsMetinler = i18n_satir_uygula($row_rsMetinler, 'metinler', true);

$Adres = $row_rsIletisim['Adres'];
$Adres2 = $row_rsIletisim['Adres2'];
$TelNo = $row_rsIletisim['TelNo'];
$FaxNo = $row_rsIletisim['FaxNo'];
$EmailIletisim = $row_rsIletisim['Email'];
$facebook = $row_rsIletisim['Facebook'];
$twitter = $row_rsIletisim['Twitter'];
$youtube = $row_rsIletisim['Youtube'];
$instagram = $row_rsIletisim['Instagram'];
$linkedin = $row_rsIletisim['Linkedin'];
$whatsapp = $row_rsIletisim['Whatsapp'];
$maps = $row_rsIletisim['Maps'];
$maps2 = $row_rsIletisim['Maps2'];


$ResimIletisim = $row_rsIletisim['Resim'];

$Telefon = explode("<br>",$row_rsIletisim['TelNo']);
$Telefon = $Telefon[0];

function upload($dizin, $dosya, $eski, $maxGenislik = 1600, $maxYukseklik = 1600){
    if (!isset($_FILES[$dosya]) || $_FILES[$dosya]['error'] === UPLOAD_ERR_NO_FILE) {
        return isset($_POST[$eski]) ? $_POST[$eski] : '';
    }

    $yukleme = $_FILES[$dosya];
    if ($yukleme['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Görsel yüklenemedi. Dosya boyutunu kontrol edip tekrar deneyin.');
    }
    $tmp = $yukleme['tmp_name'];
    $uzanti = strtolower(pathinfo($yukleme['name'], PATHINFO_EXTENSION));
    $formatlar = array('jpg' => IMAGETYPE_JPEG, 'jpeg' => IMAGETYPE_JPEG, 'png' => IMAGETYPE_PNG, 'gif' => IMAGETYPE_GIF, 'webp' => IMAGETYPE_WEBP);

    if ($uzanti === 'svg') {
        $svg = new DOMDocument();
        if (!@$svg->load($tmp, LIBXML_NONET) || !$svg->documentElement || $svg->documentElement->localName !== 'svg' || $svg->doctype) {
            throw new RuntimeException('Geçerli bir SVG görsel seçin.');
        }
        foreach ($svg->getElementsByTagName('*') as $eleman) {
            if (in_array(strtolower($eleman->localName), array('script', 'foreignobject'), true)) {
                throw new RuntimeException('SVG görsel etkin içerik barındıramaz. PNG olarak yükleyebilirsiniz.');
            }
            foreach ($eleman->attributes as $ozellik) {
                if (stripos($ozellik->name, 'on') === 0 || ($ozellik->localName === 'href' && substr(trim($ozellik->value), 0, 1) !== '#')) {
                    throw new RuntimeException('SVG görsel harici kaynak veya etkin içerik barındıramaz. PNG olarak yükleyebilirsiniz.');
                }
            }
        }
    } else {
        $boyut = @getimagesize($tmp);
        if (!isset($formatlar[$uzanti]) || !$boyut || $boyut[2] !== $formatlar[$uzanti]) {
            throw new RuntimeException('PNG, JPEG, GIF, WebP veya SVG biçiminde bir görsel seçin.');
        }
        $yon = 1;
        if ($boyut[2] === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $exif = @exif_read_data($tmp);
            $yon = isset($exif['Orientation']) ? (int) $exif['Orientation'] : 1;
        }
        $genislik = $boyut[0];
        $yukseklik = $boyut[1];
        if (in_array($yon, array(5, 6, 7, 8), true)) {
            $genislik = $boyut[1];
            $yukseklik = $boyut[0];
        }
        $oran = min(1, $maxGenislik / $genislik, $maxYukseklik / $yukseklik);
        if ($oran < 1) {
            // GD, GIF animasyonunun yalnızca ilk karesini işler; animasyonu bozmayalım.
            if ($boyut[2] === IMAGETYPE_GIF) {
                throw new RuntimeException('GIF görsel en fazla '.$maxGenislik.'×'.$maxYukseklik.' piksel olmalı. Otomatik küçültme için PNG, JPEG veya WebP yükleyin.');
            }
            if (!function_exists('imagecreatefromstring')) {
                throw new RuntimeException('Sunucuda görsel küçültme desteği etkin değil. En fazla '.$maxGenislik.'×'.$maxYukseklik.' piksel bir görsel yükleyin.');
            }
            $genislik = max(1, (int) round($genislik * $oran));
            $yukseklik = max(1, (int) round($yukseklik * $oran));

            // Sıkıştırılmış dosya küçük olsa da GD, açılmış pikseller için bellek kullanır.
            $limit = trim(ini_get('memory_limit'));
            $bellekLimiti = (float) $limit;
            switch (strtolower(substr($limit, -1))) {
                case 'g': $bellekLimiti *= 1024;
                case 'm': $bellekLimiti *= 1024;
                case 'k': $bellekLimiti *= 1024;
            }
            if ($bellekLimiti <= 0) {
                $bellekLimiti = 512 * 1024 * 1024;
            }
            $gerekliBellek = ($boyut[0] * $boyut[1] + $genislik * $yukseklik) * 8 + filesize($tmp) + 16 * 1024 * 1024;
            if ($gerekliBellek + memory_get_usage(true) > $bellekLimiti) {
                throw new RuntimeException('Bu görsel sunucuda küçültülemeyecek kadar büyük. Daha düşük çözünürlüklü bir görsel yükleyin.');
            }

            $kaynak = @imagecreatefromstring(file_get_contents($tmp));
            if (!$kaynak) {
                throw new RuntimeException('Görsel işlenemedi. Farklı bir görsel seçin.');
            }
            $hedef = null;
            try {
                if (in_array($yon, array(2, 5, 7), true)) {
                    imageflip($kaynak, IMG_FLIP_HORIZONTAL);
                } elseif ($yon === 4) {
                    imageflip($kaynak, IMG_FLIP_VERTICAL);
                }
                $acilar = array(3 => 180, 5 => 90, 6 => -90, 7 => -90, 8 => 90);
                if (isset($acilar[$yon])) {
                    $donmus = imagerotate($kaynak, $acilar[$yon], 0);
                    if (!$donmus) {
                        throw new RuntimeException('Görselin yönü düzeltilemedi.');
                    }
                    imagedestroy($kaynak);
                    $kaynak = $donmus;
                }
                $hedef = imagecreatetruecolor($genislik, $yukseklik);
                if (!$hedef) {
                    throw new RuntimeException('Görsel küçültülemedi. Daha düşük çözünürlüklü bir görsel yükleyin.');
                }
                imagealphablending($hedef, false);
                imagesavealpha($hedef, true);
                imagefill($hedef, 0, 0, imagecolorallocatealpha($hedef, 0, 0, 0, 127));
                if (!imagecopyresampled($hedef, $kaynak, 0, 0, 0, 0, $genislik, $yukseklik, imagesx($kaynak), imagesy($kaynak))) {
                    throw new RuntimeException('Görsel küçültülemedi. Farklı bir görsel seçin.');
                }
                switch ($boyut[2]) {
                    case IMAGETYPE_JPEG: $kaydedildi = imagejpeg($hedef, $tmp, 85); break;
                    case IMAGETYPE_PNG: $kaydedildi = imagepng($hedef, $tmp, 6); break;
                    case IMAGETYPE_WEBP: $kaydedildi = function_exists('imagewebp') && imagewebp($hedef, $tmp, 85); break;
                }
                if (!$kaydedildi) {
                    throw new RuntimeException('Küçültülen görsel kaydedilemedi. Tekrar deneyin.');
                }
            } finally {
                imagedestroy($kaynak);
                if ($hedef) {
                    imagedestroy($hedef);
                }
            }
        }
    }

    $yeni_isim = 'resim_'.bin2hex(random_bytes(8)).'.'.$uzanti;
    if (!@move_uploaded_file($tmp, $dizin.$yeni_isim)) {
        throw new RuntimeException('Görsel kaydedilemedi. Yükleme klasörünün yazma iznini kontrol edin.');
    }
    return $yeni_isim;
}

function tarih($tarih){
	$tarih = date("d.m.Y H:i",strtotime($tarih));
	return $tarih;
}
function tarihKisa($tarih){
	$tarih = date("d.m.Y",strtotime($tarih));
	return $tarih;
}
function popupAlert($title,$text,$icon){
	return 'swal({title: "'.$title.'",text: "'.$text.'",icon: "'.$icon.'"});';
}

function mailGonder($kime,$kime_isim,$konu,$icerik){

	global $DOCUMENT_ROOT;
	$smtpAyar = json_decode(file_get_contents("https://statik.webimonline.com/smtpAyarlari.php?ayarCek=true"));
	require_once('smtpmailclass/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	if($smtpAyar->SMTPSecure !=""){
		$mail->SMTPSecure = $smtpAyar->SMTPSecure;
	}
	$mail->Host = $smtpAyar->Host;
	$mail->Username = $smtpAyar->Username;
	$mail->Password = $smtpAyar->Password;
	$mail->Port = $smtpAyar->Port;
	$mail->CharSet = 'UTF-8';
	$mail->AddReplyTo("info@organikik.com", "Organikik.com");
	$mail->SetFrom($smtpAyar->Username, "Organikik.com");
	$mail->AddAddress($kime, $kime_isim);
	$mail->Subject = $konu;
	$mail->MsgHTML($icerik);
	$mail->Send();

}

function birim($Tutar){
 return number_format($Tutar,2);

}

function yonlendir($Location){
  header("Location: ".$Location);
  exit();

}
function url($Sayfa,$ID){
	return url_dil($Sayfa, $ID, dil());
}

function url_dil($Sayfa, $ID, $dilKodu, $turkceFallback = true){
	global $Conn;
	global $SiteURL;
	$query_rsUrl = sprintf("SELECT * FROM tablo_url WHERE Sayfa=%s AND ID=%s",escape($Sayfa,"text"),escape($ID,"int"));
	$rsUrl = mysqli_query($Conn, $query_rsUrl) or die(mysqli_error());
	$row_rsUrl = mysqli_fetch_assoc($rsUrl);
	if (!$row_rsUrl) {
		return $SiteURL;
	}
	if ($dilKodu !== 'tr') {
		$dilEsc = mysqli_real_escape_string($Conn, $dilKodu);
		$urlID = (int) $row_rsUrl['UrlID'];
		$rsCeviriUrl = mysqli_query($Conn, "SELECT * FROM tablo_url_ceviri WHERE UrlID={$urlID} AND DilKodu='{$dilEsc}' AND YayinDurumu=1 LIMIT 1");
		$rowCeviriUrl = $rsCeviriUrl ? mysqli_fetch_assoc($rsCeviriUrl) : null;
		if ($rowCeviriUrl) {
			return $SiteURL.dil_on_eki($dilKodu).$rowCeviriUrl['Link'];
		}
		if (!$turkceFallback) {
			return null;
		}
	}
	return $SiteURL.$row_rsUrl["Link"];
}
function seoURLKaydet($sayfa,$id,$title,$desc){
	
	seoURLSil($sayfa,$id);
	
	global $Conn;
	$query_rsListe = "SELECT * FROM tablo_url";
	$rsListe = mysqli_query($Conn, $query_rsListe);
	$row_rsListe = mysqli_fetch_assoc($rsListe);
	$totalRows_rsListe = mysqli_num_rows($rsListe);
	
	$Urls = array();
	  do { 
			$Urls[] = $row_rsListe['Link'];
	  } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); 

	$link = seoYap($title);
	
	$rsKontrol = mysqli_query($Conn,"SELECT * FROM tablo_url WHERE Link = " . escape($link,"text")."");
	$totalRows_rsKontrol = mysqli_num_rows($rsKontrol);
	if($totalRows_rsKontrol == 0){
		$link = $link;
	}else{
	
		if(in_array($link, $Urls)){
			$sayac = 0;
			while( in_array( ($link . '-' . ++$sayac ), $Urls) );
				$link = $link . '-' . $sayac;
		  }	
	}
	
	
	$insertSQL = "INSERT INTO tablo_url (Link, Sayfa, ID, Title, `Description`) VALUES (".escape($link,"text").",".escape($sayfa,"text").",".escape($id, "int").",".escape($title,"text").",".escape($desc,"text").")";
	mysqli_query($Conn,$insertSQL);
	return $link;
}
function seoURLSil($Sayfa,$ID){
	global $Conn;
	$sayfaEsc = escape($Sayfa,"text");
	$idEsc = escape($ID,"int");
	mysqli_query($Conn, "DELETE c FROM tablo_url_ceviri c INNER JOIN tablo_url u ON u.UrlID=c.UrlID WHERE u.Sayfa={$sayfaEsc} AND u.ID={$idEsc}");
	mysqli_query($Conn, "DELETE FROM tablo_url WHERE Sayfa = ".$sayfaEsc." AND ID = ".$idEsc."");

}

function sehir($ID){
	global $Conn;
	$query_rsDetay = sprintf("SELECT * FROM tablo_sehirler WHERE ID = %s", escape($ID, "int"));
	$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
	$row_rsDetay = mysqli_fetch_assoc($rsDetay);
	$totalRows_rsDetay = mysqli_num_rows($rsDetay);
	return $row_rsDetay["Sehir"];
}
function ilce($ID){
	
	global $Conn;
	$query_rsDetay = sprintf("SELECT * FROM tablo_ilceler WHERE ID = %s", escape($ID, "int"));
	$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
	$row_rsDetay = mysqli_fetch_assoc($rsDetay);
	$totalRows_rsDetay = mysqli_num_rows($rsDetay);
	return $row_rsDetay["Ilce"];
}

function escape($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
  global $Conn;
  $theValue = mysqli_real_escape_string($Conn,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
  }
  return $theValue;
}

 
function seoYap($str, $options = array()){

    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

    $defaults = array(

        'delimiter' => '-',

        'limit' => null,

        'lowercase' => true,

        'replacements' => array(),

        'transliterate' => true

    );

    $options = array_merge($defaults, $options);

    $char_map = array(

        // Latin

        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',

        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',

        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',

        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',

        'ß' => 'ss',

        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',

        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',

        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',

        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',

        'ÿ' => 'y',

        // Latin symbols

        '©' => '(c)',

        // Greek

        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',

        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',

        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',

        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',

        'Ϋ' => 'Y',

        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',

        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',

        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',

        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',

        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

        // Turkish

        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',

        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

        // Russian

        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',

        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',

        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',

        'Я' => 'Ya',

        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',

        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',

        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',

        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',

        'я' => 'ya',

        // Ukrainian

        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',

        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

        // Czech

        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',

        'Ž' => 'Z',

        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',

        'ž' => 'z',

        // Polish

        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',

        'Ż' => 'Z',

        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',

        'ż' => 'z',

        // Latvian

        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',

        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',

        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',

        'š' => 's', 'ū' => 'u', 'ž' => 'z'

    );

    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    if ($options['transliterate']) {

        $str = str_replace(array_keys($char_map), $char_map, $str);

    }

    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

}

function sayfalama($sayfa,$toplam,$onceki,$sonraki,$ayrac=" | ",$max_links=10, $show_page=true){

    global $maxRows_rsListe,$totalRows_rsListe;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($sayfa<=$toplam && $sayfa>=0){

		if ($sayfa > ceil($max_links/2)){

			$fgp = $sayfa - ceil($max_links/2) > 0 ? $sayfa - ceil($max_links/2) : 1;

			$egp = $sayfa + ceil($max_links/2);

			if ($egp >= $toplam){

				$egp = $toplam+1;

				$fgp = $toplam - ($max_links-1) > 0 ? $toplam  - ($max_links-1) : 1;

			}

		}else {

			$fgp = 0;

			$egp = $toplam >= $max_links ? $max_links : $toplam+1;

		}

		if($toplam >= 1) {

			$_get_vars = '';			

			if(!empty($_GET)){
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $sayfa+1;
			$precedente = $sayfa-1;
			$firstArray = ($sayfa > 0) ? "<li class=\"page-item\"><a class=\"page-link\" href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$onceki</a></li>" :  "<li class=\"page-item\"><a class=\"page-link\" href=\"#\">$onceki</a></li>";



			for($a = $fgp+1; $a <= $egp; $a++){

				$theNext = $a-1;

				if($show_page)

				{

					$sayfalink = $a;

				} else {

					$min_l = (($a-1)*$maxRows_rsListe) + 1;

					$max_l = ($a*$maxRows_rsListe >= $totalRows_rsListe) ? $totalRows_rsListe : ($a*$maxRows_rsListe);

					$sayfalink = "$min_l - $max_l";

				}

				$_ss_k = floor($theNext/26);

				if ($theNext != $sayfa)

				{

					$pagesArray .= "<li class=\"page-item\"><a class=\"page-link\"  href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";

					$pagesArray .= "$sayfalink</a></li>" . ($theNext < $egp-1 ? $ayrac : "");

				} else {

					$pagesArray .= "<li class=\"page-item active\" aria-current=\"page\"><a class=\"page-link\" href=\"#\">$sayfalink</a></li>"  . ($theNext < $egp-1 ? $ayrac : "");

				}

			}

			$theNext = $sayfa+1;

			$offset_end = $toplam;

			$lastArray = ($sayfa < $toplam) ? "<li class=\"page-item\"><a class=\"page-link\"  href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$sonraki</a></li>" : "<li class=\"page-item\"><a class=\"page-link\" href=\"#\">$sonraki</a></li>";

		}

	}

	return array($firstArray,$pagesArray,$lastArray);

}

?>
