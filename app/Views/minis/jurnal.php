<?php foreach($data as $i => $d): ?>
<tr>
    <td><?= esc($i) ?></td>
    <td><?= esc("$i-$month-$year") ?></td>
    <td class="text-right"><?= esc($d) ?></td>
    <td><a href="<?= base_url()?>/jurnal/harian/<?= esc("$year-$month-$i") ?>" class="btn btn-primary">Lihat</a></td>
</tr>
<?php endforeach ?>