# Final_Project_first (Restful API menggunakan Laravel Passport )

Final project Pada pelaksanaan program Virtual Internship Experience ini, teman-teman akan diberikan gambaran tentang bagaimana seorang Fullstack Developer bekerja di Investree.
## Virtual Internship Experience (Investree) - Fullstack - Benni Hasahatan Tampubolon
## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Penggunaan](#penggunaan)
- [Fitur](#fitur)
- [License](#License)

## Tentang Proyek

Project yang diberikan oleh Investree untuk menunjukkan bagaimana seorang fullstack membangun rest api dan oauth token menggunakan laravel framework serta laravel passport 

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

4. **Install Passport Client token**

    ```bash
    php artisan passport:client --personal
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

### B. Gunakan mekanisme middleware auth api passport ke endpoint posts (create, list all, show detail, update dan delete) 
![Screenshot 2024-12-12 115504](https://github.com/user-attachments/assets/a01d4ac8-d715-4644-9db2-165bda0f83fd)

### C. Gunakan prefix versi pada api yang telah dibuat (contoh : api/v1)

A. Telah menggunakan prefix v1
![{BC578F42-640F-4E8C-91BA-18DBEF3BFEE3}](https://github.com/user-attachments/assets/8cd63401-f1e8-40ac-9702-18cc8ea6ab6a)
![{828F2DE8-FE6C-49B1-AFAE-C67551F1EE4B}](https://github.com/user-attachments/assets/7c854110-f154-467d-94f2-921fcdfda616)

### D. Gunakan pagination pada api list all posts
Article and Category retrieved successfully with pagination at all post

![Screenshot 2024-12-12 161646](https://github.com/user-attachments/assets/7d1b2062-7984-4eb4-9336-e300377d0a23)

### E. Unit testing untuk setiap api posts
A. POST v1/api/register - untuk registrasi user
![{1CF31948-0874-4871-8BBA-380DC8AF564E}](https://github.com/user-attachments/assets/b85dc92b-bb2b-4fef-b57c-bcd77f18f083)

B. POST v1/api/login - untuk login user
![{5CFC081F-ABC2-4547-B395-BE814A707E23}](https://github.com/user-attachments/assets/ccc27f11-c2bc-40d4-9115-cf8bd9e66793)

C. GET v1/api/profile - untuk melihat profil
![{EC5A9820-3046-4930-9ADD-7CBFE86E511C}](https://github.com/user-attachments/assets/b92ce2aa-f807-45bf-aca4-484e1cf457d0)

D. GET v1/api/logout - untuk logout
![{8BF2F3AC-1863-4543-A1F1-AEAE5CB5B5FF}](https://github.com/user-attachments/assets/2a8687da-fac7-420a-b599-5c90aaf4cc0c)

E. GET v1/api/articles - untuk mendapatkan semua artikel
![{E0B876D2-F172-4FB5-8025-CA0F71F1E76D}](https://github.com/user-attachments/assets/5fb8b646-6e0b-4685-b781-404adc289c71)

F. POST v1/api/articles - untuk membuat artikel baru
![{907DB1FB-84F6-4EEB-A27F-362D264D5E26}](https://github.com/user-attachments/assets/6185dd06-f533-4c2c-b69c-ffd029e04eb5)

G. GET /api/articles/{id} - untuk mendapatkan detail artikel
![{8BD78D70-6488-4F31-97CD-DBABF0E51EDB}](https://github.com/user-attachments/assets/00cb6ed4-83e8-4924-bce8-7a27abb3990e)

H. PUT /api/articles/{id} - untuk update artikel
![{0D5D2FBB-ECA3-44DB-B363-30207287163C}](https://github.com/user-attachments/assets/b5bd0982-767c-48bb-a744-3bb9128dab73)

I. DELETE /api/articles/{id} - untuk menghapus artikel
![{DE59687A-64F9-4BED-87D1-B5EED23A5716}](https://github.com/user-attachments/assets/5eec071d-0b22-43c4-a7f3-02f1cd0b13e7)

### F. Database Documentation
A. Articles
![{D4197AFF-4862-4D41-BCC0-5A097F591150}](https://github.com/user-attachments/assets/865595de-d916-4275-aeb2-fbb0f1f4d5b0)

B. Categories
![{76C53D45-A287-4EC7-9D42-1ACA904C2B48}](https://github.com/user-attachments/assets/475013ef-acc8-43eb-9561-14b3dddcf865)

### If you have some suggestion
Just Contact Me At: 

Email: bennitampu@gmail.com
Instagram: @bennitpbln_404_emgcy

## License
Laravel framework are open-sourced software licensed under the MIT license
