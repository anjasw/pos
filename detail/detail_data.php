<?php
	include '../koneksi/konek.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = mysqli_query($konek, "SELECT * FROM penjualan_detail WHERE id_detail = '$id' ");
		$d = array();
    	$i = 0;
    	foreach($query as $data){
    		$d[] = $data;
    	}
    	echo json_encode($d);
	}else{
		$query = mysqli_query($konek, "SELECT * FROM penjualan_detail JOIN barang ON penjualan_detail.kd_barang = barang.kd_barang");
		$d = array();
    	$i = 0;
    	foreach($query as $data){
    		$d[] = $data;
    	}
    	echo json_encode($d);
	}
    
    
?>