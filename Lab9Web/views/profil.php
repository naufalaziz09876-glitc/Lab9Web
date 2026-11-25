<section>
    <h2>Profil</h2>
    <table class="tabel">
        <tr><th>Nama</th><td>Isi nama Anda</td></tr>
        <tr><th>NIM</th><td>Isi NIM Anda</td></tr>
        <tr><th>Kelas</th><td>Isi kelas Anda</td></tr>
    </table>
    <h3>Demo function helper</h3>
    <ul>
        <li>37 °C = <?= e(konversiCelciusKeFahrenheit(37)) ?> °F</li>
        <li>Nilai 78 = predikat <?= e(tentukanStatusNilai(78)) ?></li>
        <li>3 x <?= e(formatRupiah(25000)) ?> = <?= e(formatRupiah(hitungTotal(25000, 3))) ?></li>
    </ul>
</section>
