<?php
// update_ipk.php

// Mendapatkan data dari request
$nrp = $_POST['nrp'];
$newIPK = $_POST['ipk'];

// Inisalisasi boolean untuk pengecekan apakah ipk berhasil terupdate atau tidak
$ipkUpdated = false;

// Melakukan pembaruan IPK mahasiswa dalam database berdasarkan NRP
$servername = "localhost";
$user = "..."; // ganti dengan username database (jika ada)
$pass = "..."; // ganti dengan password database (jika ada)
$dbname = "..."; // ganti dengan nama database kalian

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Format data mahasiswa
$mahasiswa = array();

// Menjalankan query untuk mengganti anggota yang memiliki nrp yang diberi user dengan ipk yang baru
$sql = "UPDATE anggota_table SET ipk = '$newIPK' WHERE nrp = '$nrp'";
$result = $conn->query($sql);

// Memeriksa hasil query
if ($conn->query($sql) === TRUE) {
    $ipkUpdated = true;
}

// Mengirimkan respon
if ($ipkUpdated) {
    $response = array('message' => 'IPK updated successfully');
} else {
    $response = array('message' => 'IPK not updated successfully');
}
echo json_encode($response);

// Menutup koneksi
$conn->close();
?>
