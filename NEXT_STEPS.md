# Organik Çoklu Dil — Sıradaki Adımlar

Bu belge, PHP veya MySQL bilmeden çoklu dil geliştirmesini güvenli şekilde test
etmek ve daha sonra canlıya almak için izlenecek adımları açıklar.

> Önemli: İlk denemeyi doğrudan canlı sitede yapmayın. Önce sitenin bir test
> kopyasını (staging) kuracağız. Bir sorun çıkarsa canlı site etkilenmeyecek.

## 1. Elimizde bulunması gerekenler

Başlamadan önce aşağıdakilerin hazır olduğunu kontrol edin:

- Sitenin bu repodaki kaynak kodları.
- Canlı MySQL veritabanının tam `.sql` yedeği.
- Canlı sunucudaki kök `uploads/` klasörünün tamamı.
- Hosting paneli veya sunucu erişimi.
- phpMyAdmin erişimi ya da MySQL kullanıcı bilgileri.
- Staging için bir alt alan adı. Örnek: `test.organikik.com.tr`.

Tam veritabanı yedeğini GitHub'a veya başka bir herkese açık Git deposuna
yüklemeyin. İçinde admin hesabı, iletişim mesajları ve e-bülten e-postaları
bulunabilir.

## 2. Güncel yedek alınması

Canlı sistemde işlem yapmadan hemen önce iki ayrı yedek alın:

1. MySQL veritabanının tam yedeği.
2. Canlı web sitesi klasörünün, özellikle `uploads/` klasörünün yedeği.

Yedek dosyalarını tarih ekleyerek adlandırmak yararlı olur:

```text
organik-db-2026-08-16.sql
organik-files-2026-08-16.zip
```

Yedekleri web sitesinin herkese açık klasöründe bırakmayın. Bilgisayarınızda
veya güvenli bir yedek alanında saklayın.

## 3. Staging sitesi kurulması

Staging, canlı sitenin yalnızca test amacıyla kullanılan kopyasıdır.

Hosting panelinde mümkünse şu şekilde bir alt alan adı oluşturun:

```text
test.organikik.com.tr
```

Staging sitesi için:

1. Canlı site dosyalarının bir kopyasını staging klasörüne yükleyin.
2. Canlı `uploads/` klasörünü staging sitesine kopyalayın.
3. Staging için ayrı bir MySQL veritabanı oluşturun.
4. Canlı veritabanı yedeğini bu test veritabanına aktarın.
5. Staging sitesini mümkünse parola korumalı yapın.
6. Arama motorlarının staging sitesini indekslemesini engelleyin.

Staging sitesi canlı veritabanını kullanmamalıdır. Yanlışlıkla canlı
veritabanına bağlanırsa test sırasında canlı içerikler değişebilir.

## 4. Staging veritabanının hazırlanması

### phpMyAdmin ile yeni test veritabanı oluşturma

Hosting panelinde phpMyAdmin kullanılıyorsa:

1. Hosting panelinden yeni bir MySQL veritabanı oluşturun.
2. Örnek veritabanı adı: `organik_staging`.
3. Bu veritabanı için ayrı bir kullanıcı ve güçlü parola oluşturun.
4. Kullanıcıya yalnızca `organik_staging` veritabanı için yetki verin.
5. phpMyAdmin'e girin.
6. Sol menüden `organik_staging` veritabanını seçin.
7. Üst menüden **İçe Aktar / Import** bölümüne girin.
8. Canlı sistemden aldığınız tam `.sql` yedeğini seçin.
9. Biçimi `SQL`, karakter setini mümkünse `utf8mb4` seçin.
10. **Git / Go** düğmesine basın ve işlem tamamlanana kadar bekleyin.

İşlem sonunda phpMyAdmin sol menüsünde `tablo_blog`, `tablo_haberler`,
`tablo_hizmetler` gibi tablolar görünmelidir.

## 5. `tablo_blog` kontrolü

Paylaşılan şemada `tablo_blog.ID` alanı `AUTO_INCREMENT` görünmüyor. Mevcut
admin kodu ise yeni blog kaydı eklerken bu özelliğe güveniyor.

phpMyAdmin içinde:

