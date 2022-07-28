<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Riwayat Penyelesaian</h1>
<p class="mb-4">Berikut adalah database beban</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Database</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead id="head">
                    <tr>
                        <th style="width: 3%;">No.</th>
                        <th>Waktu</th>
                        <th>Beban</th>
                        <th>Persekot</th>
                        <th>Rekening</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Batal</th>
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
                        <td class="text-center"><button class="btn btn-danger btn-sm" onclick="return del_item(this, <?=$d['id']?>)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function del_item(item, id){
        var a = item.parentElement.parentElement.cloneNode(true);
        var b = $('#head')[0].children[0].cloneNode(true);
        Swal.fire({
            title: 'Hapus?',
            icon: 'warning',
            html:
            "<p>apakah yakin ingin menghapus?</p><p><table class='table table-bordered table-sm'><thead><tr>"
            +`<th>${b.children[1].innerHTML}</th>`+`<th>${b.children[3].innerHTML}</th>`+`<th>${b.children[5].innerHTML}</th>`+"</tr></thead><tbody><tr>"
            +`<th>${a.children[1].innerHTML}</th>`+`<th>${a.children[3].innerHTML}</th>`+`<th>${a.children[5].innerHTML}</th>`+"</tr></tbody><table></p>"
            +'<div class="alert alert-info" role="alert">Penghapusan tidak memengaruhi jurnal</div>',
            width: '85%',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            denyButtonText: `Batal`,
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.post('<?=base_url('posbeban/delete')?>',{id: id})
                .done(()=>{
                    window.location.replace('<?=base_url('posbeban')?>')
                })
                .catch(() => {
                    Swal.showValidationMessage(`Error, data gagal dihapus`)
                })
            }
        })
    }
</script>

<!-- Page level plugins -->
<script src="<?= esc(base_url())?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= esc(base_url())?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= esc(base_url())?>/js/demo/datatables-demo.js"></script>