<?php
session_start(); // Memulai sesi, berguna untuk mengambil data sesi yang telah disimpan sebelumnya
include 'koneksi.php'; // Menyertakan file koneksi.php yang berisi kode untuk menghubungkan ke database

// Mengambil nilai dari sesi, jika tidak ada nilai yang disimpan, maka default adalah string kosong
$ipk = isset($_SESSION['ipk']) ? $_SESSION['ipk'] : '';
$beasiswa = isset($_SESSION['beasiswa']) ? $_SESSION['beasiswa'] : '';

// Memeriksa apakah form telah disubmit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Mengambil data dari form
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $hp = $_POST['hp'];
  $semester = $_POST['semester'];
  $berkas = $_FILES['berkas']['name']; // Mengambil nama file yang diupload
  $target_dir = "Assets/uploads/"; // Direktori tempat menyimpan file yang diupload
  $target_file = $target_dir . basename($berkas); // Path lengkap file yang akan diupload

  // Memeriksa apakah direktori upload ada, jika tidak ada, maka membuatnya
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true); // Membuat direktori baru dengan hak akses 0755
  }

  // Memindahkan file yang diupload ke direktori target
  if (move_uploaded_file($_FILES['berkas']['tmp_name'], $target_file)) {
    // Menyusun query SQL untuk memasukkan data ke database
    $sql = "INSERT INTO pendaftaran (nama, email, hp, semester, ipk, beasiswa, berkas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Menyiapkan statement SQL
    $stmt->bind_param("sssdsss", $nama, $email, $hp, $semester, $ipk, $beasiswa, $berkas); // Mengikat parameter ke statement

    // Menjalankan query dan memeriksa hasilnya
    if ($stmt->execute()) {
      // Jika berhasil, redirect ke halaman hasil.php
      header("Location: hasil.php");
      exit; // Menghentikan eksekusi script setelah redirect
    } else {
      // Menampilkan pesan error jika query gagal
      echo "Error: " . $stmt->error;
    }
  } else {
    // Menampilkan pesan error jika file gagal dipindahkan
    echo "Error: Unable to move uploaded file.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BEASISWA</title>
  <link rel="stylesheet" href="Assets/CSS/dftar.css"> <!-- Menghubungkan file CSS untuk styling halaman -->
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-container">
      <a href="#" class="nav-toggle" onclick="toggleMenu()">&#9776;</a> <!-- Toggle button -->
      <ul class="nav-menu">
        <li><a href="pilihbeasiswa.php">Pilihan Beasiswa</a></li>
        <li><a href="pilihbeasiswa.php" class="active">Daftar</a></li>
        <li><a href="hasil.php">Hasil</a></li>
      </ul>
    </div>
  </nav>

  <div class="form-container">
    <h2>Form Registrasi Pendaftaran</h2>
    <form action="daftar.php" method="POST" enctype="multipart/form-data">
      <label for="nama">Masukan Nama</label>
      <input type="text" id="nama" name="nama" maxlength="40" required> <!-- Input untuk nama, wajib diisi -->

      <label for="email">Masukan Email</label>
      <input type="email" id="email" name="email" required> <!-- Input untuk email, wajib diisi -->

      <label for="hp">Nomor HP</label>
      <input type="tel" id="hp" name="hp" maxlength="13" required> <!-- Input untuk nomor HP dengan format yang ditentukan -->

      <label for="semester">Semester Saat Ini</label>
      <select id="semester" name="semester" required>
        <option value="" disabled selected>Pilih Semester</option> <!-- Pilihan semester dari 1 sampai 8 -->
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
      </select>

      <label for="ipk">IPK Terakhir</label>
      <input type="text" id="ipk" name="ipk" value="<?php echo htmlspecialchars($ipk); ?>" disabled> <!-- Menampilkan IPK terakhir dari sesi -->

      <label for="beasiswa">Pilihan Beasiswa</label>
      <input type="text" id="beasiswa" name="beasiswa" value="<?php echo htmlspecialchars($beasiswa); ?>" disabled> <!-- Menampilkan pilihan beasiswa dari sesi -->

      <label for="berkas">Upload Berkas</label>
      <input type="file" id="berkas" name="berkas" accept=".pdf,.doc,.docx" required> <!-- Input untuk upload berkas dengan format yang diterima -->

      <button type="submit" name="submit">Daftar</button> <!-- Tombol untuk submit form -->
    </form>
  </div>
    <!-- Menyertakan file JavaScript eksternal untuk interaksi -->
    <script src="Assets/JS/script.js"></script>
</body>

</html>