<h1 class="h3 mb-2 text-gray-800">Data berhasil dikirim</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Rekening Beban</th>
                        <th>Beban</th>
                        <th>Debet</th>
                        <th>Rekening Persekot</th>
                        <th>narasi</th>
                        <th>Kredit</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody id="listbeban" name="lists">
                    <?php foreach($data as $d): ?>
                        <tr>
                            <td><?= esc($d['rekening_beban']) ?></td>
                            <td><?= esc($d['nama_beban']) ?></td>
                            <td><?= esc($d['jumlah_beban']) ?></td>
                            <td><?= esc($d['rekening_persekot']) ?></td>
                            <td><?= esc($d['narasi_persekot']) ?></td>
                            <td><?= esc($d['jumlah_persekot']) ?></td>
                            <td><?= esc($d['keterangan']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">
        <a href="<?= base_url("penyelesaian") ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50">
        <i class="fas fa-arrow-left"></i></span><span class="text">Kembali</span></a>
        <a href="<?= base_url("posbeban") ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50">
        <i class="fas fa-file"></i></span><span class="text">Ke Riwayat Penyelesaian</span></a>
        <button class="btn btn-primary btn-icon-split" id="cetak"><span class="icon text-white-50">
        <i class="fas fa-print"></i></span><span class="text">Cetak</span></button>
    </div>

</div>

<p hidden id='jsondata'><?= esc($json) ?></p>

<script>
$("#cetak").click(function(e){
    parse = document.getElementById('jsondata').innerHTML;
    e.preventDefault();
    $.post({
        url: '<?=base_url('penyelesaian/print')?>',
        data: {data: parse, waktu: '<?=$waktu?>'},
        success: function(a, b, c){
            n = window.open('', '_blank');
            n.document.write(c.responseText);
            n.document.close();
            n.focus();
            n.document.onload(function(){
                n.print();
            })
        },
        error: function(xhr, ajaxOptions, thrownError) {
            n = window.open('', '_blank');
            n.document.write(xhr.responseText);
            n.document.close();
        }
    })
})
</script>