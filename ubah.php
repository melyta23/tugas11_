<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} 
include 'koneksi.php';
$No_hp = $_GET['No_hp'];
$query = mysqli_query($koneksi, "SELECT * FROM bioskop WHERE No_hp='$No_hp'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $Film       = $_POST['Film'];
    $Jadwal     = $_POST['Jadwal'];
    $Penonton   = $_POST['Penonton'];
    $Tiket      = $_POST['Tiket'];
    $No_hp      = $_POST['No_hp'];       // No_hp baru
    $Umur       = $_POST['Umur'];
    $No_hp_lama = $_POST['No_hp_lama'];  // No_hp lama (hidden)

    $update = mysqli_query($koneksi, "UPDATE bioskop SET 
                Film='$Film', 
                Jadwal='$Jadwal', 
                Penonton='$Penonton', 
                Tiket='$Tiket',
                No_hp='$No_hp',
                Umur='$Umur'
              WHERE No_hp='$No_hp_lama'");

    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
      <input type="hidden" name="No_hp_lama" value="<?= $data['No_hp']; ?>">

      <div class="mb-3">
        <label class="form-label">Film</label>
        <input type="text" class="form-control" name="Film" value="<?= $data['Film']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Jadwal</label>
        <input type="text" class="form-control" name="Jadwal" value="<?= $data['Jadwal']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Penonton</label>
        <input type="text" class="form-control" name="Penonton" value="<?= $data['Penonton']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Tiket</label>
        <input type="text" class="form-control" name="Tiket" value="<?= $data['Tiket']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">No Hp</label>
        <input type="text" class="form-control" name="No_hp" value="<?= $data['No_hp']; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Umur</label>
        <input type="text" class="form-control" name="Umur" value="<?= $data['Umur']; ?>">
      </div>

      <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
    </form>
  </div>
</div>

</body>
</html>
