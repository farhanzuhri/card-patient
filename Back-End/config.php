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
    // foreach ($users as $user) {
    //     if ($user['id'] == $id) {
    //         return $user;
    //     }
    // }
    return [];
}

// getalldatabyrow
function getDataByRow($table, $row)
{
    $data = getAllData();
    $existingData = array_column($data[$table], $row);
    return $existingData;
}
