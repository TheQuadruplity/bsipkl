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
                    <?php foreach($data as $d): ?>
                        <tr>
                            <td><?= esc($d['nbeban']) ?></td>
                            <td><?= esc($d['npersekot']) ?></td>
                            <td><?= esc($d['rekening']) ?></td>
                            <td><?= esc($d['jumlah']) ?></td>
                            <td><?= esc($d['keterangan']) ?></td>
                        </tr>
                    <?php endforeach ?>
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
    $("#cetak").click(function(e){
        e.preventDefault();
        var data = document.getElementById("listbeban").innerHTML;
        $.post({
            url: '<?=base_url('penyelesaian/print')?>',
            data: {data: data},
            success: function(a, b, c){
                n = window.open('', '_blank');
                n.document.write(c.responseText);
                n.document.close();
                n.focus();
                n.document.onload(function(){
                    n.print();
                })
            }
        })
    })
</script>