1. `organik_staging` veritabanını seçin.
2. Üst menüden **SQL** sekmesine girin.
3. Aşağıdaki sorguyu yapıştırıp çalıştırın:

```sql
SHOW CREATE TABLE tablo_blog;
```

Sonuçta `ID` satırında `AUTO_INCREMENT` yazıp yazmadığını kontrol edin. Sonucu
not alın veya ekran görüntüsünü paylaşın. Bu kontrol yapılmadan `tablo_blog`
yapısını değiştirmeyin.

## 6. Çoklu dil tablolarının kurulması

Çoklu dil için hazırlanan dosya:

```text
database/migrations/001_multilanguage.sql
```

Bu dosya mevcut Türkçe kayıtları silmez veya değiştirmez. İngilizce ve Almanca
karşılıklar için 11 yeni tablo oluşturur.

phpMyAdmin üzerinden çalıştırmak için:

1. Sol menüden yalnızca `organik_staging` veritabanını seçin.
2. Üst menüden **İçe Aktar / Import** bölümüne girin.
3. `database/migrations/001_multilanguage.sql` dosyasını seçin.
4. Biçimin `SQL` olduğunu kontrol edin.
5. **Git / Go** düğmesine basın.
6. Başarılı mesajını bekleyin.

İşlemden sonra aşağıdaki tablolardan bazılarını sol menüde görmelisiniz:

```text
tablo_blog_ceviri
tablo_haberler_ceviri
tablo_danismanlar_ceviri
tablo_hizmetler_ceviri
tablo_metinler_ceviri
tablo_slider_ceviri
tablo_url_ceviri
```

Bir hata mesajı çıkarsa aynı işlemi tekrar tekrar çalıştırmayın. Hata metnini
tam olarak kaydedip paylaşın.

## 7. Staging bağlantı ayarları

Staging sitesinin veritabanı bağlantısı şu dosyada bulunur:

```text
Connections/Conn.php
```

Staging kopyasında şu değerlerin staging veritabanını gösterdiğinden emin olun:

```php
$hostname_Conn = "localhost";
$database_Conn = "organik_staging";
$username_Conn = "STAGING_KULLANICISI";
$password_Conn = "STAGING_PAROLASI";
```

Site ve admin adresleri de staging alan adını göstermelidir:

```php
$AdminURL = "https://test.organikik.com.tr/admin/";
$SiteURL = "https://test.organikik.com.tr/";
```

Bu örnek kullanıcı adı ve parolayı aynen kullanmayın; hosting panelinin verdiği
gerçek staging bilgilerini yazın. Gerçek parolayı Git'e kaydetmeyin.

Canlı `Connections/Conn.php` dosyasını staging bilgileriyle değiştirip yanlışlıkla
canlıya yüklemeyin. Staging ve canlı bağlantı dosyaları ayrı tutulmalıdır.

## 8. Güncel kodların staging sitesine yüklenmesi

Migration başarıyla tamamlandıktan sonra bu repodaki güncel dosyaları staging
sitesine yükleyin.

Özellikle şu yeni dosya ve klasörlerin yüklendiğini kontrol edin:

```text
Connections/i18n.php
admin/inc/translations.php
lang/tr.php
lang/en.php
lang/de.php
database/migrations/001_multilanguage.sql
sitemap.php
```

Ayrıca değişen `index.php`, `web.config`, `Connections/fn.php`, `admin/`,
`pages/`, `inc/` ve `css/main.css` dosyaları da yüklenmelidir.

`database/migrations/` klasörünün web üzerinden erişilebilir olması zorunlu
değildir. Güvenlik açısından migration dosyaları kurulumdan sonra herkese açık
web klasörünün dışında tutulabilir.

## 9. Önce Türkçe sitenin kontrol edilmesi

Henüz İngilizce ve Almanca yayınlamadan önce Türkçe siteyi kontrol edin:

- Ana sayfa açılıyor mu?
- Menü bağlantıları çalışıyor mu?
- Hakkımızda sayfası açılıyor mu?
- Hizmet detayları açılıyor mu?
- Blog ve haber listeleri açılıyor mu?
- Danışman detayları açılıyor mu?
- Referanslar ve iletişim sayfası açılıyor mu?
- Görseller ve videolar yükleniyor mu?
- Admin paneline giriş yapılabiliyor mu?

