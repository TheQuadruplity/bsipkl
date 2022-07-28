<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Jenis Persekot</h1>
<p class="mb-4">Berikut adalah database Jenis Persekot</p>

<button type="button" class="btn btn-primary btn-icon-split mb-3" data-toggle="modal" data-target="#exampleModal" ><span class="icon text-white-50">
  <i class="fas fa-plus-circle"></i></span><span class="text">Tambah Data</span></button>

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
                        <th style="width: 3%;">No.</th>
                        <th>Nama Persekot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger btn-icon-split btn-sm delete" data-toggle="modal" data-target="#deleteModal" value="<?=esc($d['id'])?>"><span class="icon text-white-50">
                              <i class="fas fa-trash"></i></span><span class="text">Hapus</span></button>
                          <button type="button" class="btn btn-warning btn-icon-split btn-sm edit" data-toggle="modal" data-target="#editModal" data-id='<?= esc($d['id']) ?>' 
                            data-nama='<?= esc($d['nama']) ?>'><span class="icon text-white-50">
                          <i class="fas fa-pencil-alt"></i></span><span class="text">Edit</span></button>
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

    <!-- Mudal Hapus-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin  ingin menghapus</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a id="deleteloc" class="btn btn-danger" href="">Hapus</a>
                </div>
            </div>
        </div>
    </div>

<script>$('.edit').click(function (e) { $('#editnama').val(this.dataset['nama']);$('#editid').val(this.dataset['id']);});</script>
<script>$('.delete').click(function(){$('#deleteloc').attr('href', '<?= base_url('jenispersekot/delete')?>/'+$(this).val())})</script>

<!-- Page level plugins -->
<script src="<?= esc(base_url())?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= esc(base_url())?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= esc(base_url())?>/js/demo/datatables-demo.js"></script>