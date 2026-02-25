<?php
include __DIR__ . '/../koneksi.php';

$sql = "SELECT * FROM pengguna";
$users = $koneksi->query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengguna</title>
</head>
<body>

<h1>Data Pengguna</h1>

<a href="create.php">Tambah</a>
<a href="../dashboard-admin.php">Kembali</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; foreach ($users as $user): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['role'] ?></td>
            <td>
                <a href="edit.php?id=<?= $user['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $user['id'] ?>"
                   onclick="return confirm('Yakin hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
