<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];

$data = $koneksi->query(
    "SELECT * FROM pengguna WHERE id='$id'"
)->fetch_assoc();

if (isset($_POST['update'])) {

    $username = $_POST['username'];

    $koneksi->query(
        "UPDATE pengguna SET username='$username'
         WHERE id='$id'"
    );

    header("Location: index.php");
}
?>

<h2>Edit Pengguna</h2>

<form method="post">
    Username <br>
    <input type="text" name="username"
           value="<?= $data['username'] ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>
