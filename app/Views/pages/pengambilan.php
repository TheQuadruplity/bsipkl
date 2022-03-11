<h1 class="h3 mb-2 text-gray-800">Form Input Pengambilan</h1>
<!--p class="mb-4">Berikut adalah database Jenis Persekot</p-->

<form action="<?= base_url() ?>/pengambilan/save" method="POST">
    <div class="form-group">
        <label for="jenis">Jenis Persekot</label>
        <select class="form-control" id="jenis" name="jenis" placeholder="Pilih jenis persekot" required>
            <?php foreach($jenis_persekot as $j): ?>
            <option value="<?= esc($j['id']) ?>"><?= esc($j['nama']) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="narasi">Narasi</label>
        <input type="text" class="form-control" id="narasi" name="narasi" placeholder="Masukkan narasi" required>
    </div>
    <div class="form-group">
        <label for="narasi">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>