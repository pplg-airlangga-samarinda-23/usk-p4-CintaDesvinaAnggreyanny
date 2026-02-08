<?php
session_start();
include "../koneksi.php";

$data = mysqli_query($koneksi, "
    SELECT peminjaman.*, 
           buku.judul, 
           pengguna.username
    FROM peminjaman
    JOIN buku ON peminjaman.id_buku = buku.id
    JOIN pengguna ON peminjaman.id_user = pengguna.id
    ORDER BY peminjaman.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
</head>
<body>
    <h2>Data Peminjaman & Pengembalian</h2>
    <a href="create.php">Tambah</a>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Judul Buku</th>
    <th>Tgl Pinjam</th>
    <th>Tgl Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['tanggal_pinjam'] ?></td>
    <td><?= $row['tanggal_kembali'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $row['id'] ?>"
            onclick="return confirm('Yakin hapus data?')">
            Hapus
        </a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
