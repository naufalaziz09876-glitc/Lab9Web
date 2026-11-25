<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('SELECT id, nama, email FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();
if (!$user) {
    setFlash('gagal', 'Pengguna tidak ditemukan.');
    redirect('user/list');
}

$errors = [];
$nama  = $user['nama'];
$email = $user['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!verifikasiCsrf())                    $errors[] = 'Token keamanan tidak valid.';
    if ($nama === '' || mb_strlen($nama) > 100) $errors[] = 'Nama wajib diisi (maks. 100 karakter).';
    if (!validasiEmail($email))               $errors[] = 'Format email tidak valid.';

    if (!$errors) {
        try {
            $upd = $pdo->prepare('UPDATE users SET nama = :nama, email = :email WHERE id = :id');
            $upd->execute([':nama' => $nama, ':email' => $email, ':id' => $id]);
            setFlash('sukses', 'Data pengguna berhasil diperbarui.');
            redirect('user/list');
        } catch (PDOException $ex) {
            $errors[] = ($ex->getCode() === '23000')
                ? 'Email sudah dipakai pengguna lain.'
                : 'Gagal memperbarui data.';
            error_log($ex->getMessage());
        }
    }
}
?>
<section>
    <h2>Ubah Pengguna</h2>
    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?= e($err) ?></div>
    <?php endforeach; ?>
    <form method="post" action="<?= e(url('user/edit', ['id' => $id])) ?>">
        <?= csrfField() ?>
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($nama) ?>" required>
        <label>Email</label>
        <input type="text" name="email" value="<?= e($email) ?>" required>
        <button type="submit">Perbarui</button>
        <a href="<?= e(url('user/list')) ?>">Batal</a>
    </form>
</section>
