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

    $data['daerahs'][] = [
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan
    ];
    putData($data);
    header('Location: /');
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
                        $provinsi = getDataByRow('daerahs', 'provinsi');
                        foreach ($provinsi as $k) {
                            echo "<option value='" . $k . "'>" . $k . "</option>";
                        }
                    ?>
                </select>
                <label for="kabupaten">Kabupaten</label>
                <select name="kabupaten" id="kabupaten">
                    <?php
                        $kabupaten = getDataByRow('daerahs', 'kabupaten');
                        foreach ($kabupaten as $k) {
                            echo "<option value='" . $k . "'>" . $k . "</option>";
                        }
                    ?>
                </select>
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan">
                    <?php
                        $kecamatan = getDataByRow('daerahs', 'kecamatan');
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
                <label for="tglLahir">Tanggal Lahir</label>
                <input type="text" placeholder="Tanggal Lahir" id="tglLahir" name="tglLahir">
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