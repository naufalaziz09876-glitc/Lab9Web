<?php
$errors = [];
$nama = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!verifikasiCsrf())                    $errors[] = 'Token keamanan tidak valid.';
    if ($nama === '' || mb_strlen($nama) > 100) $errors[] = 'Nama wajib diisi (maks. 100 karakter).';
    if (!validasiEmail($email))               $errors[] = 'Format email tidak valid.';

    if (!$errors) {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (nama, email) VALUES (:nama, :email)');
            $stmt->execute([':nama' => $nama, ':email' => $email]);
            setFlash('sukses', 'Pengguna berhasil ditambahkan.');
            redirect('user/list');
        } catch (PDOException $ex) {
            $errors[] = ($ex->getCode() === '23000')
                ? 'Email sudah terdaftar.'
                : 'Gagal menyimpan data.';
            error_log($ex->getMessage());
        }
    }
}
?>
<section>
    <h2>Tambah Pengguna</h2>
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?= e($err) ?></div>
    <?php endforeach; ?>
    <form method="post" action="<?= e(url('user/add')) ?>">
        <?= csrfField() ?>
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($nama) ?>" required>
        <label>Email</label>
        <input type="text" name="email" value="<?= e($email) ?>" required>
        <button type="submit">Simpan</button>
        <a href="<?= e(url('user/list')) ?>">Batal</a>
    </form>
</section>
