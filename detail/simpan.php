<?php  
if (isset($_POST['kd_barang'])) {
	include '../koneksi/konek.php';
	$kd_barang = $_POST['kd_barang'];
	$detail = mysqli_query($konek, "SELECT id_detail FROM penjualan_detail ORDER BY id_detail DESC LIMIT 1");
	foreach ($detail as $data ) {}
	if ($data['id_detail'] == null) {
		$id_detail = date('ymd');
		
	}else{
	$id_detail = $data['id_detail']+1;

	}
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];
	$total = $jumlah*$harga;
	$konsumen = $_POST['konsumen'];
	$tanggal = date('y:m:d h:i:s');
	$save = mysqli_query($konek, "INSERT INTO penjualan_detail VALUES('$id_detail','$kd_barang','$harga','$jumlah','$total')");
	if ($save) {

		$trigger = mysqli_query($konek,"INSERT INTO penjualan VALUES('$id_detail','$tanggal','$total','$konsumen')");
		if ($trigger) {

			$stok = mysqli_query($konek,"SELECT stock FROM barang WHERE kd_barang = '$kd_barang'");
			
			foreach ($stock as $a) {}
			
			$qty = $a['stock']-$jumlah;
			
			$proses = mysqli_query($konek,"UPDATE barang SET stock='$qty' WHERE kd_barang = '$kd_barang' ");
			
			if ($proses) {
			
				echo '{"type":"Tambah","status":"Berhasil"}';
			
			}
			
		}
	}
}

?>