<?php  
	include '../koneksi/konek.php';
	if ($_GET['id']) {
		$id = $_GET['id'];
		$d = array();
		$query = mysqli_query($konek,"DELETE FROM penjualan_detail WHERE id_detail = '$id'");
		if ($query) {
			echo '{"pesan":"delete data", "status":"success"}';
		}else{
			echo '{"pesan":"delete data", "status":"gagal"}';
		}
	}
	
?>