<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## เริ่มต้นโปรเจค

ก่อนทำการรันคำสั่งต่างๆ ให้ทำการสร้าง database เเล้วนำชื่อ DB และ Password DB ไปวางใว้ในไฟล์ .env เเล้วรันคำสั่งตามข้างล่างนี้

- `composer install`
- `php artisan migrate --seed`
- `php artisan passport:install`


### ทดสอบหน้าเเสดงผลจังหวัด

- เข้าไปที่ <scheme>://<hostname>[:<port>]/ เช่น https://bsplabs.com/


### ทดสอบระบบ Login API

- <scheme>://<hostname>[:<port>]/api/register

  body request
  ```
    {
      "name": "Your Name",
      "email": "Your Email",
      "password": "Your Password"
    }
  ```

- <scheme>://<hostname>[:<port>]/api/login

  body request
  ```
    {
      "email": "Your Email",
      "password": "Your Password"
    }
  ```

- <scheme>://<hostname>[:<port>]/api/logout


### ทดสอบระบบดึง Provinces โดยจะต้องทำการ authenticated ก่อน

- <scheme>://<hostname>[:<port>]/api/provinces
- <scheme>://<hostname>[:<port>]/api/province/{id}
- <scheme>://<hostname>[:<port>]/api/geographies
- <scheme>://<hostname>[:<port>]/api/geographies/{id}/provinces

