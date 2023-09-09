<?php

define('PROJECT_ROOT', __DIR__);

function getAllData($file = PROJECT_ROOT . '/data.json')
{

    // $data = [];
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
    } else {
        $data = [];
    }


    return $data;
}

function putData($data, $file = PROJECT_ROOT . '/data.json')
{
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

function getDataById($table, $id)
{
    $data = getAllData();
    $existingData = array_column($data[$table], 'id');
    if (in_array($id, $existingData)) {
        return $data[$table][array_search($id, $existingData)];
    }
    return [];
}

// getalldatabyrow
function getDataByRow($table, $row)
{
    $data = getAllData();
    $existingData = array_column($data[$table], $row);
    return $existingData;
}

function hitungUmurDenganBulan($tanggal_lahir) {
    // Pecah tanggal lahir menjadi komponen-komponennya
    list($hari, $bulan, $tahun) = explode('/', $tanggal_lahir);

    // Dapatkan tanggal saat ini
    $tanggal_sekarang = date('d/m/Y');

    // Pecah tanggal saat ini menjadi komponen-komponennya
    list($hari_sekarang, $bulan_sekarang, $tahun_sekarang) = explode('/', $tanggal_sekarang);

    // Hitung umur dalam tahun
    $umurTahun = $tahun_sekarang - $tahun;

    // Hitung total bulan
    $umurBulan = $bulan_sekarang - $bulan;

    // Periksa apakah sudah ulang tahun atau belum
    if ($hari_sekarang < $hari) {
        $umurBulan--;
    }

    // Jika hasil total bulan negatif, tambahkan 12 bulan
    if ($umurBulan < 0) {
        $umurBulan += 12;
        $umurTahun--;
    }

    return ['tahun' => $umurTahun, 'bulan' => $umurBulan];
}

function generateUniqueId($length = 10) {
    $characters = '0123456789';
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $result;
}

$uniqueId = generateUniqueId();

