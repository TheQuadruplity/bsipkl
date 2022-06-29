<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Jurnal</h1>
<p class="mb-4">Berikut adalah jurnal untuk setiap bulan</p>

<!-- Button trigger modal -->
<div class="row">
    <div class="col">
        <label for="awal">Tanggal Awal</label>
        <input type="date" class="form-control mb-3 tanggal" id="awal" min='<?=$datemin?>' max='<?=$datemax?>'  value="<?= $now?>">
    </div>
    <div class="col">
        <label for="awal">Tanggal Akhir</label>
        <input type="date" class="form-control mb-3 tanggal" id="akhir" min='<?=$datemin?>' max='<?=$datemax?>' value="<?= $now?>">
    </div>
</div>

<button type="button" class="btn btn-primary btn-icon-split mb-3"><span class="icon text-white-50">
  <i class="fas fa-print"></i></span><span class="text">Cetak</span></button>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Database</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody id='jurnal'>
                    <?= view('minis/jurnal', ['data' => $data]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>