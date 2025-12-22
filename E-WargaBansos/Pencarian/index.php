<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Hasil Pencarian — E-WargaBantuan</title>

  <style>
    :root {
      --c-1: #a8e8f9;
      --c-6: #ffd35b;
      --c-3: #013c58;
    }

    body {
      margin: 0;
      padding: 32px 16px;
      min-height: 100vh;
      background: linear-gradient(180deg, var(--c-6) 0%, var(--c-1) 100%);
      font-family: Inter, Arial;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .wrap {
      width: 100%;
      max-width: 900px;
    }

    h2 {
      text-align: center;
      font-size: 26px;
      font-weight: 800;
      margin-bottom: 20px;
    }

    .result-card {
      background: white;
      padding: 28px;
      border-radius: 18px;
      box-shadow: 0 8px 18px rgba(2, 6, 23, 0.08);
    }

    .status {
      display: inline-block;
      padding: 6px 14px;
      background: var(--c-3);
      color: white;
      border-radius: 8px;
      margin-left: 8px;
    }

    .btn-back {
      margin-top: 22px;
      background: var(--c-3);
      color: white;
      padding: 10px 20px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>

<?php
$nik = $_GET["nik"] ?? "";


// URL API
$api_url = "http://localhost/E-WargaBansos/api/penerima/penerima.php?nik=" . urlencode($nik);

// Ambil data dari API dengan error handling
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 10); // Timeout 10 detik

$response = curl_exec($curl);

// Cek jika ada error curl
if (curl_errno($curl)) {
    echo '<div class="wrap">
            <h2>Hasil Pencarian Bantuan Sosial</h2>
            <div class="result-card">
              <p>⚠️ Gagal menghubungi server. Silakan coba lagi nanti.</p>
              <button class="btn-back" onclick="history.back()">Kembali</button>
            </div>
          </div>';
    curl_close($curl);
    exit;
}

curl_close($curl);

$data = json_decode($response, true);

// DATA VALID JIKA ADA NIK - PERBAIKI LOGIKA INI
$found = null;
if ($data && is_array($data)) {
    // Cek beberapa kemungkinan struktur data
    if (isset($data['nik']) && !empty($data['nik'])) {
        $found = $data;
    } elseif (isset($data['data']['nik'])) {
        $found = $data['data'];
    } elseif (isset($data[0]['nik'])) {
        $found = $data[0];
    }
}
?>

<div class="wrap">
  <h2>Hasil Pencarian Bantuan Sosial</h2>

  <?php if ($found) { ?>
    <div class="result-card">
      <p><b>Nama:</b> <?= htmlspecialchars($found["nama"] ?? '-') ?></p>
      <p><b>NIK:</b> <?= htmlspecialchars($found["nik"] ?? '-') ?></p>

      <p><b>Alamat:</b>
        <?= htmlspecialchars($found["alamat"] ?? '-') ?>,
        RT <?= htmlspecialchars($found["rt"] ?? '-') ?> /
        RW <?= htmlspecialchars($found["rw"] ?? '-') ?>,
        <?= htmlspecialchars($found["desa_kelurahan"] ?? '-') ?>,
        <?= htmlspecialchars($found["kecamatan"] ?? '-') ?>,
        <?= htmlspecialchars($found["kabupaten_kota"] ?? '-') ?>,
        <?= htmlspecialchars($found["provinsi"] ?? '-') ?>
      </p>

      <p><b>Jenis Bantuan:</b> <?= htmlspecialchars($found["nama_bansos"] ?? '-') ?></p>
      <p><b>Periode:</b> <?= htmlspecialchars($found["periode"] ?? '-') ?></p>
      <p>
        <b>Status Penyaluran:</b>
        <span class="status"><?= htmlspecialchars($found["status"] ?? 'Tidak diketahui') ?></span>
      </p>
      <p><b>Waktu Penerimaan:</b> <?= htmlspecialchars($found["waktu"] ?? '-') ?></p>
      <p><b>Lokasi Penerimaan:</b> <?= htmlspecialchars($found["lokasi"] ?? '-') ?></p>
      <p><b>Status Penerimaan:</b> <?= htmlspecialchars($found["status_tracking"] ?? '-') ?></p>
      <button class="btn-back" onclick="history.back()">Kembali</button>
    </div>

  <?php } else { ?>
    <div class="result-card">
      <p>Data tidak ditemukan untuk NIK: <strong><?= htmlspecialchars($nik) ?></strong></p>
      <p style="color: #666; font-size: 14px; margin-top: 10px;">
        Pastikan NIK yang dimasukkan sudah benar (16 digit).
      </p>
      <button class="btn-back" onclick="history.back()">Kembali</button>
    </div>
  <?php } ?>
</div>

</body>
</html>