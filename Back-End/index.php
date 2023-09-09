<?php

include './config.php';

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: /login');
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: /login');
}

if (isset($_POST['newDaerah'])) {
    $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $data = getAllData();

    $data['citys'][] = [
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan
    ];
    putData($data);
    header('Location: /');
}

if (isset($_POST['newPatient'])) {
    // unique patient_id with start TSX-
    $patient_id = 'TSX-' . generateUniqueId();
    $name = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $city = [$_POST['provinsi'], $_POST['kabupaten'], $_POST['kecamatan']];
    $number = $_POST['number'];
    $rtrw = $_POST['rtrw'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gender = $_POST['gender'];
    $data = getAllData();
    $data['cards'][] = [
        'patient_id' => $patient_id,
        'name' => $name,
        'alamat' => $alamat,
        'city' => $city,
        'number' => $number,
        'rtrw' => $rtrw,
        'tanggal_lahir' => $tanggal_lahir,
        'gender' => $gender
    ];

    putData($data);
    header('Location: /cards?id=' . $patient_id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>

<body>
    <?php
    $user = getDataById('users', $_SESSION['id']);
    if ($user['role'] == 'admin') {
    ?>
        <h1>ADMIN</h1>
        <p>Form Daerah</p>
        <hr>
        <form action="" method="POST">
            <div class="form-control">
                <label for="provinsi">Provinsi</label>
                <input type="text" placeholder="provinsi" id="provinsi" name="provinsi">
            </div>
            <div class="form-control">
                <label for="kabupaten">Kabupaten</label>
                <input type="text" placeholder="kabupaten" id="kabupaten" name="kabupaten">
            </div>
            <div class="form-control">
                <label for="kecamatan">Kecamatan</label>
                <input type="text" placeholder="Kecamatan" id="kecamatan" name="kecamatan">
            </div>
            <div class="form-control">
                <button type="submit" name="newDaerah">Submit</button>
            </div>
        </form>
    <?php } elseif ($user['role'] == 'operator') { ?>
        <h1>OPERATOR</h1>
        <p>Form Card Patient</p>
        <hr>
        <form action="" method="POST">
            <div class="form-control">
                <label for="nama">Nama</label>
                <input type="text" placeholder="Nama" id="nama" name="nama">
            </div>
            <div class="form-control">
                <label for="alamat">Alamat</label>
                <input type="text" placeholder="Alamat" id="alamat" name="alamat">
            </div>
            <div class="form-control">
                <label for="provinsi">Provinsi</label>
                <select name="provinsi" id="provinsi">
                    <?php
                    $provinsi = getDataByRow('citys', 'provinsi');
                    foreach ($provinsi as $k) {
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    ?>
                </select>
                <label for="kabupaten">Kabupaten</label>
                <select name="kabupaten" id="kabupaten">
                    <?php
                    $kabupaten = getDataByRow('citys', 'kabupaten');
                    foreach ($kabupaten as $k) {
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    ?>
                </select>
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan">
                    <?php
                    $kecamatan = getDataByRow('citys', 'kecamatan');
                    foreach ($kecamatan as $k) {
                        echo "<option value='" . $k . "'>" . $k . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-control">
                <label for="number">No Telp</label>
                <input type="text" placeholder="No Telp" id="number" name="number">
            </div>
            <div class="form-control">
                <label for="rtrw">RT / RW</label>
                <input type="text" placeholder="RT / RW" id="rtrw" name="rtrw">
            </div>
            <div class="form-control">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="text" placeholder="Tanggal Lahir" id="tanggal_lahir" name="tanggal_lahir">
            </div>
            <div class="form-control">
                <label for="gender">Jenis Kelamin</label>
                <select name="gender" id="gender">
                    <option value="Male">Laki Laki</option>
                    <option value="Female">Perempuan</option>
                </select>
            </div>
            <div class="form-control">
                <button type="submit" name="newPatient">Submit</button>
            </div>
        </form>
    <?php } ?>
    <hr>
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>

</html>