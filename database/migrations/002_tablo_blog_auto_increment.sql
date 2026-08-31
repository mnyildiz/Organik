-- tablo_blog.ID alanina AUTO_INCREMENT ekler.
-- Admin paneli yeni blog kaydinda mysqli_insert_id() kullandigi icin gereklidir.
--
-- Calistirmadan once:
--   SELECT ID, Baslik FROM tablo_blog WHERE ID <= 0;
-- sorgusu BOS donmelidir. ID=0 olan satir varsa ALTER o satirin ID'sini
-- degistirir ve tablo_url baglantisi kopar; once o satir elle duzeltilmelidir.
--
-- Mevcut satirlar ve ID degerleri degismez. AUTO_INCREMENT sayaci
-- otomatik olarak MAX(ID)+1 degerinden baslar.

ALTER TABLE `tablo_blog` MODIFY `ID` INT NOT NULL AUTO_INCREMENT;
