<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include "koneksi.php";

// 🔧 Ambil data dari tabel bioskop
$query = mysqli_query($koneksi, "SELECT * FROM bioskop");
if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Data Bioskop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 10px;
      padding: 10px 20px;
      margin-bottom: 30px;
    }
    .navbar .logout-btn {
      background: #ff79f4ff;
      border: none;
      color: white;
      border-radius: 8px;
      padding: 6px 15px;
      transition: 0.3s;
    }
    .navbar .logout-btn:hover {
      background: #d40325ff;
      transform: scale(1.05);
    }
    .card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<div class="container py-4">
  <!-- 🔹 Navbar -->
  <div class="navbar d-flex justify-content-between align-items-center">
    <h5 class="text-white mb-0">
      <i class="bi bi-person-circle"></i> Hai, <?= htmlspecialchars($_SESSION['username']); ?>!
    </h5>
    <a href="logout.php" class="logout-btn">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>

  <!-- 🔹 Card Tabel -->
  <div class="card shadow-lg p-4 rounded-4">
    <h3 class="text-center mb-4 text-primary"><i class="bi bi-film"></i> Daftar Data Bioskop</h3>

    <a href="tambah.php" class="btn btn-success mb-3">
      <i class="bi bi-plus-circle"></i> Tambah Data
    </a>

    <table class="table table-bordered text-center align-middle">
      <thead class="table-primary">
        <tr>
          <th>Film</th>
          <th>Jadwal</th>
          <th>Penonton</th>
          <th>Tiket</th>
          <th>No HP</th>
          <th>Umur</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($query) > 0): ?>
          <?php while($data = mysqli_fetch_assoc($query)) { ?>
          <tr>
            <td><?= htmlspecialchars($data['Film']); ?></td>
            <td><?= htmlspecialchars($data['Jadwal']); ?></td>
            <td><?= htmlspecialchars($data['Penonton']); ?></td>
            <td><?= htmlspecialchars($data['Tiket']); ?></td>
            <td><?= htmlspecialchars($data['No_hp']); ?></td>
            <td><?= htmlspecialchars($data['Umur']); ?></td>
            <td>
              <a href="ubah.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i> Ubah
              </a>
              <a href="hapus.php?id=<?= $data['id']; ?>" 
                 onclick="return confirm('Yakin hapus data ini?')" 
                 class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i> Hapus
              </a>
            </td>
          </tr>
          <?php } ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-muted">Belum ada data bioskop</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
