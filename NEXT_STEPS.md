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

### Komut satırı (cmd) ile yedek ve geri yükleme

Sunucuda phpMyAdmin yoksa aynı işlemler `mysqldump` ve `mysql` komutlarıyla
yapılır. Komutlar **cmd.exe** içinde (yönetici olarak) çalıştırılır.
`-p` parametresi parolayı sorar; parolayı komuta yazmayın.

MySQL'in `bin` klasörünü bulun (`where mysqldump` veya services.msc →
MySQL servisi → Path to executable) ve o klasöre geçin:

```cmd
cd /d "C:\Program Files\MySQL\MySQL Server 8.0\bin"
```

Canlı veritabanı yedeği (`--result-file` kullanın; PowerShell'de `>` ile
yönlendirme Türkçe karakterleri bozar):

```cmd
mkdir C:\Yedek
mysqldump -u root -p --default-character-set=utf8 --single-transaction --routines --triggers --result-file=C:\Yedek\organik-db-2026-08-30.sql organik
```

Dosya yedeği ve test klasörüne kopya:

```cmd
robocopy C:\WebSites\organik C:\Yedek\organik-files-2026-08-30 /E
robocopy C:\WebSites\organik C:\WebSites\organik_test /E
```

Test veritabanı ve kullanıcısı (önce `SHOW CREATE DATABASE organik;` ile
canlının karakter setini görüp aynısını kullanın):

```cmd
mysql -u root -p -e "CREATE DATABASE organik_staging CHARACTER SET utf8 COLLATE utf8_general_ci;"
mysql -u root -p -e "CREATE USER 'organik_test'@'localhost' IDENTIFIED BY 'TEST_PAROLASI_BURAYA'; GRANT ALL PRIVILEGES ON organik_staging.* TO 'organik_test'@'localhost'; FLUSH PRIVILEGES;"
```

Parolayı `Connections/Conn.php` test bloğundaki değerle aynı yapın.

Yedeği test veritabanına geri yükleme ve migration:

```cmd
mysql -u root -p --default-character-set=utf8 organik_staging < C:\Yedek\organik-db-2026-08-30.sql
mysql -u root -p --default-character-set=utf8 organik_staging < C:\WebSites\organik_test\database\migrations\001_multilanguage.sql
```

Doğrulama:

```cmd
mysql -u root -p -e "SELECT COUNT(*) FROM tablo_blog;" organik
mysql -u root -p -e "SELECT COUNT(*) FROM tablo_blog;" organik_staging
mysql -u root -p -e "SHOW TABLES LIKE '%ceviri';" organik_staging
mysql -u organik_test -p -e "SELECT 1;" organik_staging
```

İlk iki sayı eşit olmalı; üçüncü komut 11 `_ceviri` tablosu listelemeli.

Site açılınca `caching_sha2_password` hatası görülürse:

```cmd
mysql -u root -p -e "ALTER USER 'organik_test'@'localhost' IDENTIFIED WITH mysql_native_password BY 'TEST_PAROLASI_BURAYA';"
```

## 5. `tablo_blog` AUTO_INCREMENT düzeltmesi

Canlı veritabanı yedeğinde doğrulandı (30 Ağustos 2026): `tablo_blog.ID`
alanında `AUTO_INCREMENT` yok; diğer tüm tablolarda var. Admin paneli yeni
blog eklerken bu özelliğe güvendiği için düzeltilmesi gerekir. Bu sorun çoklu
dil geliştirmesinden bağımsızdır ancak blog çevirileri kayıt ID'sine bağlandığı
için çoklu dil için de zorunludur.

Düzeltme dosyası:

```text
database/migrations/002_tablo_blog_auto_increment.sql
```

Önce staging'de kontrol edin (üç komut, tek tek):

```cmd
mysql -u root -p -e "SELECT @@sql_mode;" organik_staging
mysql -u root -p -e "SELECT MIN(ID), MAX(ID), COUNT(*) FROM tablo_blog;" organik_staging
mysql -u root -p -e "SELECT ID, Baslik FROM tablo_blog WHERE ID <= 0;" organik_staging
```

Üçüncü sorgu **boş** dönmelidir. `ID = 0` olan bir satır varsa önce o satıra
uygun bir ID verilmeli ve `tablo_url` içindeki karşılığı da güncellenmelidir;
aksi halde ALTER o satırın ID'sini değiştirir ve linki kopar.

Kontrol temizse staging'de çalıştırın:

```cmd
mysql -u root -p --default-character-set=utf8 organik_staging < C:\WebSites\organik_test\database\migrations\002_tablo_blog_auto_increment.sql
mysql -u root -p -e "SHOW CREATE TABLE tablo_blog\G" organik_staging
```

