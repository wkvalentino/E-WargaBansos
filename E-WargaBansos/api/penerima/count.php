<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../koneksi.php';

$data = [];

/* ===============================
   COUNTER ATAS
================================ */
$q1 = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM penerima");
$data['total'] = mysqli_fetch_assoc($q1)['total'];

$q2 = mysqli_query($mysqli, "SELECT COUNT(*) AS disalurkan FROM penyaluran WHERE status = 'Tersalur'");
$data['disalurkan'] = mysqli_fetch_assoc($q2)['disalurkan'];

$q3 = mysqli_query($mysqli, "SELECT COUNT(*) AS diterima FROM tracking WHERE status_tracking = 'Sudah Diterima'");
$data['diterima'] = mysqli_fetch_assoc($q3)['diterima'];

/* ===============================
   TABEL PER JENIS BANSOS
================================ */
$q4 = mysqli_query($mysqli, "
SELECT 
    b.nama_bansos,
    COUNT(DISTINCT p.id_penerima) AS total_penerima,
    COUNT(DISTINCT CASE 
        WHEN s.status = 'Tersalur' 
        THEN p.id_penerima END
    ) AS tersalur,
    COUNT(DISTINCT CASE 
        WHEN t.status_tracking = 'Sudah diterima' 
        THEN p.id_penerima END
    ) AS diterima
FROM penyaluran s
JOIN penerima p ON s.id_penerima = p.id_penerima
JOIN jenis_bansos b ON s.id_bansos = b.id_bansos
LEFT JOIN tracking t ON s.id_penyaluran = t.id_penyaluran
GROUP BY b.nama_bansos
");


$data['bansos'] = [];
while ($row = mysqli_fetch_assoc($q4)) {
    $data['bansos'][] = $row;
}

$total = $data['total'];
$disalurkan = $data['disalurkan'];

$persentase = 0;
if ($total > 0) {
    $persentase = round(($disalurkan / $total) * 100, 1);
}

$data['persentase'] = $persentase;


echo json_encode($data);
