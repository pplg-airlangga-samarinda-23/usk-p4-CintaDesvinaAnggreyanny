<?php
include "koneksi.php";

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $role = "siswa";

    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM pengguna WHERE username='$username'"
    );

    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $insert = mysqli_query(
            $koneksi,
            "INSERT INTO pengguna (username, password, role)
             VALUES ('$username', '$password_hash', '$role')"
        );

        if ($insert) {
            $success = "Registrasi berhasil! Silakan login.";
        } else {
            $error = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register Siswa</h2>

<form method="post">
    Username <br>
    <input type="text" name="username" required><br><br>

    Password <br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Daftar</button>
</form>

<?php
if (isset($error)) {
    echo "<p style='color:red'>$error</p>";
}

if (isset($success)) {
    echo "<p style='color:green'>$success</p>";
}
?>

<br>
<p>Sudah punya akun? <a href="login.php">Login</a></p>

</body>
</html>
