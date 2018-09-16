<br>
<div class="container">
  <div class="row">
    <div id="formTampil" class="col-md-4">
      <form id="form" action="" method="post">
        <h4>Form Tambah Daftar Barang</h4>
        <div class="form-group">
          <label for="kd_barang">Kode Barang</label>
          <input type="text" name="kd_barang" placeholder="Masukan kode barang ..." class="form-control">
        </div>
        <div class="form-group">
          <label for="deskripsi">Deksripsi Barang</label>
          <textarea name="deskripsi" rows="8" cols="80" class="form-control" placeholder="Masukan deskripsi barang ..."></textarea>
        </div>
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" name="stock" placeholder="Masukan jumlah stock yg ada ..." class="form-control">
        </div>
        <div class="form-group">
          <label>Harga Beli</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">RP.</div>
            </div>
            <input type="text" name="harga_beli" class="form-control" id="inlineFormInputGroup" placeholder="Contoh : 100000(tanpa titik)">
          </div>
        </div>
        <div class="form-group">
          <label>Harga Jual</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">RP.</div>
            </div>
            <input type="text" name="harga_jual" class="form-control" id="inlineFormInputGroup" placeholder="Contoh : 100000(tanpa titik)">
          </div>
        </div>
        <button type="button" name="kirim" class="btn btn-primary">Save</button>
      </form>
    </div>
    <div id="tabel">
      <div class="table-responsive">
        <button type="button" class="btn btn-secondary btn-sm" id="tambah">Tambah Barang</button>
        <button type="button" class="btn btn-secondary btn-sm" id="tutup">Tutup Form</button>
        <br><br>
        <table class="table table-stripped table-hover">
          <thead>
            <tr>
              <td>ID</td>
              <td>Kode Barang</td>
              <td>Deskripsi</td>
              <td>Stock</td>
              <td>Harga Beli</td>
              <td>Harga Jual</td>
              <td colspan=2>Opsi</td>
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
    function Klik(){
      return confirm("Yakin Hapus ?");
    }
    function tampilData(){
      $.ajax({
        type:'ajax',
        async:false,
        url:'http://localhost/pos/barang/data.php',
        dataType:'json',
        success:function(data){
          var html = ''
          var id = 1;
          // var inputElement = document.getElementById(id);
          //   inputElement.value=inputElement.value.replace(/\D/g, '');
          //   var inputValue = inputElement.value.replace('.', '').split("").reverse().join(""); // reverse
          //   var newValue = '';
          //   for (var i = 0; i < inputValue.length; i++) {
          //       if (i % 3 == 0) {
          //           newValue += '.';
          //       }
          //       newValue += inputValue[i];
          //   }
          //   inputElement.value = newValue.split("").reverse().join("");
          data.forEach(function(d){
            html += '<tr>'+
                      '<td>'+ id++ +'</td>'+
                      '<td>'+ d.kd_barang +'</td>'+
                      '<td>'+ d.deskripsi +'</td>'+
                      '<td>'+ d.stock +'</td>'+
                      '<td>RP. '+d.harga_beli+'</td>'+
                      '<td>RP. '+ d.harga_jual +'</td>'+
                      '<td><a onlick="return Klik()" class="btn btn-primary text-white edit" data="'+d.id+'">Edit</a></td>'+
                      '<td><a class="btn btn-danger text-white hapus" data="'+d.kd_barang+'">Delete</a></td>'+
                    '</tr>'
          })
          $('#table').html(html)
        },
        error: function(error){
          alert("Gagal mendapatkan data")
        }
      });
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    $('#formTampil').hide();
    $('#tutup').hide()
    $('#tabel').addClass('col-md-12');
    $('#tambah').click(function(){
      $('#form')[0].reset();
      $('input[name=kd_barang]').removeAttr('readonly','');
      $('#formTampil').show()
      $('#tabel').removeClass('col-md-12');
      $('#tabel').addClass('col-md-8');
      $('#tutup').show()
      $('#tambah').hide()
    })
    $('#tutup').click(function(){
      $("#formTampil").hide()
      $('#tabel').removeClass('col-md-8');
      $('#tabel').addClass('col-md-12');
      $('#tambah').show()
      $('#tutup').hide()
    })

    ///////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////
    $('#table').on('click','.hapus', function(){
      var id = $(this).attr('data')      
      $.ajax({
        method:'get',
        url:'http://localhost/pos/barang/delete.php',
        data:{id : id},
        dataType:'json',
        success: function(data){
          if (data.status == 'gagal') {
            alert("Maaf data barang tak bisa di hapus, karena berkaitan dengan data detail penjualan");
          }
          tampilData()
          
        },
        error: function(error){
          alert(error)
        }    
      })
    })
    $('#table').on('click','.edit',function(){  
      var id = $(this).attr('data')
      $('input[name=kd_barang]').attr('readonly','')
      $.ajax({
        method:'get',
        url:'http://localhost/pos/barang/edit.php',
        data:{id : id},
        dataType:'json',
        success: function(data){
          $('#formTampil').show()
          
          $('#tabel').removeClass('col-md-12');
          $('#tabel').addClass('col-md-8');
          $('#tutup').show()
          $('#tambah').hide()
          var kd_barang = $('input[name=kd_barang]');
          var deskripsi = $('textarea[name=deskripsi]');
          var harga_beli = $('input[name=harga_beli]');
          var harga_jual = $('input[name=harga_jual]');
          var stock = $('input[name=stock]');
          stock.val(data.stock);
          kd_barang.val(data.kd_barang);
          
          deskripsi.val(data.deskripsi);
          harga_jual.val(data.harga_jual)
          harga_beli.val(data.harga_beli)
        },
        error: function(){
          alert('gagal dapet json')
        }    
      })
    })
    
    ///////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////

    $('button[name=kirim]').click(function(){
      var data = $('#form').serialize()
      $.ajax({
        method: 'post',
        data:data,
        url:'http://localhost/pos/barang/tambah.php',
        dataType:'json',
        success:function(dapet){
          tampilData()
          $('#formTampil').hide();
          $('#tutup').hide()
          $('#tambah').show()
          $('#tabel').addClass('col-md-12');
          $('#form')[0].reset()
        },
        error:function(error){

        }
      })
    })
  })
</script>
