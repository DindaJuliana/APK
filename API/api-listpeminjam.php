<?php

include 'koneksi.php';

// Menerima data UKM dari aplikasi Android
$ukm = $_POST['ukm'];

// Melakukan filter SQL untuk mencegah SQL injection
$ukm = mysqli_real_escape_string($koneksi, $ukm);

// Membuat query untuk mengambil data berdasarkan UKM
$sql = "SELECT tb_peminjaman.id, tb_anggota.nama, tb_anggota.ukm, tb_peminjaman.status FROM tb_peminjaman
          JOIN tb_anggota ON tb_anggota.nim = tb_peminjaman.id_peminjam
          WHERE tb_peminjaman.ukm = '$ukm'";

$query = mysqli_query($koneksi, $sql);

$list_data = array();

// Mengambil data hasil query
while ($data = mysqli_fetch_assoc($query)) {
    $list_data[] = array(
        'id' => $data['id'],
        'nama' => $data['nama'],
        'ukm' => $data['ukm'],
        'status' => $data['status'],
    );
}

// Mengirimkan data dalam format JSON ke aplikasi Android
echo json_encode(array(
    'data' => $list_data
));
?>