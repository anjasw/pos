<br>
<div class="container">
  <div class="row">
    <div id="tabel" class="col-md-12">
      <div class="table-responsive">
        <h1>Penjualan</h1>
        <table class="table table-stripped table-hover">
          <thead>
            <tr>
              <td>NO</td>
              <td>ID Detail</td>
              <td>Tanggal Transaksi</td>
              <td>Total Pembayaran</td>
              <td>Konsumen</td>
              <td>Opsi</td>
            </tr>
          </thead>
          <tbody id="table">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    tampilData()
    function tampilData(){
      $.ajax({
        type:'ajax',
        async:false,
        url:'http://localhost/pos/penjualan/data.php',
        dataType:'json',
        success:function(data){
          var html = ''
          var id = 1;
          data.forEach(function(d){
            html += '<tr>'+
                      '<td>'+ id++ +'</td>'+
                      '<td>'+ d.id_detail +'</td>'+
                      '<td>'+ d.tgl_transaksi +'</td>'+
                      '<td>'+ d.total_transaksi +'</td>'+
                      '<td>'+ d.konsumen +'</td>'+
                      '<td><a class="btn btn-danger text-white hapus" data="'+d.id_detail+'">Delete</a></td>'+
                    '</tr>'
          })
          $('#table').html(html)
        },
        error: function(error){
          alert("Gagal Mendapatkan Data")
        }
      });
    }

    $('#table').on('click','.hapus', function(){
      var id = $(this).attr('data')
      $.ajax({
        method:'get',
        url:'http://localhost/pos/penjualan/delete.php',
        data:{id : id},
        dataType:'json',
        success: function(data){
          tampilData()
        },
        error: function(){
          alert('gagal dapet json')
        }    
      })
    })
  })
</script>
