<?php
$host = "localhost";
$user = "xirpl1-13";
$pass = "0089260734";
$db   ="db_xirpl1-13_2";

$koneksi = mysqli_connect ($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
