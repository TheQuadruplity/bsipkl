<h1 class="h3 mb-2 text-gray-800">Form Input Pengambilan</h1>


    <div class="card">
        <form action="<?= base_url() ?>/pengambilan/save" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="jenis">Jenis Persekot</label>
                    <div class="input-group">
                        <select class="form-control" id="jenis" name="jenis" placeholder="Pilih jenis persekot" required>
                            <?php foreach($jenis_persekot as $j): ?>
                            <option value="<?= esc($j['id']) ?>"><?= esc($j['nama']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#addpersekot"><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="narasi">Narasi</label>
                    <input type="text" class="form-control" id="narasi" name="narasi" placeholder="Masukkan narasi" required maxlength="50">
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
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

<div class="modal fade" id="addpersekot" tabindex="-1" role="dialog" aria-labelledby="apersekot" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apersekot">Tambah Jenis Persekot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="nama">Nama Jenis Persekot</label>
            <input type="text" class="form-control" id="addnama" placeholder="Masukkan nama jenis persekot" maxlength="50" required>
        </div>
        <div class="form-group">
            <label for="rekening">Nomor Rekening</label>
            <input type="text" class="form-control" id="addrekening" placeholder="Masukkan nomor rekening" maxlength="20" required>
        </div>
        <div class="alert alert-danger" role="alert" id="alerter" hidden></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" id="submitjenis" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
    $("#submitjenis").click(function(e){
        e.preventDefault();
        $("#alerter")[0].hidden = true;
        addnama = $("#addnama")[0];
        addrekening = $("#addrekening")[0];
        if(addnama.reportValidity() && addrekening.reportValidity()){
            $.post('<?=base_url('jenispersekot/minisave')?>',{nama: addnama.value, rekening: addrekening.value}, 
            function(d, s, xhr){
                $('#addpersekot').modal('hide');
                Swal.fire({
                    title: "Berhasil",
                    text: "Data berhasil ditambah!",
                    icon: "success",
                });
                $("#jenis")[0].innerHTML += `<option value="${xhr.responseText}">${addnama.value}</option>`
                addnama.value = '';
                addrekening.value = '';
            })
            .catch(() => {
                $("#alerter")[0].hidden = false;
                $("#alerter")[0].innerHTML = 'Data gagal ditambahkan!';
            })
        }
    })
</script>