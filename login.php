<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);  // md5, bisa diganti password_hash

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {font-family: Arial; background: #f2f2f2; display:flex; justify-content:center; align-items:center; height:100vh;}
        form {background:#fff; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
        input {display:block; width:100%; margin-bottom:10px; padding:10px;}
        button {padding:10px; width:100%; background:#007bff; color:white; border:none; border-radius:5px;}
        .error {color:red; text-align:center;}
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</body>
</html>