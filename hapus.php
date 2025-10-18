<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

$status = ""; // Default status kosong

if (isset($_GET['id'])) {  // Ganti dari No_hp ke id
    $id = mysqli_real_escape_string($koneksi, $_GET['id']); // Aman dari SQL injection

    $query = mysqli_query($koneksi, "DELETE FROM bioskop WHERE id='$id'");

    $status = $query ? "success" : "error";

    if (!$query) { // Debug jika query gagal
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
        }
        h2 { margin-bottom: 10px; color: #333; }
        p { font-size: 15px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .btn {
            display: inline-block;
            margin-top: 15px;
            background: #2575fc;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn:hover { background: #1a5edb; }
    </style>
</head>
<body>
    <div class="card">
        <?php if ($status == "success"): ?>
            <h2>Berhasil 🎉</h2>
            <p class="success">Data berhasil dihapus!</p>
        <?php elseif ($status == "error"): ?>
            <h2>Gagal ❌</h2>
            <p class="error">Data gagal dihapus!</p>
        <?php else: ?>
            <h2>Ups ⚠</h2>
            <p class="error">ID tidak ditemukan atau tidak dikirim!</p>
        <?php endif; ?>
        <a href="index.php" class="btn">← Kembali ke Data</a>
    </div>
</body>
</html>
