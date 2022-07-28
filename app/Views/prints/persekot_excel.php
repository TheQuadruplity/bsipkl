<!DOCTYPE html>
<html lang="en">
<body>
<table border="1">
    <tr>
        <th>No.</th>
        <th>No. Persekot</th>
        <th>Narasi</th>
        <th>Waktu</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Tersisa</th>
        <th>Keterangan</th>
    </tr>
    <?php foreach($data as $i => $d): ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$d['nomor']?></td>
            <td><?=esc($d['narasi'])?></td>
            <td><?=$d['waktu']?></td>
            <td><?=esc($d['jenis'])?></td>
            <td><?=$d['jumlah']?></td>
            <td><?=$d['sisa']?></td>
            <td><?=esc($d['keterangan'])?></td>
        </tr>
    <?php endforeach ?>
</table>
</body>
</html>