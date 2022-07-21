<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pos Neraca</h1>
<p class="mb-4">Berikut adalah jurnal untuk setiap persekot</p>

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