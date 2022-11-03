<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Rekening Beban <?= esc($rek['nama']) ?> - <?= esc($rek['rekening']) ?></h1>
<p class="mb-3">Berikut adalah rekening beban</p>

<a href="<?= base_url("beban") ?>" class="btn btn-secondary btn-icon-split mb-3"><span class="icon text-white-50">
<i class="fas fa-arrow-left"></i></span><span class="text">Kembali</span></a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a  href="<?= base_url("beban/printexcel/$id") ?>" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
        <i class="fas fa-file-excel"></i></span><span class="text">Simpan ke excel</span></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>Waktu</th>
                        <th>Persekot</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $s=0; foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['persekot']) ?></td>
                        <td class="text-right"><?= esc($d['jumlah']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <th class="text-right" colspan="3">Jumlah</th>
                    <th class="text-right"><?= esc($jumlah) ?></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="<?= esc(base_url())?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= esc(base_url())?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= esc(base_url())?>/js/demo/datatables-demo.js"></script>