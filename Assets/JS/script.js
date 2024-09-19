//Menyembunyikan tombol submit dan Opsi Beasiswa
document.getElementById('ipk').addEventListener('change', function() {
  const selectedIPK = parseFloat(this.value); // Ambil nilai IPK yang dipilih
  const notification = document.getElementById('notification');
  const optionsSection = document.getElementById('options-section');

  // Tampilkan notifikasi jika IPK kurang dari 3.0
  if (selectedIPK < 3.0) {
      notification.innerHTML = "IPK Anda tidak mencukupi persyaratan.";
      notification.classList.remove('hidden');
      optionsSection.classList.add('hidden'); // Sembunyikan bagian pilihan beasiswa
  } else {
      // Jika IPK 3.0 atau lebih, sembunyikan notifikasi dan tampilkan pilihan beasiswa
      notification.classList.add('hidden'); // Sembunyikan notifikasi
      optionsSection.classList.remove('hidden'); // Tampilkan opsi beasiswa
  }
});

//Toggle Menu
function toggleMenu() {
  const menu = document.querySelector('.nav-menu');
  menu.classList.toggle('active');
}

//Update Status
function updateStatus(id, status) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "hasil.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        document.getElementById('status-' + id).textContent = status;

        const actionCell = document.querySelector(`#status-${id}`).closest('tr').querySelector('td:last-child');
        actionCell.innerHTML = status === 'Diajukan' ?
          '<button onclick="updateStatus(' + id + ', \'Disetujui\')" class="btn-status blue">Setujui</button>' :
          '<button onclick="updateStatus(' + id + ', \'Diajukan\')" class="btn-status red">Batalkan</button>';
      } else {
        console.error('Failed to update status');
      }
    }
  };

  xhr.send("id=" + id + "&status=" + status);
}