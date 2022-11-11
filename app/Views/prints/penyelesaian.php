<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PENYELESAIAN</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= esc(base_url())?>/css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>

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

</body>