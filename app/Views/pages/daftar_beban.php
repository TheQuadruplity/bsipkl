<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Beban</h1>
<p class="mb-4">Berikut adalah database beban</p>

<a href="#" class="btn btn-primary mb-3">Tambah Data</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Database</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama Beban</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nama Beban</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($data as $d): ?>
                    <tr>
                        <td><?= esc($d['id']) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td>
                            <a href="#" class="btn btn-danger" data-id='<?= esc($d['id']) ?>'>Hapus</a>
                            <a href="#" class="btn btn-warning" data-id='<?= esc($d['id']) ?>'>Edit</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>