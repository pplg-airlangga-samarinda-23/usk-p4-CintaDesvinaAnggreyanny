<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id'])) {
    header("Location: pengguna/index.php");
    exit;
}

$id_buku = $_GET['id'];
$id_user = $_SESSION['id'];

$koneksi->query(
    "UPDATE buku SET stok = stok - 1 WHERE id='$id_buku'"
);

$koneksi->query(
    "INSERT INTO peminjaman
    (id_user, id_buku, tanggal_pinjam, status)
    VALUES
    ('$id_user','$id_buku',NOW(),'dipinjam')"
);

header("Location: dashboard-anggota.php");
