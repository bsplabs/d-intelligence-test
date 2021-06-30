
## เริ่มต้นโปรเจค

ก่อนทำการรันคำสั่งต่างๆ ให้ทำการสร้าง database เเล้วนำชื่อ DB และ Password DB ไปวางใว้ในไฟล์ .env เเล้วรันคำสั่งตามข้างล่างนี้

- `composer install`
- `php artisan migrate --seed`
- `php artisan passport:install`


## ทดสอบหน้าเเสดงผลจังหวัด

- เข้าไปที่ <scheme>://<hostname>[:<port>]/ เช่น https://bsplabs.com/


## ทดสอบระบบ Login API

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


## ทดสอบระบบดึง Provinces โดยจะต้องทำการ authenticated ก่อน

- <scheme>://<hostname>[:<port>]/api/provinces
- <scheme>://<hostname>[:<port>]/api/province/{id}
- <scheme>://<hostname>[:<port>]/api/geographies
- <scheme>://<hostname>[:<port>]/api/geographies/{id}/provinces

