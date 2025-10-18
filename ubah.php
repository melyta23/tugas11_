<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Cek id
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM bioskop WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data dengan ID $id tidak ditemukan!");
}

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $Film       = mysqli_real_escape_string($koneksi, $_POST['Film']);
    $Jadwal     = mysqli_real_escape_string($koneksi, $_POST['Jadwal']);
    $Penonton   = mysqli_real_escape_string($koneksi, $_POST['Penonton']);
    $Tiket      = mysqli_real_escape_string($koneksi, $_POST['Tiket']);
    $No_hp      = mysqli_real_escape_string($koneksi, $_POST['No_hp']);
    $Umur       = mysqli_real_escape_string($koneksi, $_POST['Umur']);

    $update = mysqli_query($koneksi, "UPDATE bioskop SET 
                Film='$Film', 
                Jadwal='$Jadwal', 
                Penonton='$Penonton', 
                Tiket='$Tiket',
                No_hp='$No_hp',
                Umur='$Umur'
              WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
        exit();
    } else {
        die("Gagal update: " . mysqli_error($koneksi));
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Data Bioskop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(to right, #ffecd2, #fcb69f);">

<div class="container py-5">
  <div class="card shadow-lg p-4 mx-auto" style="max-width: 500px;">
    <h3 class="text-center mb-4">Ubah Data Bioskop</h3>
    
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Film</label>
        <input type="text" class="form-control" name="Film" value="<?= htmlspecialchars($data['Film'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Jadwal</label>
        <input type="text" class="form-control" name="Jadwal" value="<?= htmlspecialchars($data['Jadwal'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Penonton</label>
        <input type="text" class="form-control" name="Penonton" value="<?= htmlspecialchars($data['Penonton'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Tiket</label>
        <input type="text" class="form-control" name="Tiket" value="<?= htmlspecialchars($data['Tiket'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">No HP</label>
        <input type="text" class="form-control" name="No_hp" value="<?= htmlspecialchars($data['No_hp'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Umur</label>
        <input type="text" class="form-control" name="Umur" value="<?= htmlspecialchars($data['Umur'] ?? ''); ?>">
      </div>

      <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
    </form>
  </div>
</div>

</body>
</html>
