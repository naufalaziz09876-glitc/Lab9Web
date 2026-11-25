<?php
function formatRupiah(float $angka): string { return 'Rp ' . number_format($angka, 0, ',', '.'); }
function e(string $nilai): string { return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8'); }
function konversiCelciusKeFahrenheit($c) { return ($c * 9 / 5) + 32; }
function tentukanStatusNilai($nilai) {
    if ($nilai >= 85) return 'A';
    if ($nilai >= 70) return 'B';
    if ($nilai >= 55) return 'C';
    if ($nilai >= 40) return 'D';
    return 'E';
}
function hitungTotal($harga, $jumlah) { return $harga * $jumlah; }
