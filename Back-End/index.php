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
        $user = getDataById($_SESSION['id']);
        echo "<h1>Hello, " . $user['username'] . "</h1>";
        echo "<h1>Role: " . $user['role'] . "</h1>";
    ?>
    <hr>
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>