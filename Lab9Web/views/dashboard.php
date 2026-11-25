<?php
$total = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$harga = 200000;
?>
<section>
    <h2>Dashboard</h2>
    <p>Selamat datang! Seluruh halaman memakai header &amp; footer yang sama dan dimuat lewat router.</p>
    <div class="cards">
        <div class="card"><strong><?= $total ?></strong><span>Total pengguna</span></div>
        <div class="card"><strong><?= e(formatRupiah($harga)) ?></strong><span>Contoh harga</span></div>
        <div class="card"><strong><?= e(formatRupiah(hitungDiskon($harga, 15))) ?></strong><span>Diskon 15%</span></div>
    </div>
    <p><a href="<?= e(url('user/list')) ?>">Kelola data pengguna &rarr;</a></p>
</section>
