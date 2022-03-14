<h1 class="h3 mb-2 text-gray-800">Form Input Pengambilan</h1>


    <div class="card">
        <form action="<?= base_url() ?>/pengambilan/save" method="POST">
            <div class="card-body">
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