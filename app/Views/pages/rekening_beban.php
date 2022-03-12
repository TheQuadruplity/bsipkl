<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Rekening Beban <?= esc($nama) ?></h1>
<p class="mb-4">Berikut adalah rekening beban</p>

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
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Persekot</th>
                        <th>Rekening</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $s=0; foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['persekot']) ?></td>
                        <td><?= esc($d['rekening']) ?></td>
                        <td class="text-right"><?= esc($d['jumlah']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <th class="text-right" colspan="4">Jumlah</th>
                    <th class="text-right"><?= esc($jumlah) ?></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>