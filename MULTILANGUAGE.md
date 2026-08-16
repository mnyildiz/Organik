# Çoklu dil kurulumu

Bu geliştirme mevcut Türkçe kayıtları değiştirmeden İngilizce (`en`) ve Almanca
(`de`) içerik ekler. Admin panelinin arayüzü Türkçe kalır.

## Kurulum sırası

1. Canlı veritabanının ve `uploads/` klasörünün tam yedeğini alın.
2. Uygulamayı ve veritabanını bir test/staging ortamına kopyalayın.
3. `database/migrations/001_multilanguage.sql` dosyasını staging veritabanında çalıştırın.
4. Güncel PHP dosyalarını staging ortamına yükleyin.
5. Admin panelinden bir içeriği açıp English ve Deutsch sekmelerini doldurun.
6. İçerik ile URL/SEO yayın anahtarlarını açıp kaydedin.
7. `/en` ve `/de` adreslerini, dil seçiciyi ve `sitemap.xml` çıktısını kontrol edin.
8. Kabul testleri tamamlandıktan sonra aynı sırayı canlı ortamda uygulayın.

Not: Paylaşılan şemada `tablo_blog.ID` alanı `AUTO_INCREMENT` değil, ancak mevcut
admin kodu yeni blog kaydında `mysqli_insert_id()` kullanıyor. Canlı veritabanında
`SHOW CREATE TABLE tablo_blog;` sonucu ayrıca kontrol edilmeden bu alana değişiklik
uygulanmamalıdır.

## URL davranışı

- Türkçe mevcut kök URL'leri kullanır: `/blog`, `/haberler`.
- İngilizce `/en/...`, Almanca `/de/...` önekini kullanır.
- Detay içerikleri için her dilde ayrı slug ve SEO metni bulunur.
- Çeviri yayınlanmadığı sürece içerik o dildeki listelerde görünmez.
- Dil seçici, detay çevirisi bulunmuyorsa ilgili dilin liste sayfasına döner.

## Admin kullanımı

- Türkçe alanlar mevcut alanlardır ve çalışma biçimleri değişmemiştir.
- English ve Deutsch sekmeleri yalnızca çevrilebilir metinleri içerir.
- Görseller, tarih, sıralama ve slider seçimi diller arasında ortaktır.
- `Bu dilde içeriği yayınla` kapalıysa kayıt taslak olarak saklanır.
- Site Ayarları ekranındaki yayın anahtarı o dili genel olarak dil seçicide ve
  sitemap içinde görünür hale getirir; içerikler tamamlanmadan açılmamalıdır.
- Başlık girildiğinde boş bırakılan yabancı dil URL'si başlıktan otomatik üretilir.
- Liste ekranlarındaki yeşil EN/DE rozeti çevirinin yayında olduğunu gösterir.

## Kabul kontrolü

- Türkçe URL'ler ve içerikler değişmeden açılıyor.
- `/en` ve `/de` ana sayfaları açılıyor.
- Menü, footer, arama, iletişim ve e-bülten metinleri seçilen dilde.
- Yalnızca yayındaki çeviriler listeleniyor.
- Dil değiştirici aynı içeriğin karşılığına gidiyor.
- `canonical`, `hreflang` ve `html lang` değerleri doğru.
- `/sitemap.xml` üç dildeki yayınlanmış adresleri içeriyor.
- Mobil ve masaüstünde dil seçici menüyle çakışmıyor.
