<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = mysqli_query($koneksi, "SELECT * FROM bioskop WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data dengan ID $id tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $film       = mysqli_real_escape_string($koneksi, $_POST['film']);
    $jadwal     = mysqli_real_escape_string($koneksi, $_POST['jadwal']);
    $penonton   = mysqli_real_escape_string($koneksi, $_POST['penonton']);
    $tiket      = mysqli_real_escape_string($koneksi, $_POST['tiket']);
    $No_hp      = mysqli_real_escape_string($koneksi, $_POST['No_hp']);
    $Umur       = mysqli_real_escape_string($koneksi, $_POST['Umur']);

    $update = mysqli_query($koneksi, "UPDATE bioskop SET 
                film='$film', 
                jadwal='$jadwal', 
                penonton='$penonton', 
                tiket='$tiket',
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
        <label class="form-label">film</label>
        <input type="text" class="form-control" name="film" value="<?= htmlspecialchars($data['film'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">jadwal</label>
        <input type="text" class="form-control" name="jadwal" value="<?= htmlspecialchars($data['jadwal'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">penonton</label>
        <input type="text" class="form-control" name="penonton" value="<?= htmlspecialchars($data['penonton'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">tiket</label>
        <input type="text" class="form-control" name="tiket" value="<?= htmlspecialchars($data['tiket'] ?? ''); ?>">
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
