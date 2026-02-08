<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM pengguna WHERE username='$username'"
    );

    if (mysqli_num_rows($query) == 1) {

        $data = mysqli_fetch_assoc($query);

        if (password_verify($password, $data['password'])) {

            $_SESSION['id']       = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role']     = $data['role'];

            if ($data['role'] == 'admin') {
                header("Location: dashboard-admin.php");
            } else {
                header("Location: dashboard-anggota.php");
            }
            exit;

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login Sistem</h2>
<?php
if (isset($error)) {
    echo "<p style='color:red'>$error</p>";
}
?>
<form method="post">
    Username
    <input type="text" name="username" required><br><br>

    Password
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>
<p>Belum punya akun? <a href="register.php">Register di sini</a></p>
    <a href="index.php">Kembali</a>

</body>
</html>
