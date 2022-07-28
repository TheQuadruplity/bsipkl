<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Rekening</h1>
<p class="mb-4">Berikut adalah database rekening</p>

<!-- Button trigger modal -->
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
                        <th>No. Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['nomor']) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td class="text-center">

                        <button type="button" class="btn btn-danger btn-icon-split btn-sm delete" data-toggle="modal" data-target="#deleteModal" value="<?=esc($d['nomor'])?>"><span class="icon text-white-50">
                              <i class="fas fa-trash"></i></span><span class="text">Hapus</span></button>
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url() ?>/rekening/save" method="POST">
        <div class="form-group">
            <label for="nomorRekening">Nomor Rekening</label>
            <input type="text" class="form-control" id="nomorRekening" name="nomorRekening" placeholder="Masukkan nomor rekening">
        </div>
        <div class="form-group">
            <label for="nomorRekening">Nama Rekening</label>
            <input type="text" class="form-control" id="namaRekening" name="namaRekening" placeholder="Masukkan nama rekening">
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

    <script>$('.delete').click(function(){$('#deleteloc').attr('href', '<?= base_url('rekening/delete')?>/'+$(this).val())})</script>

<!-- Page level plugins -->
<script src="<?= esc(base_url())?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= esc(base_url())?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= esc(base_url())?>/js/demo/datatables-demo.js"></script>