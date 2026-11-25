<?php
// index.php — titik masuk aplikasi + router sederhana (whitelist)
ob_start();          // agar redirect() di modul tetap bisa dipakai setelah header dimuat
session_start();

require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/database.php';

// Daftar rute yang BOLEH diakses (whitelist)
$routes = [
    'dashboard'   => ['file' => __DIR__ . '/views/dashboard.php',   'judul' => 'Dashboard'],
    'profil'      => ['file' => __DIR__ . '/views/profil.php',      'judul' => 'Profil'],
    'kontak'      => ['file' => __DIR__ . '/views/kontak.php',      'judul' => 'Kontak'],
    'user/list'   => ['file' => __DIR__ . '/modules/user/list.php', 'judul' => 'Data Pengguna'],
    'user/add'    => ['file' => __DIR__ . '/modules/user/add.php',  'judul' => 'Tambah Pengguna'],
    'user/edit'   => ['file' => __DIR__ . '/modules/user/edit.php', 'judul' => 'Ubah Pengguna'],
    'user/delete' => ['file' => __DIR__ . '/modules/user/delete.php', 'judul' => 'Hapus Pengguna'],
];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || $page === '' || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $currentPage = '404';
    $pageTitle   = '404 - Tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $currentPage = $page;
    $pageTitle   = $routes[$page]['judul'];
    $contentFile = $routes[$page]['file'];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
