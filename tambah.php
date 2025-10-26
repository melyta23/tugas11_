<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "koneksi.php";

$message = "";  // Inisialisasi pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form (huruf kecil semua sesuai dengan name di input)
    $film     = $_POST['film'];
    $jadwal   = $_POST['jadwal'];
    $penonton = $_POST['penonton'];
    $tiket    = $_POST['tiket'];
    $No_hp    = $_POST['No_hp'];
    $Umur     = $_POST['Umur'];

    // Escape data untuk keamanan (minimal)
    $film = mysqli_real_escape_string($koneksi, $film);
    $jadwal = mysqli_real_escape_string($koneksi, $jadwal);
    $penonton = mysqli_real_escape_string($koneksi, $penonton);
    $tiket = mysqli_real_escape_string($koneksi, $tiket);
    $No_hp = mysqli_real_escape_string($koneksi, $No_hp);
    $Umur = mysqli_real_escape_string($koneksi, $Umur);

    // Query simpan data
    $query = mysqli_query($koneksi, "INSERT INTO bioskop (film, jadwal, penonton, tiket, No_hp, Umur) 
                                     VALUES ('$film', '$jadwal', '$penonton', '$tiket', '$No_hp', '$Umur')");

    if ($query) {
        $message = "success";
    } else {
        $message = "error";
        // Aktifkan baris di bawah ini kalau mau lihat error MySQL-nya
        // echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Data Bioskop</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 400px;
            animation: fadeIn 0.6s ease-in-out;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .input-group {
            margin-bottom: 18px;
        }
        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
            font-size: 14px;
        }
        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.4);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
        }
        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #667eea;
            font-size: 14px;
        }
        .back:hover {
            text-decoration: underline;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 14px;
        }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🎬 Tambah Data Bioskop</h2>

        <?php if ($message == "success"): ?>
            <p class="message success">✅ Data berhasil disimpan!</p>
        <?php elseif ($message == "error"): ?>
            <p class="message error">❌ Data gagal disimpan!</p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <input type="text" name="film" placeholder="film" required />
            </div>
            <div class="input-group">
                <input type="datetime-local" name="jadwal" required />
            </div>
            <div class="input-group">
                <input type="text" name="penonton" placeholder="penonton" required />
            </div>
            <div class="input-group">
                <input type="text" name="tiket" placeholder="tiket" required />
            </div>
            <div class="input-group">
                <input type="text" name="No_hp" placeholder="No_hp" required />
            </div>
            <div class="input-group">
                <input type="text" name="Umur" placeholder="Umur" required />
            </div>
            <button type="submit" class="btn">Simpan</button>
        </form>
        <a href="index.php" class="back">← Kembali</a>
    </div>
</body>
</html>
