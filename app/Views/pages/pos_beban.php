<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Beban</h1>
<p class="mb-4">Berikut adalah database beban</p>

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
                        <th>Waktu</th>
                        <th>Beban</th>
                        <th>Persekot</th>
                        <th>Rekening</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i+1) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['beban']) ?></td>
                        <td><?= esc($d['persekot']) ?></td>
                        <td><?= esc($d['rekening']) ?></td>
                        <td class="text-right"><?= esc($jumlah[$i]) ?></td>
                        <td><?= esc($d['keterangan']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>