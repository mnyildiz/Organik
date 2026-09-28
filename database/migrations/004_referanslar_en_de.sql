-- Secili veritabanindaki mevcut referanslari EN ve DE icin yayina alir.
-- Eksik ceviri kayitlarini ekler; bos basliklari TR'den doldurur.
-- Mevcut ceviri basliklarini ve ortak logo dosyalarini degistirmez.
-- Tekrar calistirilabilir. Hedef DB, MySQL baglantisinda secilmelidir.

SET NAMES utf8mb4;

INSERT INTO tablo_referanslar_ceviri (KayitID, DilKodu, Baslik, YayinDurumu)
SELECT r.ID, 'en', r.Baslik, 1
FROM tablo_referanslar AS r
LEFT JOIN tablo_referanslar_ceviri AS c ON c.KayitID = r.ID AND c.DilKodu = 'en'
WHERE c.CeviriID IS NULL;

INSERT INTO tablo_referanslar_ceviri (KayitID, DilKodu, Baslik, YayinDurumu)
SELECT r.ID, 'de', r.Baslik, 1
FROM tablo_referanslar AS r
LEFT JOIN tablo_referanslar_ceviri AS c ON c.KayitID = r.ID AND c.DilKodu = 'de'
WHERE c.CeviriID IS NULL;

UPDATE tablo_referanslar_ceviri AS c
INNER JOIN tablo_referanslar AS r ON r.ID = c.KayitID
SET c.Baslik = IF(COALESCE(TRIM(c.Baslik), '') = '', r.Baslik, c.Baslik),
    c.YayinDurumu = 1
WHERE c.DilKodu IN ('en', 'de');

-- Uc dilde de gorunen referans sayisi ayni olmali.
SELECT 'tr' AS DilKodu, COUNT(*) AS ReferansSayisi
FROM tablo_referanslar
UNION ALL
SELECT c.DilKodu, COUNT(*)
FROM tablo_referanslar_ceviri AS c
INNER JOIN tablo_referanslar AS r ON r.ID = c.KayitID
WHERE c.DilKodu IN ('en', 'de') AND c.YayinDurumu = 1
GROUP BY c.DilKodu;
