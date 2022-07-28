<!DOCTYPE html>
<html lang="en">
<body>
<table border="1">
    <tr>
        <th>No.</th>
        <th>Waktu</th>
        <th>No. Persekot</th>
        <th>Narasi</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
    <?php foreach($data as $i => $d): ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$d['waktu']?></td>
            <td><?=$d['nomorpersekot']?></td>
            <td><?=esc($d['persekot'])?></td>
            <td><?=$d['jumlah']?></td>
            <td><?=esc($d['keterangan'])?></td>
        </tr>
    <?php endforeach ?>
    <tr>
        <td colspan="4">Jumlah</td>
        <td><?=$sum?></td>
    </tr>
</table>
</body>
</html>