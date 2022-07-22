<h1 class="h3 mb-2 text-gray-800">Form Input Penyelesaian</h1>

<div class="card">
    <form  method="POST"> 
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col">
                    <label for="jenis">Beban</label>
                    <select class="form-control" id="beban" name="beban" placeholder="Pilih beban yang dipakai" onchange="$('#rekening')[0].value=this.selectedOptions[0].dataset['rek']" required>
                        <?php foreach($beban as $j): ?>
                        <option value="<?= esc($j['id']) ?>" data-rek="<?= esc($j['rekening']) ?>"><?= esc($j['nama']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="rekening">Rekening</label>
                    <input class="form-control" id="rekening" name="rekening" placeholder="-" maxlength="50" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="jenis">Persekot</label>
                    <select class="form-control" id="persekot" name="persekot" placeholder="Pilih persekot yang ingin diselesaikan" onchange="$('#sisa')[0].value=this.selectedOptions[0].dataset['sisa']" required>
                        <option value="" data-sisa="-">-- Pilih Persekot --</option>
                        <?php foreach($persekot as $j): ?>
                        <option value="<?= esc($j['id']) ?>" data-sisa='<?= esc($j['sisa'])?>'><?= esc('PL-'.str_pad($j['id'], 8, '0', STR_PAD_LEFT).' : '.$j['narasi']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="sisa">Sisa</label>
                    <input class="form-control" id="sisa" name="sisa" placeholder="-" maxlength="50" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required min="0">
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="opsional" maxlength="100"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="tambah">Tambah</button>
        </div>
    </form>
</div>
<div class="card my-3">
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
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody id="listbeban" name="lists">
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">
        <form method="POST" action="<?= base_url() ?>/penyelesaian/save" id="f2">
            <input type="hidden" name="successdata[]" id="sdat">
            <button  class="btn btn-primary" id="penyelesaian_simpan">Simpan</button>
        </form>
    </div>
</div>

<script>
    var list_selesai = {};
    var c = 0;

    $('#tambah').click(function(e){
        e.preventDefault();
        f = $('form')[0];
        if(f.checkValidity()){
            t = $('#listbeban')[0];
            r = t.insertRow();
            d = r.insertCell()
            d.innerHTML = f['beban'].selectedOptions[0].innerHTML;
            d.value = f['beban'].value;
            d = r.insertCell()
            d.innerHTML = f['persekot'].selectedOptions[0].innerHTML;
            d.value = f['persekot'].value;
            r.insertCell().innerHTML = f['rekening'].value;
            r.insertCell().innerHTML = f['jumlah'].value;
            r.insertCell().innerHTML = f['keterangan'].value;
            r.insertCell().innerHTML = '<button class="btn btn-danger hapus" onclick="this.parentElement.parentElement.remove()"><i class="fa fa-times"></i></button>';
        }
        else{
            f.reportValidity();
        }
    });

    $('#penyelesaian_simpan').click(function(e){
        e.preventDefault();
        t = $('#listbeban')[0];
        
        if(t.childElementCount){
            function escapeHtml(unsafe)
            {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
            this.setCustomValidity('');
            dat = [];
            for(i = 0; i < t.childElementCount; i++){
                row = t.children[i];
                inner = '<input type="hidden" name="successdata['+i+'][beban]" value="'+row.children[0].value+'">'+
                    '<input type="hidden" name="successdata['+i+'][jumlah]" value="'+row.children[3].innerHTML+'">'+
                    '<input type="hidden" name="successdata['+i+'][rekening]" value="'+row.children[2].innerHTML+'">'+
                    '<input type="hidden" name="successdata['+i+'][persekot]" value="'+row.children[1].value+'">'+
                    '<input type="hidden" name="successdata['+i+'][keterangan]" value="'+row.children[4].innerHTML+'">'+
                    '<input type="hidden" name="successdata['+i+'][nbeban]" value="'+row.children[0].innerHTML+'">'+
                    '<input type="hidden" name="successdata['+i+'][npersekot]" value="'+row.children[1].innerHTML+'">';
                $("#f2")[0].innerHTML += inner;
                dat.push(d);
            }

            $("#f2")[0].submit();
        }
        else{
            this.setCustomValidity('Submit setidaknya satu');
            this.reportValidity();
        }

    })
</script>