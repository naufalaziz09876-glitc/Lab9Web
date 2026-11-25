<?php
// Penghapusan hanya lewat POST + token CSRF, bukan lewat URL GET.
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifikasiCsrf()) {
    setFlash('gagal', 'Permintaan hapus tidak valid.');
    redirect('user/list');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);

setFlash($stmt->rowCount() ? 'sukses' : 'gagal',
         $stmt->rowCount() ? 'Pengguna berhasil dihapus.' : 'Pengguna tidak ditemukan.');
redirect('user/list');
