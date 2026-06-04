# Sistem Antrian Klinik Kampus

Aplikasi web Laravel 12 untuk pengelolaan antrian klinik kampus.

## Teknologi

- Laravel 12
- PHP 8.2+ / disarankan PHP 8.3+
- MySQL
- Blade Template
- Eloquent ORM
- Laravel Session Authentication
- Bootstrap 5
- SweetAlert2
- DataTables
- Font Awesome

## Akun Default

Seeder membuat dua akun:

- Admin: `admin@klinik.test` / `password`
- Petugas: `petugas@klinik.test` / `password`

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Sesuaikan koneksi MySQL di `.env`, lalu jalankan:

```bash
php artisan migrate --seed
php artisan serve
```

Database default yang digunakan:

```env
DB_DATABASE=sistem_antrian_klinik
DB_USERNAME=root
DB_PASSWORD=
```

## Fitur

- Login dan logout untuk role Admin dan Petugas
- Dashboard statistik antrian harian
- CRUD layanan klinik
- Pengambilan nomor antrian otomatis per layanan
- Data antrian dengan filter layanan dan status
- Pemanggilan antrian oleh petugas
- Riwayat layanan dengan filter hari ini, minggu ini, dan bulan ini
