<?php
require_once('../../Connections/Conn.php');
header('Content-Type: text/plain; charset=UTF-8');

if (!isset($_SESSION['UserID'])) {
    http_response_code(401);
    exit('Oturumunuz sona erdi. Yeniden giriş yapın.');
}

try {
    if (!isset($_FILES['Resimmm']) || $_FILES['Resimmm']['error'] === UPLOAD_ERR_NO_FILE) {
        throw new RuntimeException('Görsel alınamadı. Dosya boyutunu kontrol edip tekrar deneyin.');
    }
    $Resimmm = upload('../../uploads/', 'Resimmm', '');
    echo $SiteURL.'uploads/'.$Resimmm;
} catch (RuntimeException $hata) {
    http_response_code(422);
    echo $hata->getMessage();
}
