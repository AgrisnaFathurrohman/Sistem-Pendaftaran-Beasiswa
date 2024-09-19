<?php
$servername = "localhost";  // Server MySQL Anda
$username = "root";         // Username MySQL
$password = "";             // Password MySQL
$dbname = "beasiswa_db"; // Nama database

// Membuat koneksi ke MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
