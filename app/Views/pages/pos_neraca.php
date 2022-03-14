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
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Narasi</th>
                        <th>Jenis Persekot</th>
                        <th>Jumlah</th>
                        <th>Tersisa</th>
                        <th>Form Memo Pengantar Persekot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr class="<?=$d['success']?>">
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['narasi']) ?></td>
                        <td><?= esc($d['jenis']) ?></td>
                        <td class="text-right"><?= esc($d['jumlah']) ?></td>
                        <td class="text-right"><?= esc($d['sisa']) ?></td>
                        <td><a href="<?= base_url()?>/posneraca/printmemo/<?= esc($d['id']) ?>" target="_blank" class="btn btn-primary">Print</a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>