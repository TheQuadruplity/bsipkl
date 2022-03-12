<h1 class="h3 mb-2 text-gray-800">Form Input Penyelesaian</h1>
<!--p class="mb-4">Berikut adalah database Jenis Persekot</p-->

<form action="<?= base_url() ?>/penyelesaian/save" method="POST">
    <div class="form-group">
        <label for="jenis">Beban</label>
        <select class="form-control" id="beban" name="beban" placeholder="Pilih beban yang dipakai" required>
            <?php foreach($beban as $j): ?>
            <option value="<?= esc($j['id']) ?>"><?= esc($j['nama']) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="jenis">Persekot</label>
        <select class="form-control" id="persekot" name="persekot" placeholder="Pilih persekot yang ingin diselesaikan" required>
            <?php foreach($persekot as $j): ?>
            <option value="<?= esc($j['id']) ?>"><?= esc($j['narasi']) ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="narasi">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required>
    </div>
    <div class="form-group">
        <label for="narasi">Rekening</label>
        <input type="search" list="reklist" class="form-control" id="rekening" name="rekening" placeholder="Masukkan rekening">
        <datalist id="reklist">
            <?php foreach($rekening as $j): ?>
            <option>(<?= esc($j['nomor']) ?>) <?= esc($j['nama']) ?></option>
            <?php endforeach ?>
        </datalist>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>