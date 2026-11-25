<?php
// helpers/functions.php — function umum yang dipakai banyak modul

/* ---------- Tampilan & format ---------- */

/** Escape teks sebelum ditampilkan ke HTML. */
function e($nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

/** 150000 -> "Rp 150.000" */
function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/** Besar diskon (nominal) dari harga dan persen (default 10%). */
function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

/** Validasi format email. */
function validasiEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/** Ringkas teks panjang menjadi $batas karakter + "...". */
function ringkasTeks(string $teks, int $batas = 100): string
{
    $teks = trim(preg_replace('/\s+/', ' ', $teks));
    if (mb_strlen($teks) <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas)) . '...';
}

/* ---------- Latihan function (bagian E) ---------- */

function konversiCelciusKeFahrenheit(float $c): float
{
    return ($c * 9 / 5) + 32;
}

function tentukanStatusNilai(float $nilai): string
{
    if ($nilai >= 85) return 'A';
    if ($nilai >= 70) return 'B';
    if ($nilai >= 55) return 'C';
    if ($nilai >= 40) return 'D';
    return 'E';
}

function hitungTotal(float $harga, int $jumlah): float
{
    return $harga * $jumlah;
}

/* ---------- URL & navigasi ---------- */

/** Direktori dasar aplikasi, mis. "/Lab9Web" (konsisten walau URL di-rewrite). */
function baseUrl(string $path = ''): string
{
    $dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return $dir . '/' . ltrim($path, '/');
}

/** Buat tautan router: url('user/edit', ['id' => 3]) -> index.php?page=user/edit&id=3 */
function url(string $page, array $params = []): string
{
    $query = http_build_query(['page' => $page] + $params);
    return baseUrl('index.php') . '?' . $query;
}

function redirect(string $page, array $params = []): void
{
    header('Location: ' . url($page, $params));
    exit;
}

/** Menu aktif: kembalikan "active" jika halaman saat ini diawali $prefix. */
function isActive(string $prefix): string
{
    $current = $GLOBALS['currentPage'] ?? 'dashboard';
    return ($current === $prefix || str_starts_with($current, $prefix . '/')) ? 'active' : '';
}

/* ---------- Pesan sukses / gagal (flash) ---------- */

function setFlash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampilkanFlash(): void
{
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $kelas = $f['tipe'] === 'sukses' ? 'alert-sukses' : 'alert-gagal';
        echo '<div class="alert ' . $kelas . '">' . e($f['pesan']) . '</div>';
    }
}

/* ---------- Perlindungan CSRF ---------- */

function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">';
}

function verifikasiCsrf(): bool
{
    $kirim = $_POST['csrf'] ?? '';
    return is_string($kirim) && hash_equals($_SESSION['csrf'] ?? '', $kirim);
}