Türkçe tarafta hata varsa yabancı dil içerik girişine geçmeyin.

## 10. Admin panelinde İngilizce ve Almanca içerik girilmesi

Admin panelinin kendisi Türkçe kalır. İçerik düzenleme ekranlarında English ve
Deutsch sekmeleri bulunur.

Örneğin bir blog kaydında:

1. Admin panelinden **İçerikler → Blog** bölümüne girin.
2. Var olan bir blog kaydını açın.
3. Mevcut Türkçe alanların altında **Yabancı Dil İçerikleri** kutusunu bulun.
4. **English** sekmesini açın.
5. İngilizce başlık, kısa bilgi ve detay metnini girin.
6. İngilizce URL, SEO başlığı ve SEO açıklamasını girin.
7. **Bu dilde içeriği yayınla** seçeneğini açın.
8. **Kaydet** düğmesine basın.
9. Aynı işlemi **Deutsch** sekmesi için yapın.

Görsel, tarih, sıra ve slider seçimi ortak alanlardır; her dil için tekrar
yüklenmeleri gerekmez.

URL alanı boş bırakılırsa sistem başlıktan bir adres üretmeye çalışır. Yine de
SEO açısından URL'yi kontrol ederek kaydetmeniz önerilir.

Admin liste ekranlarındaki rozetler:

- Yeşil `EN`: İngilizce çeviri yayında.
- Gri `EN`: İngilizce çeviri eksik veya taslak.
- Yeşil `DE`: Almanca çeviri yayında.
- Gri `DE`: Almanca çeviri eksik veya taslak.

## 11. Statik sayfaların URL ve SEO bilgileri

Admin sol menüsünde **Sayfa URL ve SEO** bölümü bulunur.

Bu bölümden aşağıdaki sayfaların İngilizce ve Almanca URL/SEO karşılıklarını
girin:

- Ana sayfa
- Hakkımızda
- Referanslar
- Haberler
- Danışmanlar
- Blog
- İletişim
- KVK/Gizlilik sayfası

Örnekler:

```text
Türkçe:    /hakkimizda
İngilizce: /en/about-us
Almanca:   /de/uber-uns
```

```text
Türkçe:    /iletisim
İngilizce: /en/contact
Almanca:   /de/kontakt
```

## 12. Bir dili genel olarak yayına açma

İngilizce veya Almanca içeriklerin önemli bölümü tamamlanmadan dili genel olarak
yayına açmayın.

Hazır olduğunda:

1. Admin panelinden **Site Ayarları** bölümüne girin.
2. English sekmesindeki temel bilgileri ve ana sayfa SEO bilgilerini doldurun.
3. English için **Bu dilde içeriği yayınla** seçeneğini açın.
4. Kaydedin.
5. Almanca hazırsa aynı işlemi Deutsch sekmesinde yapın.

Site Ayarları'ndaki yayın seçeneği açılınca ilgili dil:

- Header'daki dil seçicide görünür.
- `hreflang` etiketlerine eklenir.
- Sitemap içinde görünür.

Doğrudan `/en` ve `/de` adresleri staging testleri için yayın anahtarı açılmadan
da denenebilir.

## 13. Test edilecek adresler

Staging alan adınıza göre şu adresleri kontrol edin:

```text
https://test.organikik.com.tr/
https://test.organikik.com.tr/en
https://test.organikik.com.tr/de
https://test.organikik.com.tr/en/blog
https://test.organikik.com.tr/de/blog
https://test.organikik.com.tr/en/contact
https://test.organikik.com.tr/de/kontakt
https://test.organikik.com.tr/sitemap.xml
```

Her sayfada aşağıdakileri kontrol edin:

- Dil seçici doğru dili işaretliyor mu?
- Dil değiştirince aynı içeriğin karşılığı açılıyor mu?
- Menü ve footer seçilen dile çevriliyor mu?
- Yalnızca yayınlanmış çeviriler görünüyor mu?
- Görseller doğru açılıyor mu?
- Mobil ekranda dil seçici menüyle çakışıyor mu?
- Arama seçilen dildeki içerikleri buluyor mu?
- İletişim formu çalışıyor mu?
- E-bülten formu doğru mesajı gösteriyor mu?

