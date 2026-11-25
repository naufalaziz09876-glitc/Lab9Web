# Lab9Web

# Lab9Web — Praktikum 9: PHP Modular

## Tujuan
Memodularisasi aplikasi CRUD pengguna dengan template bersama, function helper, struktur direktori terpisah, dan router berbasis whitelist.

## Kebutuhan
- PHP 8.0+ (memakai `str_starts_with`), MySQL/MariaDB
- Apache (XAMPP/Laragon), browser, VS Code

## Cara Menjalankan
1. Salin folder `Lab9Web` ke `htdocs` (XAMPP) atau `www` (Laragon).
2. Import `database.sql` melalui phpMyAdmin.
3. Sesuaikan kredensial di `config/database.php` bila perlu.
4. Buka `http://localhost/Lab9Web/index.php`.
5. (Opsional) URL ringkas: aktifkan `mod_rewrite` + `AllowOverride All`, lalu buka `http://localhost/Lab9Web/user/list`.

## Struktur Direktori
```
Lab9Web/
├── index.php            # router (whitelist)
├── .htaccess            # URL rewrite (opsional)
├── database.sql
├── config/database.php  # satu-satunya koneksi DB (PDO)
├── views/               # header, footer, dashboard, profil, kontak, 404
├── helpers/functions.php
├── modules/user/        # list, add, edit, delete
├── assets/css, assets/js
└── latihan/lab9_php_modular/   # latihan dasar bagian C–E
```

## Daftar Rute
| Rute | File |
|---|---|
| `dashboard` (default) | views/dashboard.php |
| `profil` | views/profil.php |
| `kontak` | views/kontak.php |
| `user/list` | modules/user/list.php |
| `user/add` | modules/user/add.php |
| `user/edit&id=N` | modules/user/edit.php |
| `user/delete` (POST) | modules/user/delete.php |
| rute lain | 404 |

## Fitur Keamanan & Tantangan
- Whitelist rute; 404 untuk rute tak dikenal / kosong / bukan string
- Prepared statement PDO, `e()` untuk escaping output
- Hapus hanya via POST + token CSRF
- Menu aktif (`isActive()`), pesan flash (`setFlash()`), `.htaccess` rewrite

## Langkah Praktikum
1. Latihan dasar: `latihan/lab9_php_modular/` (`uji-include.php`, `home.php`, `about.php`, `kontak.php`, `latihan-function.php`).
2. Latihan 1: template header/footer bersama (Home/Profil/Kontak).
3. Latihan 2: `helpers/functions.php` (formatRupiah, hitungDiskon, validasiEmail, ringkasTeks, dst.).
4. Latihan 3: router 7 rute + 404.
5. Latihan 4: refactor CRUD ke struktur modular.

