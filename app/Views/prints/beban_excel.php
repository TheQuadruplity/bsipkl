<!DOCTYPE html>
<html lang="en">
<body>
<table border="1">
    <tr>
        <th>No.</th>
        <th>Waktu</th>
        <th>Beban</th>
        <th>Rekening</th>
        <th>Persekot</th>
        <th>No. Persekot</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
    <?php foreach($data as $i => $d): ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$d['waktu']?></td>
            <td><?=esc($d['namabeban'])?></td>
            <td><?=$d['rekening']?></td>
            <td><?=esc($d['persekot'])?></td>
            <td><?=$d['nomorpersekot']?></td>
            <td><?=$d['jumlah']?></td>
            <td><?=esc($d['keterangan'])?></td>
        </tr>
    <?php endforeach ?>
</table>
</body>
</html>