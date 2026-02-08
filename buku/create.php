<?php

include __DIR__.'/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO buku (judul, pengarang, stok) VALUES (?,?,?)";
    $result = $koneksi->execute_query($sql,[$judul, $pengarang, $stok]);

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menambahkan buku.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah buku</h1>

    <form action="" method="post">
        <div class="form-item">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul">
        </div>
        <div class="form-item">
            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" id="pengarang">
        </div>
        <div class="form-item">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok">
        </div>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>