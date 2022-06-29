<h1 class="h3 mb-2 text-gray-800">Data berhasil dikirim</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Beban</th>
                        <th>Persekot</th>
                        <th>Rekening</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody id="listbeban" name="lists">
                    <?= $data ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">
        <button class="btn btn-primary" id="cetak">Cetak</button>
    </div>
</div>

<script>
    t = $("#listbeban")[0];
    for(i = 0; i < t.childElementCount; i++){
        t.children[i].lastChild.remove();
    }
</script>