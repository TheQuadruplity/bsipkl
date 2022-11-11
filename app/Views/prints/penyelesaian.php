<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PENYELESAIAN</title>
</head>

<body>
    <h1 style="text-align: center;">Penyelesaian Persekot</h1>
    <h3 style="text-align: center;">Waktu: <?= $waktu ?></h3>
    <table style="width: 100%; border-collapse: collapse; border-style: solid;" border="1">
        <thead>
            <tr>
                <th>Rekening Beban</th>
                <th>Beban</th>
                <th>Debet</th>
                <th>Rekening Persekot</th>
                <th>Narasi</th>
                <th>Kredit</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody id="listbeban" name="lists">
            <?php foreach($data as $d): ?>
                
                <tr>
                    <td><?= esc($d['rekening_beban']) ?></td>
                    <td><?= esc($d['nama_beban']) ?></td>
                    <td><?= esc($d['jumlah_beban']) ?></td>
                    <td><?= esc($d['rekening_persekot']) ?></td>
                    <td><?= esc($d['narasi_persekot']) ?></td>
                    <td><?= esc($d['jumlah_persekot']) ?></td>
                    <td><?= esc($d['keterangan']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <p>PT BANK SYARIAH INDONESIA TBK</p>
    <p>AREA SEMARANG KOTA</p>
    <table style="width: 61.0794%; border-collapse: collapse; border-style: none;">
        <tbody>
            <tr>
                <td style="width: 29.1666%;">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><?= esc($man['area_manager']) ?></p>
                    <p>Area Manager</p>
                </td>
                <td style="width: 26.1092%;">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><?= esc($man['pj_aosm']) ?></p>
                    <p>AOSM</p>
                </td>
            </tr>
        </tbody>
    </table>

    <script>window.onfocus=window.close;
    window.print();
    </script>

</body>