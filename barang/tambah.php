<?php  
	include '../koneksi/konek.php';
	$kd_barang = $_POST['kd_barang'];
	$stock = $_POST['stock'];
	$harga_jual = $_POST['harga_jual'];
	$harga_beli = $_POST['harga_beli'];
	$deskripsi = $_POST['deskripsi'];

	$cekBarang = mysqli_query($konek,"SELECT kd_barang FROM barang WHERE kd_barang = '$kd_barang' ");
	foreach ($cekBarang as $data) {}
	if ($data['kd_barang'] === $kd_barang) {
		// Kalo barang sudah ada
		$query = mysqli_query($konek, "UPDATE barang SET deskripsi='$deskripsi', stock='$stock', harga_beli='$harga_beli', harga_jual='$harga_beli' WHERE kd_barang='$kd_barang' ");
		if ($query) {
			echo '{"pesan":"update data","status":"'.$kd_barang.'"}';
		}else{
			echo '{"pesan":"update data","status":"gagal"}';
		}
	}else{
		// Kalo Barang Belom Ada
		$queryinsert = mysqli_query($konek, "INSERT INTO barang(kd_barang,deskripsi, stock, harga_beli, harga_jual) VALUES('$kd_barang','$deskripsi','$stock', '$harga_beli', '$harga_jual')");
		
		if ($queryinsert) {
			echo '{"pesan":"tambah data","status":"success"}';
		}else{
			echo '{"pesan":"tambah data","status":"gagal"}';
		}

	}
	
?>