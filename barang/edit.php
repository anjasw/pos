<?php  
	include '../koneksi/konek.php';
	if ($_GET['id']) {
		$id = $_GET['id'];
		$d = array();
		$query = mysqli_query($konek,"SELECT * FROM barang WHERE id = '$id'");
		if (count($query) > 0) {
			foreach ($query as $data) {
				$d = $data;
			}
			echo json_encode($d);

		}
	}
	
?>