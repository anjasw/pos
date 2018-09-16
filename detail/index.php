<br>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h2>Kelola Detail Penjualan</h2>
				<a class="btn btn-primary" id="all">Tampilkan Semua Data</a>
			</div>
			<form class="col-md-2" action="" method="post">
				<div class="form-group">
					<input type="text" name="id_detail" class="form-control" placeholder="ID Detail" id="autocomplete">
				</div>
			</form>
			<div class="col-md-2">
				<button type="button" id="cek" class="btn btn-primary btn-sm">Cari ID</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><button id="showForm" type="button" class="btn btn-success btn-small">Tambah Transaksi</button></div>
		</div>
		<br>
		<div class="row" id="data">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td>ID Detail</td>
								<td>ID Barang</td>
								<td>Harga</td>
								<td>Jumlah</td>
								<td>Total</td>
								<td colspan=2>Opsi</td>
							</tr>
						</thead>
						<tbody id="table">
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<form action="simpan.php" method="post" id="form">
			<div class="row" id="kdkd">
				<div class="form-group col-md-4">
					<input type="text" name="kd_barang" id="auto" class="form-control" placeholder="Masukan Kode Barang ...">
				</div>
				<div class="form-group col-md-2">
					<button class="btn btn-primary" type="button" id="kdBarang">Cek</button>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<div id="kosong" class="alert alert-danger" role="alert">
  						Kode barang tak ada, harap cari yang lain
					</div>
					<div id="desk" >
						<label>Nama Barang</label>
					<input type="text" name="deskripsi" placeholder="Deskripsi ..." class="form-control col-md-8" readonly="">
					</div>
				</div>
				<div class="form-group col-md-4" id="harga">
          			<label>Harga</label>
          			<div class="input-group mb-2">
          		  		<div class="input-group-prepend">
          		    		<div class="input-group-text">RP.</div>
          		  		</div>
          	  			<input type="text" name="harga" class="form-control" id="inlineFormInputGroup" placeholder="Contoh : 100000(tanpa titik)">
        		 	</div>
        		</div>
				<div class="form-group col-md-4" id="jumlah">
					<label for="jumlah">Jumlah yang dibeli</label>
					<input type="number" name="jumlah" placeholder="Jumlah yang dibeli ..." class="form-control">
				</div>
			</div>
			<div class="row" id="q">
				<div class="col-md-10">
					<input type="radio" name="konsumen" value="Individu">Individual
					<input type="radio" name="konsumen" value="Warung">Untuk Dijual Kembali
				</div>
				<div class="form-group col-md-2">
					<button class="btn btn-primary" type="button" id="save">Save</button>
				</div>
			</div>
		</form>
	</div>
