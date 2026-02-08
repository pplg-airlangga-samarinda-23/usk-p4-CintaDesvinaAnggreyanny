<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: pengguna/index.php");
    exit;
}

$buku = $koneksi->query("SELECT * FROM buku")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Anggota</title>
</head>
<body>

<h2>Selamat datang, <?= $_SESSION['username'] ?> 👋</h2>

<h3>Daftar Buku</h3>
<a href="form-pengembalian.php">📘 Pengembalian Buku</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; foreach ($buku as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['pengarang'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
                <?php if ($row['stok'] > 0): ?>
                    <a href="form-peminjaman.php?id=<?= $row['id'] ?>"
                    onclick="return confirm('Yakin pinjam buku?')">
                        Pinjam Buku
                    </a>
                <?php else: ?>
                    <span style="color:red">Stok Habis</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<a href="logout.php">Logout</a>

</body>
</html>
