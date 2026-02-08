<?php
include "../koneksi.php";

$user = mysqli_query($koneksi, "SELECT * FROM pengguna");
$buku = mysqli_query($koneksi, "SELECT * FROM buku");

if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "
        INSERT INTO peminjaman 
        (id_user, id_buku, tanggal_pinjam, tanggal_kembali, status)
        VALUES
        ('$id_user','$id_buku','$tgl_pinjam','$tgl_kembali','$status')
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
</head>
<body>

<h2>Tambah Data Peminjaman</h2>

<form method="post">
    <label>Nama User</label><br>
    <select name="id_user" required>
        <option value="">-- Pilih User --</option>
        <?php while ($u = mysqli_fetch_assoc($user)) { ?>
            <option value="<?= $u['id'] ?>"><?= $u['username'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Buku</label><br>
    <select name="id_buku" required>
        <option value="">-- Pilih Buku --</option>
        <?php while ($b = mysqli_fetch_assoc($buku)) { ?>
            <option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
        <?php } ?>
    </select><br><br>

    <label>Tanggal Pinjam</label><br>
    <input type="date" name="tanggal_pinjam" required><br><br>

    <label>Tanggal Kembali</label><br>
    <input type="date" name="tanggal_kembali"><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Dipinjam">Dipinjam</option>
        <option value="Dikembalikan">Dikembalikan</option>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

</body>
</html>
