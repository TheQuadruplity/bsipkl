<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Jenis Persekot</h1>
<p class="mb-4">Berikut adalah database Jenis Persekot</p>

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  Tambah Data
</button>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Database</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Persekot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td>
                        <a href="<?= base_url()?>/jenispersekot/delete/<?= esc($d['id']) ?>" class="btn btn-danger">Hapus</a>
                            <button type="button" class="btn btn-warning edit" data-toggle="modal" data-target="#editModal" data-id='<?= esc($d['id']) ?>' data-nama='<?= esc($d['nama']) ?>'>Edit</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Persekot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url() ?>/jenispersekot/save" method="POST">
        <div class="form-group">
            <label for="nama">Nama Jenis Persekot</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama jenis persekot" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Persekot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url() ?>/jenispersekot/update" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" id="editid" value="">
            <label for="nama">Nama Jenis Persekot</label>
            <input type="text" class="form-control" id="editnama" name="nama" placeholder="Masukkan nama beban" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>$('.edit').click(function (e) { $('#editnama').val(this.dataset['nama']);$('#editid').val(this.dataset['id']);});</script>