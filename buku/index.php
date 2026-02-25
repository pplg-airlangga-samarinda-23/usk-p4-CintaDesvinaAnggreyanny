<?php
include __DIR__.'/../koneksi.php';

$sql = "SELECT * FROM buku";
$books = $koneksi -> query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Buku</h1>
    <a href="create.php">Tambah</a>
    <a href="../dashboard-admin.php">Kembali</a>
    <table border="1" cellpadding="10">
        <thead>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Stok</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php $no=1; foreach ($books as $book): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $book['judul'] ?></td>
                    <td><?= $book['pengarang'] ?></td>
                    <td><?= $book['stok'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $book['id'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>