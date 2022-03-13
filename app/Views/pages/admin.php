<?php if($msg): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    <span class="sr-only">Close</span>
  </button>
  <?= esc($msg) ?>
</div>
<?php endif ?>

<h1 class="h3 mb-2 text-gray-800">Admin</h1>
<!--p class="mb-4">Berikut adalah database Jenis Persekot</p-->

<form name="saveusername" action="">
  <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?= $data['username'] ?>" required>
  </div>
  <button type="button" class="btn btn-primary" id="saveusername">Simpan</button>
</form>
<hr>
<form name="savepassword" action="">
  <div class="form-group">
      <label for="newpassword">Password Baru</label>
      <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Masukkan Password Baru" required>
  </div>
  <div class="form-group">
      <label for="narasi">Konfirmasi Password</label>
      <input type="password" class="form-control" id="konpassword" name="konpassword" placeholder="Masukkan Konfirmasi Password" required>
  </div>
  <button type="button" class="btn btn-primary" id="savepassword">Simpan</button>
  <hr>
  <div class="alert alert-info" role="alert">
      <strong>Anda akan diminta memasukkan <b>password saat ini</b> pada saat menyimpan perubahan akun</strong>
  </div>
</form>

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
</script>