 <?php
// File ini sengaja TIDAK mengubah fitur apa pun
// Hanya agar server mengenali sebagai file PHP
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Petugas — E-WargaBantuan</title>

  <style>
    :root {
      --c1: #A8E8F9;
      --c2: #00537A;
      --c3: #013C58;
      --c4: #F5A201;
      --danger: #c0392b;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, sans-serif;
    }

    body {
      min-height: 100vh;
      background: #f5f7fa;
      display: flex;
    }

    .sidebar {
      width: 240px;
      background: var(--c3);
      color: white;
      padding: 24px;
    }

    .sidebar h2 {
      margin-bottom: 32px;
      text-align: center;
    }

    .menu a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px 14px;
      border-radius: 8px;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .menu a:hover {
      background: rgba(255, 255, 255, .15);
    }

    .main {
      flex: 1;
      padding: 32px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      margin-bottom: 32px;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 32px;
    }

    .card {
      background: white;
      padding: 24px;
      border-radius: 16px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, .08);
    }

    .card h3 {
      font-size: 15px;
      color: var(--c2);
      margin-bottom: 6px;
    }

    .card .value {
      font-size: 28px;
      font-weight: 800;
      color: var(--c3);
    }

    .table-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .btn-add {
      background: var(--c4);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
    }

    table {
      width: 100%;
      background: white;
      border-radius: 16px;
      border-collapse: collapse;
      overflow: hidden;
      box-shadow: 0 8px 18px rgba(0, 0, 0, .08);
      table-layout: auto;
    }

    th,
    td {
      padding: 14px 16px;
      font-size: 14px;
      vertical-align: middle;
    }

    th {
      background: var(--c3);
      color: white;
      text-align: center;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    .status {
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 700;
      color: white;
      background: var(--c2);
      min-width: 90px;
      text-align: center;
    }

    .status-center,
    .aksi-center {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 6px;
    }

    .btn-edit {
      background: var(--c2);
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 12px;
      cursor: pointer;
    }

    .btn-delete {
      background: var(--danger);
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 12px;
      cursor: pointer;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .6);
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
      overflow-x: auto; 
      z-index: 9999;
    }

    .modal-box {
      background: white;
      padding: 28px;
      border-radius: 18px;
      width: 100%;
      max-width: 480px;
      max-height: 90vh;      
      overflow-y: auto; 
      box-shadow: 0 25px 50px rgba(0, 0, 0, .3);
    }

    .modal-box input, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .form-actions {
      display: flex;
      gap: 10px;
    }

    .btn-cancel {
      background: #ccc;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <aside class="sidebar">
    <h2>E-WargaBantuan</h2>
    <div class="menu">
      <a href="dashboard.php">Dashboard</a>
      <a href="index.html">Logout</a>
    </div>
  </aside>

  <main class="main">

    <div class="topbar">
      <h1>Dashboard Petugas</h1>
      <div>Halo, Admin</div>
    </div>

    <section class="cards">
      <div class="card">
        <h3>Total Penerima</h3>
        <div class="value" id="total">0</div>
      </div>

      <div class="card">
        <h3>Disalurkan</h3>
        <div class="value" id="disalurkan">0</div>
      </div>

      <div class="card">
        <h3>Diterima</h3>
        <div class="value" id="diterima">0</div>
      </div>
    </section>

    <div class="table-head">
      <h2>Data Penerima Bantuan Sosial</h2>
      <button class="btn-add" onclick="openForm()">+ Tambah Data</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>NIK</th>
          <th>Nama</th>
          <th>Jenis Bantuan</th>
          <th>Alamat</th>
          <th>Periode</th>
          <th>Status</th>
          <th>Lokasi Penyaluran</th>
          <th>Waktu Penyaluran</th>
          <th>Status Tracking</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="table-data"></tbody>
    </table>

  </main>

  <div class="modal-overlay" id="modalForm">
    <div class="modal-box">
      <h3>Form Data Penerima Bantuan</h3>

      <form method="post" action="api/penerima/penerima.php">
        <input type="text" name="nik" placeholder="NIK" maxlength="16" required>
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="rt" placeholder="RT" required>
        <input type="text" name="rw" placeholder="RW" required>
        <input type="text" name="desa_kelurahan" placeholder="Desa/Kelurahan" required>
        <input type="text" name="kecamatan" placeholder="kecamatan" required>
        <input type="text" name="kabupaten_kota" placeholder="Kabupaten/Kota" required>
         <input type="text" name="provinsi" placeholder="Provinsi" required>

        <label>Jenis Bantuan</label>
        <select name="id_bansos" id="add_id_bansos" required>
          <option value="">-- Pilih Bansos --</option>
          <option value="1">PKH</option>
          <option value="2">BPNT</option>
          <option value="3">KIS</option>
          <option value="4">BPUM</option>
          <option value="5">BSU</option>
        </select>

        <label>Tanggal Penyaluran</label>
        <input type="date" name="tanggal_penyaluran" required>

        <label>Periode Bantuan</label>
        <input type="text" name="periode" placeholder="Contoh:2025" required>

        <label>Status Penyaluran</label>
        <select name="status" id="add_status" required>
          <option value="Tersalur">Tersalur</option>
          <option value="Belum Tersalur">Belum Tersalur</option>
        </select>

        <label>Status Tracking</label>
        <select name="status_tracking" id="add_status_tracking" required>
          <option value="Sudah Diterima">Sudah Diterima</option>
          <option value="Belum Diterima">Belum Diterima</option>
        </select>

        <div class="form-actions">
          <button type="button" class="btn-add" onclick="simpanData()">Simpan</button>
          <button type="button" class="btn-cancel" onclick="closeForm()">Batal</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT -->
<div class="modal-overlay" id="modalEdit">
  <div class="modal-box">
    <h3>Form Edit Data</h3>

    <input type="hidden" id="edit_id_penyaluran">

    <label>Jenis Bantuan</label>
    <select id="edit_id_bansos">
      <option value="1">PKH</option>
      <option value="2">BPNT</option>
      <option value="3">KIS</option>
      <option value="4">BPUM</option>
      <option value="5">BSU</option>
    </select>

    <label>Status Penyaluran</label>
    <select id="edit_status">
      <option value="Tersalur">Tersalur</option>
      <option value="Belum Tersalur">Belum Tersalur</option>
    </select>

    <label>Status Tracking</label>
    <select id="edit_status_tracking">
      <option value="Sudah diterima">Sudah diterima</option>
      <option value="Belum diterima">Belum diterima</option>
    </select>

    <label>Lokasi Penyaluran</label>
    <input type="text" id="edit_lokasi" name="lokasi" required>

    <label>Waktu Penerimaan</label>
    <input type="datetime-local" id="edit_waktu" name="waktu" required>

    <div class="form-actions">
      <button type="button" class="btn-add" onclick="simpanEdit()">Simpan</button>
      <button type="button" class="btn-cancel" onclick="closeEdit()">Batal</button>
    </div>
  </div>
</div>

<script>
function openForm() {
  document.getElementById("modalForm").style.display = "flex";
}
function closeForm() {
  document.getElementById("modalForm").style.display = "none";
}

function simpanData() {
  const form = document.querySelector("form");
  const formData = new FormData(form);

  fetch('api/penerima/penerima.php', {
    method: 'POST',
    body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Berhasil menyimpan');
            window.location.href = 'dashboard.php';
        } else {
            alert('Gagal menyimpan');
        }
    })
    .catch(err => {
        alert('Gagal menyimpan');
    });

}

