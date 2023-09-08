<?php
include '../config.php';


session_start();


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($id) {
        header('Location: /');
    }
}

$users = getAllData()['users'];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /');
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        <div class="form-control">
            <label for="username">Username</label>
            <input type="text" placeholder="Username" id="username" name="username">
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="text" placeholder="Password" id="password" name="password">
        </div>
        <div class="form-control">
            <button type="submit" name="login">Login</button>
            <button><a href="/register">Register</a></button>
        </div>
    </form>
</body>
</html>