<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Riwayat Pengambilan</h1>
<p class="mb-4">Berikut adalah jurnal untuk setiap persekot</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-7">
                <a  href="<?= base_url("posneraca/printexcel") ?>" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
                <i class="fas fa-file-excel"></i></span><span class="text">Simpan ke excel</span></a>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-4">Keterangan warna:</div>
                    <div class="col table-secondary">belum diselesaikan</div>
                    <div class="col">diselesaikan sebagian</div>
                    <div class="col table-success">sudah diselesaikan</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>No. Persekot</th>
                        <th>Waktu</th>
                        <th>Narasi</th>
                        <th>Jumlah</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr class="<?=$d['success'].$d['start']?>">
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['nomor']) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['narasi']) ?></td>
                        <td class="text-right"><?= esc($d['jumlah']) ?></td>
                        <td class="text-center"><a href="<?= base_url('posneraca/detail/'.$d['id'])?>" class="btn btn-primary btn-icon-split btn-sm"><span class="icon text-white-50">
                              <i class="fas fa-file"></i></span><span class="text">Lihat</span></a></td>
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