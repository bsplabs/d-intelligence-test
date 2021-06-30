<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## เริ่มต้นโปรเจค

ก่อนทำการรันคำสั่งต่างๆ ให้ทำการสร้าง database เสร็จเเล้วนำชื่อ DB และ Password DB ไปวางใว้ในไฟล์ .env (ถ้ายังไม่มี .env ก็สร้างใหม่ จาก .env.example) เเล้วรันคำสั่งตามข้างล่างนี้

- `composer install`
- `php artisan key:generate`
- `php artisan migrate --seed`
- `php artisan passport:install`



### ทดสอบหน้าเเสดงผลจังหวัด (Create, Update, Ddelete)

- เข้าไปที่ `<scheme>://<hostname>[:<port>]` เช่น `https://bsplabs.com/`



### ทดสอบระบบ Login API

- `<scheme>://<hostname>[:<port>]/api/register`

  body request
  ```
  {
    "name": "Your Name",
    "email": "Your Email",
    "password": "Your Password"
  }
  ```

- `<scheme>://<hostname>[:<port>]/api/login`

  body request
  ```
    {
      "email": "Your Email",
      "password": "Your Password"
    }
  ```

  เมื่อทำการ Login เเล้วจะมีการ Response --> access_token กลับมาให้ โดยจะทำไปทดสอบดึง Provinces ในลำดับถัดไป

- `<scheme>://<hostname>[:<port>]/api/logout`

  ในการ Logout ไม่ต้องแนบข้อมูล แต่ต้องเพิ่ม Authorization: `Bearer <access_token>` เพื่อนำ token ไปทำการ revoke ที่ Backend 


### ทดสอบระบบดึง Provinces

  โดยจะต้องทำการ authenticated ก่อน เพื่อให้ได้ access_token ในการเข้าถึง resources

- `<scheme>://<hostname>[:<port>]/api/provinces`
- `<scheme>://<hostname>[:<port>]/api/provinces/{id}`
- `<scheme>://<hostname>[:<port>]/api/geographies`
- `<scheme>://<hostname>[:<port>]/api/geographies/{id}/provinces`

