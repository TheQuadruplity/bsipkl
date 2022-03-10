<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pos Neraca</h1>
<p class="mb-4">Berikut adalah jurnal untuk setiap bulan</p>

<!-- Button trigger modal -->
<label for="bulan">Bulan dan tahun</label>
<input type="month" class="form-control" id="bulan">

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
                        <th>Tanggal</th>
                        <th>Saldo</th>
                        <th>Persekot Harian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $i => $d): ?>
                    <tr>
                        <td><?= esc($i) ?></td>
                        <td><?= esc("$i-$month-$year") ?></td>
                        <td style="text-align: right;"><?= esc($d) ?></td>
                        <td><a href="<?= base_url()?>/posneraca/harian/<?= esc("$year-$month-$i") ?>" class="btn btn-primary">Lihat</a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>