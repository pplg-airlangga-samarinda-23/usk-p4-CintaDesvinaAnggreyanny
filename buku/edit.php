<?php

include __DIR__.'/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM buku WHERE id = ?";
    $book = $koneksi->execute_query($sql, [$id])->fetch_assoc();

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];
    $id = $_POST['id'];

    $sql = "UPDATE buku SET judul = ?, pengarang = ?, stok = ? WHERE id = ?";
    $result = $koneksi->execute_query($sql, [$judul, $pengarang, $stok, $id]);

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal memperbarui buku.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form action="" method="post">
        <div class ="form-item">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" value="<?= $book['judul'] ?>">
        </div>
        <div class ="form-item">
            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" id="pengarang" value="<?= $book['pengarang'] ?>">
        </div>
        <div class ="form-item">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok" value="<?= $book['stok'] ?>">
        </div>
        <button type="submit">Update</button> <br>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>