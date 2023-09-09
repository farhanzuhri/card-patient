<?php

include '../config.php';

$data = null;
if (isset($_GET['id'])) {

    $patient_id = getDataByRow('cards', 'patient_id');
    $allData = getAllData();
    $data = getDataById('cards', $_GET['id']) ? getDataById('cards', $_GET['id']) : $allData['cards'][array_search($_GET['id'], $patient_id)];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Patient - <?= $data['name'] ?></title>
    <style>
        .container span {
            display: block;
        }
    </style>
</head>

<body>
    <?php if ($data) : ?>
        <div class="container">
            <span><b>ID Pasien </b>: <i><?= $data['patient_id'] ?></i></span>
            <span><b>Nama </b>: <i><?= $data['name'] ?></i></span>
            <span><b>Umur </b>: <i><?= hitungUmurDenganBulan($data['tanggal_lahir'])['tahun'] ?> tahun, <?= hitungUmurDenganBulan($data['tanggal_lahir'])['bulan'] ?> bulan</i></span>
            <span><b>Alamat </b>: <i><?= $data['alamat'] ?></i></span>
            <span><b>RT / RW </b>: <i><?= $data['rtrw'] ?></i></span>
            <span><b>Provinsi </b>: <i><?= $data['city'][0] ?></i></span>
            <span><b>Kabupaten </b>: <i><?= $data['city'][1] ?></i></span>
            <span><b>Kelurahan / Desa </b>: <i><?= $data['city'][2] ?></i></span>
            <span><b>No Telepon </b>: <i><?= $data['number'] ?></i></span>
            <span><b>Tanggal Lahir </b>: <i><?= $data['tanggal_lahir'] ?></i></span>
            <span><b>Gender </b>: <i><?= $data['gender'] ?></i></span>
        </div>
    <?php else : ?>
        <h1>Data Not Found</h1>
    <?php endif; ?>
</body>

</html>