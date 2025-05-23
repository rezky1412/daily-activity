# Sistem Approval Progress Harian

Sistem manajemen input progres project, approval berjenjang, serta riwayat approval.

## Tech Stack

- Laravel 10.48.29, 
- PHP 8.1.10 (cli) (built: Aug 30 2022 18:05:49) (ZTS Visual C++ 2019 x64)
- Laragon v6.0
- DBMS MySQL

## Installasi

Clone repo : 
git clone https://github.com/rezky1412/daily-activity.git
cd progress-app

composer install
npm install && npm run dev

php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

### Default User

Email : ethan.sarifuddin@gmail.com
Password : admin123
Role : Admin

Note : Aktifkan Imagick DLL sesuai versi PHP yang dipunya sebagai ekstensi tambahan generate gambar

#### End Point API

- Login

url : http://domain-app/api/login
body : raw dengan type json 
example :
{
  "email": "ethan.sarifuddin@gmail.com",
  "password": "admin123"
}

- Get User

url : http://domain-app/api/user
authorization : Bearer Token

- Get Progres

url : http://domain-app/api/progress
authorization : Bearer Token