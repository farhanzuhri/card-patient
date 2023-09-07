<?php


$users = [
    ['id' => 1, 'username' => 'admin', 'password' => 'admin', 'role' => 'admin'],
    ['id' => 2, 'username' => 'operator', 'password' => 'operator', 'role' => 'operator'],
];

$sessionFilePath = 'login/sessions.json';

function getDataById($id) {
    global $users;
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}