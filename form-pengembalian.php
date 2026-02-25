<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: pengguna/index.php");
    exit;
}

$username = $_SESSION['username'];

if (isset($_GET['kembali'])) {
    $id_peminjaman = $_GET['kembali'];

    $q = mysqli_query($koneksi, "
        SELECT peminjaman.*
        FROM peminjaman
        JOIN pengguna ON peminjaman.id_user = pengguna.id
        WHERE peminjaman.id = '$id_peminjaman'
        AND pengguna.username = '$username'
        AND peminjaman.status = 'dipinjam'
    ");

    $pinjam = mysqli_fetch_assoc($q);

    if ($pinjam) {
        $id_buku = $pinjam['id_buku'];

        mysqli_query($koneksi, "
            UPDATE peminjaman
            SET status = 'dikembalikan',
                tanggal_kembali = CURDATE()
            WHERE id = '$id_peminjaman'
        ");

        mysqli_query($koneksi, "
            UPDATE buku
            SET stok = stok + 1
            WHERE id = '$id_buku'
        ");
    }

    header("Location: form-pengembalian.php");
    exit;
}

$data = mysqli_query($koneksi, "
    SELECT peminjaman.*, buku.judul
    FROM peminjaman
    JOIN buku ON peminjaman.id_buku = buku.id
    JOIN pengguna ON peminjaman.id_user = pengguna.id
    WHERE pengguna.username = '$username'
    AND peminjaman.status = 'dipinjam'
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pengembalian Buku</title>
</head>
<body>

<h2>Pengembalian Buku</h2>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['tanggal_pinjam'] ?></td>
    <td>
        <a href="?kembali=<?= $row['id'] ?>"
           onclick="return confirm('Yakin kembalikan buku ini?')">
           Kembalikan
        </a>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="dashboard-anggota.php">Kembali</a>

</body>
</html>
