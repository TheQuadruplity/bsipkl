<!DOCTYPE html>
<html lang="en">
<body>
<table border="1">
    <thead>
        <tr>
            <th style="width: 3%;">No.</th>
            <th>Waktu</th>
            <th>Tipe</th>
            <th>ID</th>
            <th>IDkey</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $i => $d): ?>
        <tr>
            <td><?= esc($i+1) ?></td>
            <td><?= esc($d['waktu']) ?></td>
            <td><?= esc($d['tipe']) ?></td>
            <td><?= esc($d['id']) ?></td>
            <td><?= esc("'".$d['idkey']) ?></td>
            <td><?= esc($d['keterangan']) ?></td>
            <td class="text-right"><?= esc($d['jumlah']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>