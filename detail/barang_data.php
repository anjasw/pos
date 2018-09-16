<?php
    include '../koneksi/konek.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($konek, "SELECT * FROM barang WHERE kd_barang = '$id' ");
        $d = array();
        $i = 0;
        foreach($query as $data){
            $d[] = $data;
        }
        echo json_encode($d);
    }
    
    
?>