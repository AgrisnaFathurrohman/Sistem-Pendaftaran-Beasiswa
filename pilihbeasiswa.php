<?php
session_start(); // Memulai sesi PHP agar bisa menyimpan data antar halaman

// Mengecek apakah metode pengiriman data adalah POST (form telah disubmit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Mendapatkan nilai yang dikirimkan dari form
  $ipk = $_POST['ipk']; // Mengambil nilai IPK dari form
  $beasiswa = $_POST['beasiswa']; // Mengambil jenis beasiswa dari form

  // Menyimpan data IPK dan beasiswa ke dalam sesi (session)
  $_SESSION['ipk'] = $ipk;
  $_SESSION['beasiswa'] = $beasiswa;

  // Mengarahkan (redirect) pengguna ke halaman daftar.php setelah data disimpan
  header("Location: daftar.php");
  exit; // Menghentikan eksekusi skrip setelah redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BEASISWA</title>
  <!-- Menyertakan file CSS eksternal untuk styling -->
  <link rel="stylesheet" href="Assets/CSS/plhbeasiswa.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-container">
      <a href="#" class="nav-toggle" onclick="toggleMenu()">&#9776;</a> <!-- Toggle button -->
      <ul class="nav-menu">
        <li><a href="pilihbeasiswa.php" class="active">Pilihan Beasiswa</a></li>
        <li><a href="pilihbeasiswa.php">Daftar</a></li>
        <li><a href="hasil.php">Hasil</a></li>
      </ul>
    </div>
  </nav>

  <!-- Konten Utama -->
  <div class="main-content">
    <h2>Pilih Jenis Beasiswa</h2> <!-- Judul dari halaman -->

    <!-- Form untuk memilih IPK dan jenis beasiswa -->
    <form class="form-beasiswa" id="beasiswa-form" method="POST">
      <!-- Dropdown untuk memilih IPK -->
      <label for="ipk">Pilih IPK:</label>
      <select id="ipk" name="ipk" required>
        <option value="" disabled selected>-- Pilih IPK --</option> <!-- Placeholder -->
        <option value="2.9">≤ 3</option> <!-- Opsi untuk nilai IPK -->
        <option value="3.0">3.0</option>
        <option value="3.1">3.1</option>
        <option value="3.2">3.2</option>
        <option value="3.3">3.3</option>
        <option value="3.4">3.4</option>
        <option value="3.5">≥ 3.5</option> <!-- Opsi untuk IPK lebih besar dari 3.5 -->
      </select>

      <!-- Notifikasi jika diperlukan (misalnya validasi form) -->
      <div id="notification" class="notification hidden"></div>

      <!-- Bagian pilihan jenis beasiswa: Akademik atau Non-Akademik -->
      <div id="options-section" class="hidden">
        <div class="radio-group">
          <label>
            <input type="radio" name="beasiswa" value="akademik" onclick="toggleOptions('akademik')">
            <!-- Custom radio button untuk Akademik -->
            <span class="custom-radio"></span> Akademik
          </label>
          <label>
            <input type="radio" name="beasiswa" value="non-akademik" onclick="toggleOptions('non-akademik')">
            <!-- Custom radio button untuk Non-Akademik -->
            <span class="custom-radio"></span> Non-Akademik
          </label>
        </div>

        <!-- Tombol untuk submit form -->
        <button type="submit" class="submit-btn">Submit</button>
      </div>

    </form>
  </div>

  <!-- Menyertakan file JavaScript eksternal untuk interaksi -->
  <script src="Assets/JS/script.js"></script>
</body>

</html>