İkinci komutun çıktısında `ID` satırında `AUTO_INCREMENT` görünmelidir. Sonra
test sitesinin admin panelinden yeni bir blog yazısı ekleyip listede
göründüğünü doğrulayın.

Canlıya geçişte (§16) bu dosya `001_multilanguage.sql` ile birlikte
çalıştırılır.

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

## 6a. Hazır EN/DE içerik çevirilerinin yüklenmesi (isteğe bağlı)

Tüm mevcut Türkçe içeriğin (9 hizmet, 29 blog yazısı, 120 haber, danışmanlar,
site metinleri, slider, iletişim ve tüm URL/SEO kayıtları) İngilizce ve Almanca
çevirileri hazır bir SQL dosyası olarak üretilmiştir:

```text
database/migrations/003_ceviriler_en_de.sql
```

Özellikleri:

- `INSERT IGNORE` kullanır: admin panelinden elle girilmiş bir çeviri varsa
  **üzerine yazmaz**, yalnızca eksik kayıtları ekler.
- Tüm kayıtlar `YayinDurumu=1` (yayında) olarak gelir; `tablo_ayarlar_ceviri`
  satırları sayesinde dil seçicide EN ve DE görünür hale gelir.
- Mevcut Türkçe tablolara dokunmaz; yalnızca `_ceviri` tablolarına yazar.
- `001_multilanguage.sql` çalıştırıldıktan SONRA uygulanmalıdır.

Staging'de çalıştırmak için (cmd):

```cmd
mysql -u root -p --default-character-set=utf8mb4 organik_staging < C:\WebSites\organik_test\database\migrations\003_ceviriler_en_de.sql
```

Doğrulama:

```cmd
mysql -u root -p -e "SELECT DilKodu, COUNT(*) FROM tablo_blog_ceviri GROUP BY DilKodu;" organik_staging
mysql -u root -p -e "SELECT DilKodu, COUNT(*) FROM tablo_haberler_ceviri GROUP BY DilKodu;" organik_staging
mysql -u root -p -e "SELECT DilKodu, COUNT(*) FROM tablo_url_ceviri GROUP BY DilKodu;" organik_staging
```

Beklenen: blog 29+29, haberler 120+120, url 176+176 civarı (en/de).

Not: Çeviriler makine destekli üretilmiştir. Test ve ilk yayın için uygundur;
canlıda kalıcı olmadan önce özellikle hizmet sayfaları ve hukuki metinlerin
dili bilen biri tarafından gözden geçirilmesi önerilir. Admin panelinden
yapılan her düzeltme kalıcıdır (dosya tekrar çalıştırılsa bile ezilmez).

## 7. Test modu anahtarı (`isTest`)

`Connections/Conn.php` artık iki ayarı birden içerir: canlı ve test. Hangisinin
kullanılacağını **bir dosyanın var olup olmaması** belirler:

```text
Connections/TEST_ORTAMI
```

- Bu dosya varsa site **test modunda** çalışır.
- Bu dosya yoksa site **canlı modunda** çalışır.

Dosyanın içeriği önemli değildir; boş bir metin dosyası yeterlidir. Test
sunucusunda `Connections` klasörüne sağ tıklayıp **Yeni → Metin Belgesi**
oluşturun ve adını uzantısız olarak `TEST_ORTAMI` yapın.

Canlı sunucuda bu dosya **asla** bulunmamalıdır. `.gitignore` içinde olduğu
için Git ile taşınmaz.

Test modu açıkken kod kendiliğinden şunları yapar:

