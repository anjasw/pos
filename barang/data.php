<?php
	include '../koneksi/konek.php';
    $query = mysqli_query($konek, "SELECT * FROM barang ORDER BY kd_barang ASC");
    $d = array();
    $i = 0;
    foreach($query as $data){
    	$d[] = $data;
    }
    echo json_encode($d);
?>