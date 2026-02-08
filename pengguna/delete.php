<?php
include __DIR__ . '/../koneksi.php';

$id = $_GET['id'];

$koneksi->query(
    "DELETE FROM pengguna WHERE id='$id' AND role='siswa'"
);

header("Location: index.php");
