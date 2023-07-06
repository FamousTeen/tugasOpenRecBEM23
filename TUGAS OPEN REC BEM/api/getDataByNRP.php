<?php
// get_mahasiswa.php

// Mendapatkan data dari request
$nrp = $_GET['nrp'];

// Mendapatkan data mahasiswa dari database berdasarkan NRP
$servername = "localhost";
$user = "..."; // ganti dengan username database (jika ada)
$pass = "..."; // ganti dengan password database (jika ada)
$dbname = "..."; // ganti dengan nama database kalian

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// inisialisasi array mahasiswa
$mahasiswa = array();

// Menjalankan query untuk mendapatkan data-data anggota
$sql = "SELECT * FROM anggota_table";
$result = $conn->query($sql);

// Memeriksa hasil query
if ($result->num_rows > 0) {
    // Loop melalui setiap baris data
    while ($row = $result->fetch_assoc()) {
        $mahasiswa['nama'] = $row['nama'];
        $mahasiswa['nrp'] = $row['nrp'];
        $mahasiswa['jurusan'] = $row['jurusan'];
        $mahasiswa['fakultas'] = $row['fakultas'];
        $mahasiswa['jenis_kelamin'] = $row['jenis_kelamin'];
    }
} else {
    echo "Table tidak memiliki isi";
}

// Mencari data mahasiswa berdasarkan NRP dan mengirimkan respon
$result = array();
foreach ($mahasiswa as $data) {
    if ($data['nrp'] == $nrp) {
        $result = $data;
        break;
    }
}
echo json_encode($result);

// Menutup koneksi
$conn->close();
?>
