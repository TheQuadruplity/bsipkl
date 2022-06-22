<?php foreach($data as $i => $d): ?>
<tr>
    <td><?= esc($i) ?></td>
    <td><?= esc($d['waktu']) ?></td>
    <td><?= esc($d['nama']) ?></td>
    <td><?= esc($d['debit']) ?></td>
    <td><?= esc($d['kredit']) ?></td>
    <td><?= esc($d['saldo']) ?></td>
    
</tr>
<?php endforeach ?>