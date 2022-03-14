<?php foreach($data as $i => $d): ?>
<tr>
    <td><?= esc($i) ?></td>
    <td><?= esc("$i-$month-$year") ?></td>
    <td class="text-right"><?= esc($d) ?></td>
    <td class="text-center"><a href="<?= base_url("jurnal/harian/$year-$month-$i")?>" class="btn btn-primary btn-icon-split btn-sm"><span class="icon text-white-50">
                              <i class="fas fa-scroll"></i></span><span class="text">Lihat</span></a></td>
    
</tr>
<?php endforeach ?>