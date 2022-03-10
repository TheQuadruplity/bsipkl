<?php foreach($data as $i => $d): ?>
<tr>
    <td><?= esc($i) ?></td>
    <td><?= esc("$i-$month-$year") ?></td>
    <td style="text-align: right;"><?= esc($d) ?></td>
    <td><a href="<?= base_url()?>/posneraca/harian/<?= esc("$year-$month-$i") ?>" class="btn btn-primary">Lihat</a></td>
</tr>
<?php endforeach ?>