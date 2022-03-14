<h1 class="h3 mb-2 text-gray-800">Form Input Penyelesaian</h1>

<div class="card">
    <form action="<?= base_url() ?>/penyelesaian/save" method="POST">
        <div class="card-body">
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
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required min="0">
            </div>
            <div class="form-group">
                <label for="rekening">Rekening</label>
                <input type="search" list="reklist" class="form-control" id="rekening" name="rekening" placeholder="Masukkan rekening" maxlength="50">
                <datalist id="reklist">
                    <?php foreach($rekening as $j): ?>
                    <option>(<?= esc($j['nomor']) ?>) <?= esc($j['nama']) ?></option>
                    <?php endforeach ?>
                </datalist>
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