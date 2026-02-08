<?php
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "
    SELECT * FROM peminjaman WHERE id='$id'
");
$row = mysqli_fetch_assoc($data);

$user = mysqli_query($koneksi, "SELECT * FROM pengguna");
$buku = mysqli_query($koneksi, "SELECT * FROM buku");

if (isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "
        UPDATE peminjaman SET
        id_user='$id_user',
        id_buku='$id_buku',
        tanggal_pinjam='$tgl_pinjam',
        tanggal_kembali='$tgl_kembali',
        status='$status'
        WHERE id='$id'
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
</head>
<body>

<h2>Edit Data Peminjaman</h2>

<form method="post">
    <label>User</label><br>
    <select name="id_user">
        <?php while ($u = mysqli_fetch_assoc($user)) { ?>
            <option value="<?= $u['id'] ?>"
                <?= $u['id']==$row['id_user'] ? 'selected' : '' ?>>
                <?= $u['username'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Buku</label><br>
    <select name="id_buku">
        <?php while ($b = mysqli_fetch_assoc($buku)) { ?>
            <option value="<?= $b['id'] ?>"
                <?= $b['id']==$row['id_buku'] ? 'selected' : '' ?>>
                <?= $b['judul'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <label>Tanggal Pinjam</label><br>
    <input type="date" name="tanggal_pinjam" value="<?= $row['tanggal_pinjam'] ?>"><br><br>

    <label>Tanggal Kembali</label><br>
    <input type="date" name="tanggal_kembali" value="<?= $row['tanggal_kembali'] ?>"><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Dipinjam" <?= $row['status']=="Dipinjam"?'selected':'' ?>>Dipinjam</option>
        <option value="Dikembalikan" <?= $row['status']=="Dikembalikan"?'selected':'' ?>>Dikembalikan</option>
    </select><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
