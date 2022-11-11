<?= csrf_field() ?>
<div class="row">
  <div class="col">
    <h1 class="h3 mb-2 text-gray-800">Admin</h1>
  </div>
  <div class="col-sm-3 text-right">
    <div class="row">
      <div class="col">Pilih tahun kerja:</div>
      <div class="col-4">
        <select id="tahun" class="form-control form-control-sm">
          <?php foreach($years as $y): ?>
            <option value="<?=esc($y)?>" <?= $y == $year?'selected':'' ?>><?=esc($y)?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>  
  </div>
</div>

<!--p class="mb-4">Berikut adalah database Jenis Persekot</p-->
 
<!-- <div class="container my-5"> -->
  <div class="card mb-5">
    <div class="card-header">Riwayat</div>
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="row mb-3">
              <div class="col"><label for="hist_start">mulai</label><input type="date" name="hist_start" id="hist_start" class="hist form-control" value="<?= $date?>"></div>
              <div class="col"><label for="hist_end">akhir</label><input type="date" name="hist_end" id="hist_end" class="hist form-control" value="<?= $date?>"></div>
            </div>
            <div class="row justify-content-center">
              <a id="hist_button" href="<?= base_url("admin/history/$date/$date") ?>" class="btn btn-primary btn-icon-split mr-3"><span class="icon text-white-50">
              <i class="fas fa-file-excel"></i></span><span class="text">Simpan riwayat ke excel</span></a>
              <button type="button" class="btn btn-secondary btn-icon-split" data-toggle="modal" data-target="#guide">
              <span class="icon text-white-50"><i class="fas fa-question-circle"></i></span><span class="text">Petunjuk Kode</span></a>
            </div>
          </div>
          <div class="col justify-content-center text-center my-auto">
            <button class="btn btn-danger btn-icon-split" onclick="del_item()"><span class="icon text-white-50">
            <i class="fas fa-trash"></i></span><span class="text">Hapus Seluruh Riwayat</span></button>
          </div>
        </div>
        
        
        
      </div>
  </div>

  <div class="alert alert-warning" role="alert">
    <strong>Anda akan diminta memasukkan <b>password saat ini</b> pada saat menyimpan perubahan akun</strong>
  </div>

  <div class="card mb-5">
    <form name="saveusername" action="">
      <div class="card-header">Ubah Username</div>
      <div class="card-body">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?= $data['username'] ?>" required pattern="[A-Za-z0-9]*">
        </div>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-primary" id="saveusername">Simpan</button>
      </div>
    </form>
  </div>

  <div class="card my-5">
    <form name="savepassword" action="">
      <div class="card-header">Ubah Password</div>
      <div class="card-body">
        <div class="form-group">
          <label for="newpassword">Password Baru</label>
          <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Masukkan Password Baru" required>
        </div>
        <div class="form-group">
          <label for="narasi">Konfirmasi Password</label>
          <input type="password" class="form-control" id="konpassword" name="konpassword" placeholder="Masukkan Konfirmasi Password" required>
        </div>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-primary" id="savepassword">Simpan</button>
      </div>
    </form>
  </div>

  <div class="card my-5">
    <form name="savemanager" action="">
      <div class="card-header">Manager</div>
      <div class="card-body">
        <div class="form-group">
          <label for="area">Area Manager</label>
          <input type="text" class="form-control" id="area" name="area" placeholder="Masukkan Area Manager" value="<?= $data['area_manager'] ?>" required>
        </div>
        <div class="form-group">
          <label for="aosm">AOSM</label>
          <input type="text" class="form-control" id="aosm" name="aosm" placeholder="Masukkan PJ AOSM" value="<?= $data['pj_aosm'] ?>" required>
        </div>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-primary" id="savemanager">Simpan</button>
      </div>
    </form>
  </div>


<!-- </div> -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="alert alert-warning" role="alert" id="alertplace">
              <strong>Silakan masukkan password lama untuk konfirmasi</strong>
          </div>
      <form action="<?= base_url() ?>/admin/update" method="POST" name="formsubmit">
        <div class="form-group">
            <input type="hidden" id="update">
            <label for="password">Password Lama</label>
            <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Masukkan password lama">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirm">Konfirmasi</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="guide" tabindex="-1" aria-labelledby="guidemodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="guidemodal">Petunjuk Kode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-1">00</div>
          <div class="col">custom baru</div>
        </div>
        <div class="row">
          <div class="col-1">01</div>
          <div class="col">Pengambilan baru</div>
        </div>
        <div class="row">
          <div class="col-1">02</div>
          <div class="col">Penyelesaian baru</div>
        </div>
        <div class="row">
          <div class="col-1">03</div>
          <div class="col">Jenis Persekot baru</div>
        </div>
        <div class="row">
          <div class="col-1">04</div>
          <div class="col">Beban baru</div>
        </div>
        <hr>
        <div class="row">
          <div class="col-1">16</div>
          <div class="col">custom update</div>
        </div>
        <div class="row">
          <div class="col-1">17</div>
          <div class="col">Pengambilan update</div>
        </div>
        <div class="row">
          <div class="col-1">19</div>
          <div class="col">Jenis Persekot update</div>
        </div>
        <div class="row">
          <div class="col-1">20</div>
          <div class="col">Beban update</div>
        </div>
        <hr>
        <div class="row">
          <div class="col-1">32</div>
          <div class="col">custom hapus</div>
        </div>
        <div class="row">
          <div class="col-1">33</div>
          <div class="col">Pengambilan hapus</div>
        </div>
        <div class="row">
          <div class="col-1">34</div>
          <div class="col">Penyelesaian hapus</div>
        </div>
        <div class="row">
          <div class="col-1">35</div>
          <div class="col">Jenis Persekot hapus</div>
        </div>
        <div class="row">
          <div class="col-1">36</div>
          <div class="col">Beban hapus</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  $("#saveusername").click(function(){
    if(document.saveusername.reportValidity()){
      $("#update").data("key", "username");
      $("#update").data("value", $("#username").val());
      $("#exampleModal").modal("show");
    }
  })

  $("#savepassword").click(function(){

    if($("#newpassword").val() != $("#konpassword").val() && $("#konpassword").val() != ""){
      document.getElementById("konpassword").setCustomValidity("Konfirmasi password tidak sama")
    }
    else{
      document.getElementById("konpassword").setCustomValidity("")
    }
    if(document.savepassword.reportValidity()){
      $("#update").data("key", "password");
      $("#update").data("value", $("#newpassword").val());
      $("#exampleModal").modal("show");
    }
  })

  $("#savemanager").click(function(){
    if(document.savemanager.reportValidity()){
      $("#update").data("key", "manager");
      $("#update").data("value", $("#area").val() +'\t'+ $("#aosm").val());
      $("#exampleModal").modal("show");
    }
  })

  $('#tahun').change(function(){
    $.post('<?= base_url() ?>/admin/annual/'+this.value);
  })

  function del_item(){
        Swal.fire({
            title: 'Hapus?',
            icon: 'warning',
            text: 'Apakah yakin menghapus seluruh riwayat?\n(simpan dahulu sebelum hapus)',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.post('<?=base_url('admin/history_delete')?>')
                .done(()=>{
                    location.reload();
                })
                .catch(() => {
                    Swal.showValidationMessage(`Error, riwayat gagal dihapus`)
                })
            }
        })
    }
  $('.hist').change(function(){
    $('#hist_button')[0].href = "<?= base_url("admin/history") ?>/"+$('#hist_start')[0].value+"/"+$('#hist_end')[0].value;
  })
</script>