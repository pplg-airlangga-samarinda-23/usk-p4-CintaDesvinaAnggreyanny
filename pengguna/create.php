<?php
include __DIR__ . '/../koneksi.php';

if (isset($_POST['simpan'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $koneksi->query(
        "INSERT INTO pengguna (username, password, role)
         VALUES ('$username', '$password', '$role')"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
</head>
<body>

<h2>Tambah Pengguna</h2>

<form method="post">
    Username <br>
    <input type="text" name="username" required><br><br>

    Password <br>
    <input type="password" name="password" required><br><br>

    Role <br>
    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="siswa">Siswa</option>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<a href="index.php">Kembali</a>

</body>
</html>
