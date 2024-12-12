# Final_Project_first

Final project Pada pelaksanaan program Virtual Internship Experience ini, teman-teman akan diberikan gambaran tentang bagaimana seorang Fullstack Developer bekerja di Investree.

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Fitur](#fitur)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)
- [Kontak](#kontak)

## Tentang Proyek

Recipe Hub yang dibuat menggunakan laravel dilengkapi dengan fitur-fitur baru seperti akun pengguna, pembuatan resep, dan detail resep yang mencakup daftar bahan dan instruksi. Antarmuka pengguna telah diperbaiki dengan desain yang lebih menarik, sehingga pengalaman pengguna menjadi lebih baik berkat penggunaan Javascript untuk pembaruan konten yang dinamis. Bagian belakang sistem juga telah ditingkatkan dengan menggunakan RESTful API dari Laravel untuk pengelolaan data yang lebih efisien. Selain itu, Laravel UI terus dikembangkan untuk mendukung otentikasi pengguna dan komponen antarmuka pengguna yang dasar.

## Persyaratan Sistem

- PHP versi 8.2 atau lebih tinggi
- Composer
- NPM atau Yarn
- Database Mysql
- Web Server XAMPP

## Instalasi

1. **Clone repositori**

    ```bash
    git clone https://github.com/bennitampz/final_taks_1
    ```

2. **Masuk ke direktori proyek**

    ```bash
    cd Final_Project_first
    ```

3. **Install dependensi Composer**

    ```bash
    composer install
    ```

4. **Install dependensi Node.js**

    ```bash
    npm install
    ```

    atau jika menggunakan Yarn:

    ```bash
    yarn
    ```

5. **Salin file konfigurasi**

    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturannya.

    ```bash
    cp .env.example .env
    ```

6. **Generate key aplikasi**

    ```bash
    php artisan key:generate
    ```

7. **Konfigurasi database**

    Sesuaikan pengaturan database di file `.env` Anda.

8. **Migrasi database**

   Atau import dari database yang telah disediakan di final_taks_1 dengan nama restapi_laravel_passport_benni.sql
    
    ```bash
    php artisan migrate
    ```

## Penggunaan

    Jalankan server pengembangan:

```bash
php artisan serve
```

    Buka http://localhost:8000 di browser Anda.


## Testing using Postman
### A. jwt authentication menggunakan laravel passport
A. Registration

Registration success with JWT token
![Screenshot 2024-12-11 231258](https://github.com/user-attachments/assets/43b95178-40a0-48e8-8307-b3b43ed1bb03)

B. Login

Login success with JWT token
![Screenshot 2024-12-11 232018](https://github.com/user-attachments/assets/d21d5ea6-9780-4cea-9db2-59211ea90896)

C. Profile

Profile retrieved successfully using JWT Token for auth
![Screenshot 2024-12-11 232355](https://github.com/user-attachments/assets/cac0fe16-539b-4d45-a632-e14cb331d22a)

D. Logout

Logged out successfully
![Screenshot 2024-12-11 232716](https://github.com/user-attachments/assets/06ae7167-3c4b-45d4-9951-db4145985d08)

### B. buatlah restful api posts (create, list all, show detail, update & delete)
A. Create

Article created successfully 
![Screenshot 2024-12-12 092303](https://github.com/user-attachments/assets/9505ea7c-0156-431f-a658-a324f74196ec)
B. List all

Articles retrieved successfully from all Articles
![Screenshot 2024-12-12 092721](https://github.com/user-attachments/assets/afa6aaeb-b6f8-472a-904f-c7c9d1e385e4)
C.Show detail

Article retrieved successfully by id of Article
![Screenshot 2024-12-12 093233](https://github.com/user-attachments/assets/96cd3389-a623-482d-9db3-7a71ab086906)
D. Update

Article updated successfully
![Screenshot 2024-12-12 093954](https://github.com/user-attachments/assets/03a156ff-0847-425b-82cb-cafd9d651396)
E. Delete

Article deleted successfully
![{BAB77BB3-D541-47B4-97D0-5016B1D056C1}](https://github.com/user-attachments/assets/173086c2-3737-4285-966e-b82c447997d0)