- `organik_staging` veritabanına bağlanır (canlı DB'ye dokunmaz).
- Site ve admin adreslerini tarayıcıdaki adresten türetir; port hangisi olursa
  olsun (`http://www.organikik.com.tr:8081/` gibi) linkler doğru çalışır.
- PHP hatalarını ekranda gösterir.
- `X-Robots-Tag: noindex` başlığı göndererek arama motorlarını uzak tutar.

Test veritabanı parolası `Conn.php` içindeki test bloğunda yazılıdır:

```php
$username_Conn = "organik_test";
$password_Conn = "TEST_PAROLASI_BURAYA";
```

4. bölümde MySQL kullanıcısını oluştururken parolayı buradaki değerle aynı
verin, ya da buradaki değeri kendi parolanızla değiştirin.

Ayrıca `web.config` içindeki HTTPS yönlendirme kuralı yalnızca 80 portunda
çalışacak şekilde değiştirildi. Bu sayede test sitesi farklı bir portta HTTP
olarak açılabilir; canlı site ise eskisi gibi HTTPS'e yönlenir. Aynı
`web.config` dosyası her iki ortamda da kullanılabilir.

## 7a. IIS üzerinde test sitesi açılması (port ile)

Ayrı alt alan adı yerine aynı sunucuda farklı bir port kullanılabilir.
Örnek port: `8081`.

1. Canlı klasörün tamamını (`uploads/` ve `admin/uploads/` dahil) şuraya
   kopyalayın: `C:\WebSites\organik_test\`
2. Bu repodaki güncel dosyaları aynı klasörün üzerine yazın.
3. `C:\WebSites\organik_test\Connections\TEST_ORTAMI` boş dosyasını oluşturun.
4. IIS Manager → **Application Pools → Add Application Pool**
   - Name: `organik_test`
   - .NET CLR version: **No Managed Code**
   - Identity: canlı sitenin pool'u ile aynı.
5. IIS Manager → **Sites → Add Website**
   - Site name: `organik_test`
   - Application pool: `organik_test`
   - Physical path: `C:\WebSites\organik_test`
   - Binding: `http`, IP `All Unassigned`, Port `8081`, Host name boş.
6. Siteyi seçip **Handler Mappings** içinde `*.php` için PHP FastCGI satırının
   bulunduğunu doğrulayın. Yoksa canlı siteden aynı ayarı ekleyin.
7. **Default Document** listesinde `index.php` olduğunu doğrulayın.
8. `C:\WebSites\organik_test` klasörüne `IIS AppPool\organik_test`
   kullanıcısı için **Modify** izni verin (görsel yüklemeleri için gerekli).
9. Windows Güvenlik Duvarı → Inbound Rules → TCP `8081` için Allow kuralı
   ekleyin. Sunucu bir bulut sağlayıcıdaysa oradaki güvenlik duvarında da
   portu açın.
10. Tarayıcıda `http://www.organikik.com.tr:8081/` adresini açın. Adres
    çubuğunda `:8081` kalmalıdır. Kayboluyorsa `TEST_ORTAMI` dosyası yanlış
    yerdedir veya `web.config` güncellenmemiştir.

Test bittiğinde IIS'te `organik_test` sitesini **Stop** yapın ve güvenlik
duvarı kuralını kapatın.

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

Staging alan adınıza göre şu adresleri kontrol edin (port yöntemi
kullanıldıysa `https://test.organikik.com.tr` yerine
`http://www.organikik.com.tr:8081` yazın):

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
3. Canlı veritabanında `001_multilanguage.sql`, `002_tablo_blog_auto_increment.sql`
   ve `003_ceviriler_en_de.sql` migration dosyalarını sırayla çalıştırın.
4. Güncel kod dosyalarını canlı sunucuya yükleyin.
5. Canlı sunucuda `Connections/TEST_ORTAMI` dosyasının **bulunmadığını**
   kontrol edin; bu dosya varsa canlı site test veritabanına bağlanmaya çalışır.
6. Önce Türkçe siteyi hızlıca test edin.
7. Admin paneline girip örnek EN/DE içerikleri kontrol edin.
8. `/en`, `/de` ve `/sitemap.xml` adreslerini kontrol edin.
9. Hata kayıtlarını ve iletişim/e-bülten formlarını takip edin.

Canlı ve test ayarları aynı `Conn.php` içinde bulunduğundan dosyayı ayrıca
düzenlemek gerekmez; tek fark `TEST_ORTAMI` dosyasının varlığıdır.

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
- [x] `SHOW CREATE TABLE tablo_blog` sonucu kontrol edildi (AUTO_INCREMENT yok).
- [ ] `002_tablo_blog_auto_increment.sql` staging'de çalıştırıldı ve yeni blog eklenebildi.
- [ ] Çoklu dil migration'ı staging'de çalıştırıldı.
- [ ] Güncel kodlar staging'e yüklendi.
- [ ] Staging'de `Connections/TEST_ORTAMI` dosyası oluşturuldu.
- [ ] Türkçe site regresyon testi tamamlandı.
- [ ] `003_ceviriler_en_de.sql` staging'de çalıştırıldı (veya örnek EN içerik elle girildi).
- [ ] `/en` ve `/de` sayfalarında çeviriler kontrol edildi.
- [ ] Menü, arama, iletişim ve e-bülten test edildi.
- [ ] Mobil görünüm kontrol edildi.
- [ ] SEO etiketleri ve sitemap kontrol edildi.
- [ ] Canlıya geçmeden önce yeniden yedek alındı.
- [ ] Canlı sunucuda `Connections/TEST_ORTAMI` dosyası olmadığı doğrulandı.
- [ ] Canlı yayın sonrası hızlı kontrol tamamlandı.

