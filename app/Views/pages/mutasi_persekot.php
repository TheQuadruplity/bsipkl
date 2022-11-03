<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mutasi Persekot jenis: <?= esc($nama) ?></h1>
<p class="mb-3">Berikut adalah mutasi jenis persekot</p>

<a href="<?= base_url("jenispersekot") ?>" class="btn btn-secondary btn-icon-split mb-3"><span class="icon text-white-50">
<i class="fas fa-arrow-left"></i></span><span class="text">Kembali</span></a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a  href="<?= base_url("jenispersekot/printexcel/$id") ?>" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
        <i class="fas fa-file-excel"></i></span><span class="text">Simpan ke excel</span></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>Waktu</th>
                        <th>No. Persekot</th>
                        <th>Persekot/Beban</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['no']) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td class="text-right"><?= esc($d['d']) ?></td>
                        <td class="text-right"><?= esc($d['k']) ?></td>
                        <td class="text-right"><?= esc($d['s']) ?></td>
                        <td><?= esc($d['ket']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="<?= esc(base_url())?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= esc(base_url())?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= esc(base_url())?>/js/demo/datatables-demo.js"></script>