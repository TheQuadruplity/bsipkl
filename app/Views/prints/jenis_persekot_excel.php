<!DOCTYPE html>
<html lang="en">
<body>
<table border="1">
    <thead>
        <tr>
            <th style="width: 3%;">No.</th>
            <th>Waktu</th>
            <th>No. Persekot</th>
            <th>Persekot/Beban</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $i => $d): ?>
        <tr>
            <td><?= esc($i+1) ?></td>
            <td><?= esc($d['waktu']) ?></td>
            <td><?= esc($d['no']) ?></td>
            <td><?= esc($d['nama']) ?></td>
            <td class="text-right"><?= esc($d['d']) ?></td>
            <td class="text-right"><?= esc($d['k']) ?></td>
            <td class="text-right"><?= esc($d['s']) ?></td>
            <td><?= esc($d['ket']) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</body>
</html>