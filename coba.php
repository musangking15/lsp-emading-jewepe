<?php 
session_start();
include('koneksi.php');

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

?>


<h1>berhasil login</h1>

<a href="logout.php">Logout</a>