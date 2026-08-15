# Sebatas Kopi - Point of Sale & Order System

Aplikasi web pemesanan dan kasir (POS) untuk kafe **Sebatas Kopi**. Proyek ini dibangun menggunakan **Laravel 11**, **Tailwind CSS**, dan **Alpine.js**.

---

## 🚀 Panduan Instalasi (Cloning ke Device Baru)

Jika Anda melakukan *pull* atau *clone* repositori ini ke perangkat (device) baru, ikuti langkah-langkah di bawah ini agar aplikasi dapat berjalan dengan data menu, gambar, dan akun yang sudah terkonfigurasi, namun dengan data pesanan (order) yang bersih (kosong).

### 1. Kebutuhan Sistem
Pastikan perangkat baru Anda telah terinstal:
- PHP (Minimal versi 8.2)
- Composer
- Node.js & NPM
- MySQL / MariaDB (Contoh: Laragon atau XAMPP)
- Git

### 2. Langkah-Langkah Instalasi

Buka terminal/Command Prompt, lalu jalankan perintah berikut secara berurutan:

#### Clone Repositori
```bash
git clone https://github.com/USERNAME_ANDA/sebatas-kopi.git
cd sebatas-kopi
```

#### Instal Dependencies
```bash
composer install
npm install
npm run build
```

#### Konfigurasi Environment (.env)
Salin file konfigurasi bawaan:
```bash
copy .env.example .env
```
*(Catatan: Jika menggunakan macOS/Linux, gunakan perintah `cp .env.example .env`)*

Buka file `.env` di text editor (contoh: VS Code) dan sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sebatas-kopi  # Pastikan Anda membuat database kosong dengan nama ini di MySQL Anda
DB_USERNAME=root
DB_PASSWORD=
```
Sesuaikan juga kredensial Midtrans (`MIDTRANS_SERVER_KEY`, dll) jika diperlukan.

#### Generate App Key & Storage Link
```bash
php artisan key:generate
php artisan storage:link
```
*Perintah `storage:link` sangat penting agar gambar menu yang di-pull dari GitHub dapat ditampilkan.*

#### Jalankan Migrasi & Database Seeder
Langkah ini adalah inti dari setup. Perintah ini akan membuat struktur tabel baru yang masih kosong, dan langsung mengisi data Kategori, Produk, Topping, dan Akun Admin/Customer sesuai dengan kondisi data master terakhir.
```bash
php artisan migrate:fresh --seed
```

### 3. Menjalankan Server Lokal

Setelah semua langkah di atas selesai, jalankan server pengembangan:

```bash
php artisan serve
```

Di terminal atau *tab* lain, jalankan Vite untuk mengompilasi CSS/JS:
```bash
npm run dev
```

Aplikasi kini dapat diakses melalui browser di alamat: `http://localhost:8000`

---

## Akun Default
Secara bawaan (*default*), *seeder* telah membuat akun berikut:

**Administrator:**
- Email: `admin@kopi.com`
- Password: `password`

**Customer:**
- Email: `user@gmail.com`
- Password: `password`
