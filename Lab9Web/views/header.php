<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'Aplikasi') ?> | Aplikasi PHP Modular</title>
    <link rel="stylesheet" href="<?= e(baseUrl('assets/css/style.css')) ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>Praktikum 9 — template, function, dan routing</p>
    </header>
    <nav>
        <a class="<?= isActive('dashboard') ?>" href="<?= e(url('dashboard')) ?>">Dashboard</a>
        <a class="<?= isActive('profil') ?>"    href="<?= e(url('profil')) ?>">Profil</a>
        <a class="<?= isActive('kontak') ?>"    href="<?= e(url('kontak')) ?>">Kontak</a>
        <a class="<?= isActive('user') ?>"      href="<?= e(url('user/list')) ?>">Pengguna</a>
    </nav>
    <main>
        <?php tampilkanFlash(); ?>
