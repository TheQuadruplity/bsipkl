<?php foreach($data as $i => $d): ?>
<tr>
    <td><?= $i ?></td>
    <td><?= esc($d['waktu']) ?></td>
    <td><?= 'PL-'.str_pad($d['persekot'], 8, '0', STR_PAD_LEFT);?></td>
    <td><?= esc($d['nama']) ?></td>
    <td><?= esc($d['debit']) ?></td>
    <td><?= esc($d['kredit']) ?></td>
    <td><?= esc($d['saldo']) ?></td>
    <?php if($i > 0): ?>
    <td class="text-center"><button class="btn btn-danger btn-sm" onclick="return del_item(this, <?=$d['id']?>)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    <?php else: ?>
    <td></td>
    <?php endif ?>
</tr>
<?php endforeach ?>