document.addEventListener("DOMContentLoaded", function () {
  loadData();
});

function loadData() {
  fetch("api/penerima/penerima.php")
    .then(res => res.json())
    .then(data => {
      const tbody = document.getElementById("table-data");
      tbody.innerHTML = "";

      if (!data.length) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Data kosong</td></tr>`;
        return;
      }

      data.forEach(row => {
        tbody.innerHTML += `
        <tr>
          <td style="text-align:center;">${row.nik}</td>
          <td>${row.nama}</td>
          <td style="text-align:center;">${row.nama_bansos ?? '-'}</td>
          <td>${row.alamat}
          rt ${row.rt}/rw ${row.rw},
          desa_Kelurahan ${row.desa_kelurahan},
          Kecamatan ${row.kecamatan},
          ${row.kabupaten_kota},
          ${row.provinsi}</td>
          <td style="text-align:center;">${row.periode ?? '-'}</td>
          <td><div class="status-center"><span class="status">${row.status ?? '-'}</span></div></td>
          <td style="text-align:center;">${row.lokasi ?? '-'}</td> 
          <td style="text-align:center;">${row.waktu ?? '-'}</td>
          <td><div class="status-center"><span class="status">${row.status_tracking ?? '-'}</span></div></td>
          <td>
            <div class="aksi-center">
              <button class="btn-edit"onclick="openEdit(${row.id_penyaluran},${row.id_bansos},'${row.status}','${row.status_tracking}')">Edit</button>

              <button class="btn-delete"onclick="hapusData(${row.id_penerima})">Hapus</button>

            </div>
          </td>
        </tr>`;
      });
    });
}

fetch('api/penerima/count.php')
  .then(res => res.json())
  .then(data => {
    document.getElementById('total').innerText = data.total;
    document.getElementById('disalurkan').innerText = data.disalurkan;
    document.getElementById('diterima').innerText = data.diterima;
  });

function openEdit(id_penyaluran, id_bansos, status, status_tracking, lokasi, waktu) {
  document.getElementById('edit_id_penyaluran').value = id_penyaluran;
  document.getElementById('edit_id_bansos').value = id_bansos;
  document.getElementById('edit_status').value = status;
  document.getElementById('edit_status_tracking').value = status_tracking;
  document.getElementById('edit_lokasi').value = lokasi ?? '';
  document.getElementById('edit_waktu').value = waktu ?? '';

  document.getElementById('modalEdit').style.display = 'flex';
}



function simpanEdit() {
  const data = {
    id_penyaluran: document.getElementById('edit_id_penyaluran').value,
    id_bansos: document.getElementById('edit_id_bansos').value,
    status: document.getElementById('edit_status').value,
    status_tracking: document.getElementById('edit_status_tracking').value,
    lokasi: document.getElementById('edit_lokasi').value,
    waktu: document.getElementById('edit_waktu').value

  };

  fetch('api/penerima/penerima.php', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    if (res.status === 'success') {
      closeEdit();
      loadData();
    }
  })
  .catch(err => {
    console.error(err);
    alert('Gagal update data');
  });
}



function closeEdit() {
  document.getElementById("modalEdit").style.display = "none";
}


  function hapusData(id) {
  if (!confirm("Yakin ingin menghapus data ini?")) return;

  fetch("api/penerima/penerima.php", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      id_penerima: id
    })
  })
  .then(res => res.json())
  .then(res => {
    alert(res.message);
    if (res.status === "success") {
      loadData();
    }
  })
  .catch(err => {
    console.error(err);
    alert("Gagal menghapus data");
  });
}


</script>

</body>
</html>
