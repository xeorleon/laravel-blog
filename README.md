<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
</p>

## Laravel Blog Kurulum

### 1 - Projeyi indirdikten sonra bağımlılıları yüklemek için composer install  yapınız
### 2- Bağımlılıklar yüklendikten sonra .env.example dosyasının adını .env olarak değiştiriniz.
### 3 - Bir mysql veritabanı tablosu oluşturup .env 'de gerekli alanları doldurunuz
> **DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=tablo_adı<br>
DB_USERNAME=root<br>
DB_PASSWORD=**

### 4 - tablonun içeriğinin oluşturulması için komutu çalıştırın.
> **php artisan migrate:fresh --seed**

### 5 - İletişim Sayfasından gönderilen verileri test etmek için mailtrap.io kullanılmıştır, test etmek isterseniz .env dosyasinda şu alanları güncelleyiniz
> **MAIL_MAILER=smtp<br>
MAIL_HOST=smtp.mailtrap.io<br>
MAIL_PORT=2525<br>
MAIL_USERNAME=mailtrap_username<br>
MAIL_PASSWORD=mailtrap_password<br>
MAIL_ENCRYPTION=tls<br>**
<p>İletişim sayfasından gönderilen verileri Front\Homepage controller'ında contactpost ile karşılayıp
gelen bilgilerle test mail'i yolluyorum gerekli alanları siz kendinize göre düzenleyebilir veya veritabanına kayıt edip
admin paneline ekleyebilirsiniz.
</p>

## Laravel Blog Yapılanlar Listesi
### Frontend
- [x] Anasayfa Pagination ve aktif pasif post kontrolleri
- [x] Sayfaların kontrolü ve aktif pasiflik ve sıralamasına gore menüye eklenmesi
- [x] Kategorilerin aktiflik durumuna göre listelenmesi ve aktif olan postların sayısının gösterilmesi.kategori aktif degil ise ona bağlı makalelere'de erişilemez
- [x] Makale kontrolleri ve durumlarına göre aktif deaktif edilmesi
- [x] Sosyal medya linkleri, logo ve faviconların panel'den güncellenmesi 
### Backend
- [x] Site ayarları
- [x] Makale listeleme,oluşturma,silinen makaleler için geri dönüşüm kutusu
- [x] Makale Aktif pasiflik durumu jQuery ile anlık degiştirilebilir.
- [x] Kategori ekleme,silme ,aktiflik durumları ve silinemez Genel Kategorisi
- [x] Sayfa ekleme ,düzenleme, silme ve aktiflik durumu
