<?php
include 'koneksi.php'; // Menghubungkan file koneksi.php untuk koneksi ke database

// Mengambil data dari tabel 'pendaftaran' di database
$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql); // Menjalankan query dan menyimpan hasilnya dalam variabel $result
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"> <!-- Menetapkan karakter encoding ke UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Memastikan halaman responsif terhadap perangkat -->
  <title>BEASISWA</title> <!-- Judul halaman -->
  <link rel="stylesheet" href="Assets/CSS/hsl.css"> <!-- Menautkan file CSS eksternal -->
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-container">
      <a href="#" class="nav-toggle" onclick="toggleMenu()">&#9776;</a> <!-- Toggle button -->
      <ul class="nav-menu">
        <li><a href="pilihbeasiswa.php">Pilihan Beasiswa</a></li>
        <li><a href="pilihbeasiswa.php">Daftar</a></li>
        <li><a href="hasil.php" class="active">Hasil</a></li>
      </ul>
    </div>
  </nav>

  <div class="results-container">
    <h2>Hasil Pendaftaran</h2>

    <!-- Wrapper untuk tabel -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor HP</th>
            <th>Semester</th>
            <th>IPK</th>
            <th>Beasiswa</th>
            <th>Berkas</th>
            <th class="center-align">Status</th>
            <th class="center-align">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Looping melalui setiap baris data dari hasil query -->
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['nama']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['hp']); ?></td>
              <td class="center-align"><?php echo htmlspecialchars($row['semester']); ?></td>
              <td class="center-align"><?php echo htmlspecialchars($row['ipk']); ?></td>
              <td class="center-align"><?php echo htmlspecialchars($row['beasiswa']); ?></td>
              <td class="center-align"><a href="Assets/uploads/<?php echo htmlspecialchars($row['berkas']); ?>" target="_blank">Lihat Berkas</a></td>
              <td id="status-<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['status']); ?></td>
              <td>
                <?php if ($row['status'] == 'Diajukan'): ?>
                  <button onclick="updateStatus(<?php echo $row['id']; ?>, 'Disetujui')" class="btn-status blue">Setujui</button>
                <?php elseif ($row['status'] == 'Disetujui'): ?>
                  <button onclick="updateStatus(<?php echo $row['id']; ?>, 'Diajukan')" class="btn-status red">Batalkan</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <?php
    $conn->close();
    ?>
  </div>

  <!-- Menyertakan file JavaScript eksternal untuk interaksi -->
  <script src="Assets/JS/script.js"></script>
</body>

</html>