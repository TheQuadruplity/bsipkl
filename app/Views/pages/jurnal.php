<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Jurnal</h1>
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
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Saldo</th>
                        <th>Persekot Harian</th>
                    </tr>
                </thead>
                <tbody id='jurnal'>
                    <?= view('minis/jurnal', ['data' => $data, 'month' => $month, 'year' => $year]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>