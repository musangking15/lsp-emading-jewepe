<?php

include('koneksi.php');

$sql = "SELECT * FROM tb_artikel";
$result = $conn->query($sql);

var_dump($result);
die();