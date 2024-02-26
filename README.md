## Deskripsi
Program penyelesaian pada soal TLF menggunakan Laravel, Bootstrap, jQuery, MySQL, API dan JWT.
## Requirement
- PHP ^8.1 
- Node js minimal versi 18
- Mysql versi ^5 atau ^8
- Web Server Apache ( via laragon atau xampp )
- Laravel ^10.10
- composer
- npm
  
## Instalasi
- install php dependencies : `composer install`
- install javascript dependencies : `npm install`
- copy environment variable : `cp .env.example .env`
- siapkan database mysql dengan nama tlf, dan sesuaikan configurasi seperti username, password pada file .env
- jalankan migration dan seeder : `php artisan migrate --seed`
- generate jwt secret : `php artisan jwt:secret`
  
## Development
- hidupkan web server: `php artisan serve` atau jika menggunakan laragon, hidupkan web server di laragon
- jalankan asset building : `npm run dev` atau bisa langsung build dengan cara : `npm run build`
- jika menggunakan laragon, pergi ke http://tlf.test, atau jika menggunakan artisan serve, pergi ke http://127.0.0.0:8000
