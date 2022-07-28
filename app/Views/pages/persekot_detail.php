<h1 class="h3 mb-2 text-gray-800">Detail Persekot</h1>

<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <div class="row">
                <div class="col-3">No. Persekot</div>
                <div class="col">: <?=$nomor?></div>
            </div>
            <div class="row">
                <div class="col-3">Narasi</div>
                <div class="col">: <?=esc($narasi)?></div>
            </div>
            <div class="row">
                <div class="col-3">Waktu Pengambilan</div>
                <div class="col">: <?=$waktu?></div>
            </div>
            <div class="row">
                <div class="col-3">Jenis Persekot</div>
                <div class="col">: <?=$jenis?></div>
            </div>
            <div class="row">
                <div class="col-3">Tersisa / Jumlah</div>
                <div class="col">: <?=$sisa?> / <?=$jumlah?></div>
            </div>
            <div class="row">
                <div class="col-3">Keterangan</div>
                <div class="col">: <?=$keterangan?></div>
            </div>
            <?php if($selesai): ?>
                <div class="alert alert-success mt-3" role="alert">Persekot sudah terselesaikan</div>
            <?php else: ?>
                <div class="alert alert-warning mt-3" role="alert">Persekot belum terselesaikan</div>
            <?php endif ?>
        </div>
        <div class="card-footer">
        <a href="<?= base_url("posneraca") ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50">
<i class="fas fa-arrow-left"></i></span><span class="text">Kembali</span></a>
            <a href="<?= base_url('posneraca/printmemo/'.$id)?>" class="btn btn-primary btn-icon-split" target="_blank"><span class="icon text-white-50">
            <i class="fas fa-print"></i></span><span class="text">Print</span></a>
            <?php if($dimulai): ?>
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Tidak dapat dibatalkan karena sebagian sudah diselesaikan">
                <button disabled class="btn btn-danger btn-icon-split"><span class="icon text-white-50">
                <i class="fas fa-trash"></i></span><span class="text">Batalkan persekot</span></button>
                </span>
            <?php else: ?>
                <button class="btn btn-danger btn-icon-split" onclick="del_item()"><span class="icon text-white-50">
                <i class="fas fa-trash"></i></span><span class="text">Batalkan persekot</span></button>
            <?php endif ?>
        </div>
    </div>
</div>


<?php if(!$dimulai): ?>
<script>
    function del_item(){
        Swal.fire({
            title: 'Hapus?',
            icon: 'warning',
            text: 'Apakah ingin membatalkan persekot ini?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.post('<?=base_url('posneraca/delete')?>',{id: <?=$id?>})
                .done(()=>{
                    window.location.replace('<?=base_url('posneraca')?>')
                })
                .catch(() => {
                    Swal.showValidationMessage(`Error, data gagal dihapus`)
                })
            }
        })
    }
</script>
<?php else: ?>
<script>$(function () {$('[data-toggle="tooltip"]').tooltip()})</script>
<?php endif ?>