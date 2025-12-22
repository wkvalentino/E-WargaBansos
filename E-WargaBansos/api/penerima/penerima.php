<?php
header('Content-Type: application/json; charset=UTF-8');

$request = $_SERVER['REQUEST_METHOD'];

switch ($request){
    case 'GET':
        getmethod();
        break;

    case 'POST':
        postmethod();
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        putmethod($data);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        deletemethod($data);
        break;

    default:
        echo json_encode(["result"=>"invalid request"]);
}


/* ======================
   GET METHOD
====================== */
function getmethod(){
    include '../../koneksi.php';

    $where = "";

    if (isset($_GET['nik']) && $_GET['nik'] != '') {
        $nik = mysqli_real_escape_string($mysqli, $_GET['nik']);
        $where = "WHERE p.nik = '$nik'";
    }

    $sql = "
        SELECT 
        p.id_penerima,
        p.nik,
        p.nama,
        p.alamat,
        p.rt,
        p.rw,
        p.desa_kelurahan,
        p.kecamatan,
        p.kabupaten_kota,
        p.provinsi,
        s.id_penyaluran,          
        b.id_bansos,            
        b.nama_bansos,
        s.periode,
        s.status,
		t.waktu,
        t.lokasi,
        t.status_tracking
        FROM penerima p
        LEFT JOIN penyaluran s ON p.id_penerima = s.id_penerima
        LEFT JOIN jenis_bansos b ON s.id_bansos = b.id_bansos
        LEFT JOIN tracking t ON s.id_penyaluran = t.id_penyaluran
     
        $where
    ";

    $res = mysqli_query($mysqli, $sql);

    $rows = [];
    while($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }

    echo json_encode($rows);
}



/* ======================
   POST METHOD
====================== */
function postmethod(){
    include '../../koneksi.php';

    // DATA PENERIMA
    $nik            = $_POST['nik'] ?? '';
    $nama           = $_POST['nama'] ?? '';
    $alamat         = $_POST['alamat'] ?? '';
    $rt             = $_POST['rt'] ?? '';
    $rw             = $_POST['rw'] ?? '';
    $desa_kelurahan = $_POST['desa_kelurahan'] ?? '';
    $kecamatan      = $_POST['kecamatan'] ?? '';
    $kabupaten_kota = $_POST['kabupaten_kota'] ?? '';
    $provinsi       = $_POST['provinsi'] ?? '';

    // DATA PENYALURAN
    $id_bansos      = $_POST['id_bansos'] ?? '';
     $periode        = $_POST['periode'] ?? '';
    $tanggal_penyaluran = $_POST['tanggal_penyaluran'] ?? '';
    $status         = $_POST['status'] ?? '';
   
    // DATA TRACKING
    $status_tracking = $_POST['status_tracking'] ?? '';
    $waktu          = $_POST['waktu'] ?? '';
    $lokasi         = $_POST['lokasi'] ?? '';

    if (
        $nik == '' || $nama == '' || $alamat == '' ||
        $id_bansos == '' || $status == '' || $status_tracking == ''
    ) {
        echo json_encode([
            "status" => "error",
            "message" => "Data tidak lengkap"
        ]);
        exit;
    }

    // 1. INSERT PENERIMA
    $stmt1 = $mysqli->prepare("
        INSERT INTO penerima
        (nik, nama, alamat, rt, rw, desa_kelurahan, kecamatan, kabupaten_kota, provinsi)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt1->bind_param(
        "sssssssss",
        $nik, $nama, $alamat, $rt, $rw,
        $desa_kelurahan, $kecamatan, $kabupaten_kota, $provinsi
    );

    if (!$stmt1->execute()) {
        echo json_encode(["error" => $stmt1->error]);
        exit;
    }

    // 🔑 ambil id_penerima
    $id_penerima = $mysqli->insert_id;


    // 2. INSERT PENYALURAN
    $stmt2 = $mysqli->prepare("
        INSERT INTO penyaluran
        (id_penerima, id_bansos, periode, tanggal_penyaluran, status)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt2->bind_param("iisss", $id_penerima, $id_bansos, $periode, $tanggal_penyaluran, $status);

    if (!$stmt2->execute()) {
        echo json_encode(["error" => $stmt2->error]);
        exit;
    }

    // 🔑 ambil id_penyaluran
    $id_penyaluran = $mysqli->insert_id;

    // 3. INSERT TRACKING
    $stmt3 = $mysqli->prepare("
        INSERT INTO tracking
        (id_penyaluran, status_tracking, waktu, lokasi)
        VALUES (?, ?, ?, ?)
    ");
    $stmt3->bind_param("isss", $id_penyaluran, $status_tracking, $waktu, $lokasi);

    if (!$stmt3->execute()) {
        echo json_encode(["error" => $stmt3->error]);
        exit;
    }

    echo json_encode([
        "status" => "success",
        "message" => "Data penerima, bansos, dan tracking berhasil disimpan"
    ]);

    exit;
}



/* PUT & DELETE boleh tetap kosong jika belum dipakai */
function putmethod($data){
    include '../../koneksi.php';

    $id_penyaluran     = $data['id_penyaluran'] ?? '';
    $id_bansos         = $data['id_bansos'] ?? '';
    $status            = $data['status'] ?? '';
    $status_tracking   = $data['status_tracking'] ?? '';
    $lokasi            = $data['lokasi'] ?? '';
    $waktu             = $data['waktu'] ?? '';
    

    if ($id_penyaluran == '') {
        echo json_encode([
            "status" => "error",
            "message" => "ID penyaluran tidak ditemukan"
        ]);
        exit;
    }

    // UPDATE penyaluran
    $stmt1 = $mysqli->prepare("
        UPDATE penyaluran 
        SET id_bansos = ?, status = ?
        WHERE id_penyaluran = ?
    ");
    $stmt1->bind_param("isi", $id_bansos, $status, $id_penyaluran);
    $stmt1->execute();

    // UPDATE tracking
    $stmt2 = $mysqli->prepare("
        UPDATE tracking 
        SET status_tracking = ?, lokasi = ?, waktu = ?
        WHERE id_penyaluran = ?
    ");
    $stmt2->bind_param("sssi", $status_tracking,  $lokasi, $waktu, $id_penyaluran);
    $stmt2->execute();

    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil diperbarui"
    ]);
}





function deletemethod() {
    include '../../koneksi.php';

    $data = json_decode(file_get_contents("php://input"), true);
    $id_penerima = $data['id_penerima'] ?? '';

    if ($id_penerima == '') {
        echo json_encode([
            "status" => "error",
            "message" => "ID penerima tidak ditemukan"
        ]);
        exit;
    }

    // 1️⃣ Hapus tracking
    $stmt1 = $mysqli->prepare("
        DELETE t FROM tracking t
        JOIN penyaluran p ON t.id_penyaluran = p.id_penyaluran
        WHERE p.id_penerima = ?
    ");
    $stmt1->bind_param("i", $id_penerima);
    $stmt1->execute();

    // 2️⃣ Hapus penyaluran
    $stmt2 = $mysqli->prepare("
        DELETE FROM penyaluran
        WHERE id_penerima = ?
    ");
    $stmt2->bind_param("i", $id_penerima);
    $stmt2->execute();

    // 3️⃣ Hapus penerima
    $stmt3 = $mysqli->prepare("
        DELETE FROM penerima
        WHERE id_penerima = ?
    ");
    $stmt3->bind_param("i", $id_penerima);

    if ($stmt3->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Data penerima berhasil dihapus"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menghapus data penerima"
        ]);
    }
}


