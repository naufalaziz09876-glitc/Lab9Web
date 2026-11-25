<?php
require_once __DIR__ . '/helpers.php';
function hitungLuasPersegiPanjang($p, $l) { return $p * $l; }
function hitungDiskon(float $harga, float $persen = 10): float { return $harga * ($persen / 100); }
?>
<h3>Latihan Function</h3>
<ul>
  <li>Luas 8x5: <?= hitungLuasPersegiPanjang(8, 5) ?></li>
  <li>Diskon 10% dari 200000: <?= formatRupiah(hitungDiskon(200000)) ?></li>
  <li>Diskon 15% dari 200000: <?= formatRupiah(hitungDiskon(200000, 15)) ?></li>
  <li>37°C = <?= konversiCelciusKeFahrenheit(37) ?>°F</li>
  <li>Nilai 78 = <?= tentukanStatusNilai(78) ?></li>
  <li>Total 3 x 25000 = <?= formatRupiah(hitungTotal(25000, 3)) ?></li>
  <li>Escape: <?= e('<script>alert("uji")</script>') ?></li>
</ul>
