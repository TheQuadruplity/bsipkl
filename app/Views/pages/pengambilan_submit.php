<h1 class="h3 mb-2 text-gray-800">Data berhasil dikirim</h1>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">Jenis Persekot</div>
            <div class="col">: <?=$data['jenis']?></div>
        </div>
        <div class="row">
            <div class="col">Narasi</div>
            <div class="col">: <?=$data['narasi']?></div>
        </div>
        <div class="row">
            <div class="col">Jumlah</div>
            <div class="col">: <?=$data['jumlah']?></div>
        </div>
        <div class="row">
            <div class="col">Keterangan</div>
            <div class="col">: <?=$data['keterangan']?></div>
        </div>

    </div>
    <div class="card-footer">
        <a href="<?= base_url("pengambilan") ?>" class="btn btn-secondary btn-icon-split btn-sm"><span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i></span><span class="text">Kembali</span></a>
        <a href="<?= base_url("posneraca") ?>" class="btn btn-secondary btn-icon-split btn-sm"><span class="icon text-white-50">
        <i class="fas fa-file"></i></span><span class="text">Ke Riwayat Pengambilan</span></a>
        <a href="<?= base_url('posneraca/printmemo/'.$id)?>" class="btn btn-primary btn-icon-split btn-sm" target="_blank"><span class="icon text-white-50">
        <i class="fas fa-print"></i></span><span class="text">Print</span></a>
    </div>
</div>