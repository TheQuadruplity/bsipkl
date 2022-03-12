<h1 class="h3 mb-2 text-gray-800">Admin</h1>
<!--p class="mb-4">Berikut adalah database Jenis Persekot</p-->

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?= $data['username'] ?>" required>
</div>
<button class="btn btn-primary" id="saveusername" name="saveusername" data-toggle="modal" data-target="#exampleModal">Simpan</button>
<hr>
<div class="form-group">
    <label for="newpassword">Password Baru</label>
    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Masukkan Password Baru" required>
</div>
<div class="form-group">
    <label for="narasi">Konfirmasi Password</label>
    <input type="password" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Konfirmasi Password" required>
</div>
<button class="btn btn-primary" id="savepassword" name="savepassword" data-toggle="modal" data-target="#exampleModal">Simpan</button>
<hr>
<div class="alert alert-info" role="alert">
    <strong>Anda akan diminta memasukkan <b>password saat ini</b> pada saat menyimpan perubahan akun</strong>
</div>

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
      <form action="<?= base_url() ?>/admin/update" method="POST">
        <div class="form-group">
            <input type="hidden">
            <label for="nomorRekening">Password Lama</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password lama">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
      </div>
      </form>
    </div>
  </div>
</div>