## 14. SEO kontrolü

Tarayıcıda sayfa kaynağını açıp aşağıdakileri kontrol edin:

```html
<html lang="en">
<link rel="canonical" ...>
<link rel="alternate" hreflang="tr" ...>
<link rel="alternate" hreflang="en" ...>
<link rel="alternate" hreflang="de" ...>
```

Her dilde sayfa başlığı ve meta açıklaması o dilde olmalıdır. İngilizce sayfada
Türkçe SEO başlığı görülüyorsa **Sayfa URL ve SEO** bölümündeki çeviri eksiktir.

`/sitemap.xml` adresinde yalnızca yayındaki Türkçe, İngilizce ve Almanca
adresler bulunmalıdır.

## 15. PHP hata kontrolü

Sunucuda komut satırı erişimi varsa değişen PHP dosyalarında sözdizimi kontrolü
yapılmalıdır:

```bash
php -l index.php
php -l Connections/i18n.php
php -l admin/inc/translations.php
php -l sitemap.php
```

Her komutun sonunda `No syntax errors detected` mesajı beklenir.

Yerel geliştirme ortamında PHP/MySQL bulunmadığı için bu kontrol ve gerçek
veritabanı testi staging sunucusunda yapılacaktır.

## 16. Canlıya geçiş

Staging testlerinin tamamı başarılı olduktan sonra:

1. Canlı veritabanı ve dosyaların tekrar güncel yedeğini alın.
2. Mümkünse kısa bir bakım zamanı belirleyin.
3. Canlı veritabanında `001_multilanguage.sql` migration dosyasını çalıştırın.
4. Güncel kod dosyalarını canlı sunucuya yükleyin.
5. Canlı `Connections/Conn.php` dosyasının canlı veritabanı ve canlı URL
   bilgilerini kullandığını kontrol edin.
6. Önce Türkçe siteyi hızlıca test edin.
7. Admin paneline girip örnek EN/DE içerikleri kontrol edin.
8. `/en`, `/de` ve `/sitemap.xml` adreslerini kontrol edin.
9. Hata kayıtlarını ve iletişim/e-bülten formlarını takip edin.

Canlıya yüklerken staging veritabanı parolasını veya staging URL'sini canlı
`Connections/Conn.php` içine taşımayın.

## 17. Sorun çıkarsa geri dönüş

Canlıya geçişte önemli bir hata oluşursa:

1. Yeni kod dosyalarını yayından kaldırın.
2. Canlı sitenin işlem öncesi dosya yedeğini geri yükleyin.
3. Gerekirse işlem öncesi MySQL yedeğini geri yükleyin.
4. Hata mesajlarını, ilgili URL'yi ve yapılan son işlemi kaydedin.

Yeni çeviri tabloları mevcut Türkçe tabloları değiştirmediği için yalnızca eski
kod dosyalarına dönmek çoğu durumda Türkçe siteyi tekrar çalıştırır. Yine de tam
veritabanı yedeği olmadan canlı migration uygulanmamalıdır.

## Kısa kontrol listesi

- [ ] Canlı veritabanı yedeği alındı.
- [ ] Canlı dosya ve `uploads/` yedeği alındı.
- [ ] Ayrı staging veritabanı oluşturuldu.
- [ ] Tam veritabanı yedeği staging'e aktarıldı.
- [ ] `SHOW CREATE TABLE tablo_blog` sonucu kontrol edildi.
- [ ] Çoklu dil migration'ı staging'de çalıştırıldı.
- [ ] Güncel kodlar staging'e yüklendi.
- [ ] Türkçe site regresyon testi tamamlandı.
- [ ] Örnek İngilizce içerik girilip yayınlandı.
- [ ] Örnek Almanca içerik girilip yayınlandı.
- [ ] Menü, arama, iletişim ve e-bülten test edildi.
- [ ] Mobil görünüm kontrol edildi.
- [ ] SEO etiketleri ve sitemap kontrol edildi.
- [ ] Canlıya geçmeden önce yeniden yedek alındı.
- [ ] Canlı yayın sonrası hızlı kontrol tamamlandı.

