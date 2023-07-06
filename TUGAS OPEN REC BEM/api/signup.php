<?php
// Mendapatkan data dari request
$username = $_POST['username'];
$password = $_POST['password'];

// Proses pendaftaran akun
$servername = "localhost";
$user = "..."; // ganti dengan username database (jika ada)
$pass = "..."; // ganti dengan password database (jika ada)
$dbname = "..."; // ganti dengan nama database kalian

$loginSuccess = false;

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Melakukan pendaftaran/memasukkan akun ke dalam database
$sql = "INSERT INTO anggota_table (username, passwords) VALUES ('$username', '$password')";
if ($conn->query($sql) === TRUE) { // cek apakah query berhasil dijalankan atau tidak
    $signupSuccess = true;
} else {
    $signupSuccess = false;
}

// Mengirimkan respon
if ($signupSuccess) {
    $response = array('message' => 'Sign up successful');
} else {
    $response = array('message' => 'Sign up failed');
}
echo json_encode($response);

// Menutup koneksi
$conn->close();
?>
