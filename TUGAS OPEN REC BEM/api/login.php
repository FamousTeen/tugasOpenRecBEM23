<?php
// Mendapatkan data dari request
$username = $_POST['username'];
$password = $_POST['password'];

// Proses verifikasi login
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

// Menjalankan query untuk mendapatkan daftar username dan password
$sql = "SELECT username, passwords FROM anggota_table";
$result = $conn->query($sql);

// Memeriksa hasil query
if ($result->num_rows > 0) {
    // Loop melalui setiap baris data
    while ($row = $result->fetch_assoc()) {
        if ($username == $row["username"] and $password == $row["passwords"]) {
            $loginSuccess = true;
        }
    }
} else {
    echo "Table tidak memiliki isi";
}

// Mengirimkan respon
if ($loginSuccess) {
    $response = array('message' => 'Login successful');
} else {
    $response = array('message' => 'Login failed');
}
echo json_encode($response);

// Menutup koneksi
$conn->close();
?>