<script>
	$('#form').hide()
	$('#all').hide()
	TampilData()
	function TampilData(){
		$.ajax({
			async:false,
			url: 'http://localhost/pos/detail/detail_data.php',
			dataType:'json',
			success:function(data){
				var html = ''
				data.forEach(function(row){
					html +=	'<tr>'+
								'<td>'+row.id_detail+'</td>'+
								'<td>'+row.kd_barang+'</td>'+
								'<td>'+row.harga+'</td>'+
								'<td>'+row.qty+'</td>'+
								'<td>RP. '+row.total+'</td>'+
								'<td><a class="btn btn-success text-white edit" data="'+row.id_detail+'">Edit</a></td>'+
								'<td><a class="btn btn-danger text-white hapus" data="'+row.id_detail+'">Hapus</a></td>'+
							'</tr>'
				})
				$('#table').html(html)
			},
			error:function(err){

			}
		})
	}
	<?php include '../koneksi/konek.php'; $query = mysqli_query($konek, "SELECT id_detail FROM penjualan_detail"); ?>
	<?php $kd = mysqli_query($konek, "SELECT kd_barang FROM barang"); ?>
	var availableTags = [
		<?php foreach ($query as $data): ?>
			<?php echo '"'.$data['id_detail'].'",'; ?>
		<?php endforeach ?>
	];
	var kd = [
		<?php foreach ($kd as $data1): ?>
			<?php echo '"'.$data1['kd_barang'].'",'; ?>
		<?php endforeach ?>
	];
	$( "#autocomplete" ).autocomplete({
		source: availableTags,
		minLength: 1,
    	delay: 10
	});
	$( "#auto" ).autocomplete({
		source: kd,
		minLength: 1,
    	delay: 10
	});
	$('#cek').click(function(){
		var id_detail = $('input[name=id_detail]')
		$.ajax({
			method:'get',
			url:'http://localhost/pos/detail/detail_data.php',
			data:{id: id_detail.val()},
			dataType:'json',
			success:function(row){
				var html = ''
					
					if (row == null) {
						$('#form').hide()
						$('#showForm').hide()
						$('#data').show()
						$('#all').show()
						html +=	'<tr>'+
									'<td colspan=6 align="center">Tak ada data dengan kode barang : '+id_detail.val()+'</td>'+
								'</tr>'
					}else{
						row.forEach(function(data){
							html +=	'<tr>'+	
								'<td>'+data.id_detail+'</td>'+
								'<td>'+data.kd_barang+'</td>'+
								'<td>'+data.harga+'</td>'+
								'<td>'+data.qty+'</td>'+
								'<td>'+data.total+'</td>'+
								'<td><a class="btn btn-success text-white edit" data="'+data.id_detail+'">Edit</a></td>'+
								'<td><a class="btn btn-danger text-white hapus" data="'+data.id_detail+'">Hapus</a></td>'+
							'</tr>'
						})
					}
				$('#table').html(html)
				
			},
			error:function(err){
			}
		});
	})

	$('#all').click(function(){
		$('#form').hide()
		$('#all').hide()
		$('#showForm').show()
		$('#data').show()
		TampilData();
	})

	$('#showForm').click(function(){
		$('#data').hide()
		$('#all').show()
		$('#form').show()
		$('#desk').hide()
		$('#q').hide()
		$('#jumlah').hide()
		$('#kdkd').show()
		$('#harga').hide()
		$('#kosong').hide()
		$('#showForm').hide()
	})

	$('#kdBarang').click(function(){
		var kd_barang = $('input[name="kd_barang"]')
		
		var values = [];
		kd_barang.each(function() {
		    values.push($(this).val());
		});
		$.ajax({
			method:'get',
			url:'http://localhost/pos/detail/barang_data.php',
			data:{id: kd_barang.val()},
			dataType:'json',
			success:function(row){
				if (row == "") {
					$('#desk').hide()
					$('#q').hide()
					$('#jumlah').hide()
					$('#harga').hide()
					$('#kosong').show()

				}else{
					$('#kdkd').hide()
					$('#desk').show()
					$('#q').show()
					$('#jumlah').show()
					$('#harga').show()
					$('#kosong').hide()

					$('#form')[0].reset()
					row.forEach(function(data){
						$('input[name=kd_barang]').val(data.kd_barang)
						$('input[name=deskripsi]').val(data.deskripsi)
						$('input[name=harga]').val(data.harga_jual)
						$('input[name=deskripsi]').attr('readonly','')
						$('input[name=harga]').attr('readonly','')
						var html = ''
							
					})	
				}
			},
			error:function(err){

			}
		});
	})

	$('#save').click(function(){
		var data = $('#form').serialize()

		if ($('input[name=jumlah').val() == "") {
			$('input[name=jumlah').addClass('is-invalid')
		}else{
		$('input[name=jumlah').removeClass('is-invalid')
		
		$.ajax({
			method:'post',
			url:'http://localhost/pos/detail/simpan.php',
			data:data,
			dataType:'json',
			success: function(q){
				$('#form').hide()
				$('#all').hide()
				$('#showForm').show()
				$('#data').show()
				TampilData();
			},
			error: function(error){
				alert("Tak Bisa Mengambil Data")				
			}
		})
	}
	})

	$('#table').on('click','.hapus', function(){
      var id = $(this).attr('data')
      $.ajax({
        method:'get',
        url:'http://localhost/pos/detail/hapus.php',
        data:{id : id},
        dataType:'json',
        success: function(data){
          TampilData()
        },
        error: function(){
          alert('Gagal koneksi')
        }    
      })
    })
</script>