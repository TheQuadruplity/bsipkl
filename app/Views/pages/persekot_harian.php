<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Persekot Harian tanggal <?=esc($day)?>-<?=esc($month)?>-<?=esc($year)?> </h1>
<p class="mb-4">Berikut adalah persekot harian</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Database</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Waktu</th>
                        <th>Nama</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i) ?></td>
                        <td><?= esc($d['waktu']) ?></td>
                        <td><?= esc($d['nama']) ?></td>
                        <td class="text-right"><?= esc($d['debit']) ?></td>
                        <td class="text-right"><?= esc($d['kredit']) ?></td>
                        <td class="text-right"><?= esc($d['saldo']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>