<?php 

// melakukan koneksi ke database
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'db_emading';

$conn = mysqli_connect($server, $username, $password, $db);

// melakukan cek apakah koneksi berhasil
if(!$conn){
    echo 'gagal koneksi';
}
