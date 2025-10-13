<?php
session_start();

// Hapus semua data sesi
$_SESSION = [];
session_unset();
session_destroy();

// Setelah 2 detik, otomatis ke login.php
header("refresh:2;url=login.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f8d7e3, #fce8ef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logout-box {
            background: white;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            animation: fadeIn 0.8s ease;
        }
        .logout-box h2 {
            color: #e85b81;
            margin-bottom: 10px;
        }
        .logout-box p {
            color: #666;
            font-size: 14px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="logout-box">
        <h2>Berhasil Logout 💖</h2>
        <p>Kamu akan diarahkan ke halaman login...</p>
    </div>
</body>
</html>