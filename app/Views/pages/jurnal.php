<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Jurnal</h1>
<p class="mb-4">Berikut adalah jurnal untuk setiap bulan</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
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

        <a id='printb' target="_blank" href="<?= base_url("jurnal/print_j/$now/$now") ?>" class="btn btn-primary btn-icon-split"><span class="icon text-white-50">
        <i class="fas fa-print"></i></span><span class="text">Cetak</span></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead id='head'>
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>Waktu</th>
                        <th>No. Persekot</th>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody id='jurnal'>
                    <?= view('minis/jurnal', ['data' => $data]) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('.tanggal').change(function (){
        var loc = '<?= base_url('jurnal/print_j') ?>/';
        var awal = $('#awal').val();
        var akhir = $('#akhir').val();
        $('#printb')[0].href = loc+awal+'/'+akhir;
    })

    function del_item(item, id){
        var a = item.parentElement.parentElement.cloneNode(true);
        var b = $('#head')[0].children[0].cloneNode(true);
        b.lastElementChild.remove();
        b.lastElementChild.remove();
        a.lastElementChild.remove();
        a.lastElementChild.remove();
        Swal.fire({
            title: 'Hapus?',
            icon: 'warning',
            html:
            "<p>apakah yakin ingin menghapus?</p><p><table class='table table-bordered table-sm'><thead>"+b.innerHTML+"</thead><tbody>"+a.innerHTML+"</tbody><table></p>"
            +'<div class="alert alert-info" role="alert">Penghapusan tidak memengaruhi kesediaan persekot/beban ataupun sisa persekot</div>',
            width: '85%',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.post('<?=base_url('jurnal/delete')?>',{id: id})
                .done(()=>{
                    window.location.replace('<?=base_url('jurnal')?>')
                })
                .catch(() => {
                    Swal.showValidationMessage(`Error, data gagal dihapus`)
                })
            }
        })
    }
</script>