<?php
$pesanHasil = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifikasiCsrf()) {
        $pesanHasil = '<div class="alert alert-gagal">Token tidak valid.</div>';
    } else {
        $email = trim($_POST['email'] ?? '');
        $isi   = trim($_POST['pesan'] ?? '');
        if (!validasiEmail($email) || $isi === '') {
            $pesanHasil = '<div class="alert alert-gagal">Email tidak valid atau pesan kosong.</div>';
        } else {
            $pesanHasil = '<div class="alert alert-sukses">Pesan dari ' . e($email)
                        . ' diterima: &ldquo;' . e(ringkasTeks($isi, 60)) . '&rdquo;</div>';
        }
    }
}
?>
<section>
    <h2>Kontak</h2>
    <?= $pesanHasil ?>
    <form method="post" action="<?= e(url('kontak')) ?>">
        <?= csrfField() ?>
        <label>Email</label>
        <input type="text" name="email" required>
        <label>Pesan</label>
        <textarea name="pesan" rows="4" required></textarea>
        <button type="submit">Kirim</button>
    </form>
</section>
