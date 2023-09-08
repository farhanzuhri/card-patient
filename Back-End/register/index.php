<?php

include '../config.php';

session_start();
if (isset($_SESSION['id'])) {
    header('Location: /');
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password == $cpassword) {
        $users = getAllData()['users'];
        $table_users = getDataByRow('users', 'username');

        $status = true;
        if (in_array($username, $table_users)) {
            $_SESSION['error'] = 'Username already exists';
            $status = false;
        }
        $table_email = getDataByRow('users', 'email');
        if (in_array($email, $table_email)) {
            $_SESSION['error'] = 'Email already exists';
            $status = false;
        }

        if ($status) {
            $users[] = [
                'id' => count($users) + 1,
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'role' => 'admin'
            ];
            $datas = getAllData();
            $datas['users'] = $users;

            putData($datas);
            $_SESSION['message'] = 'Success';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div>
        <form action="" method="POST" onsubmit="return validate">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" id="name" name="name">
            </div>
            <div class="form-control">
                <label for="email">Email Address</label>
                <input type="email" placeholder="Email" id="email" name="email">
            </div>
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" placeholder="Username" id="username" name="username">
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="text" placeholder="Password" id="password" name="password">
            </div>
            <div class="form-control">
                <label for="cpassword">Confirm Password</label>
                <input type="text" placeholder="Confirm Password" id="cpassword" name="cpassword">
            </div>
            <div class="form-control">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
    </div>
    <script>
        <?php if (isset($_SESSION['error'])): ?>
            alert("<?= $_SESSION['error'] ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            alert("<?= $_SESSION['message'] ?>");
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        function validate() {
            const password = document.getElementById('password').value;
            const cpassword = document.getElementById('cpassword').value;
            if (password != cpassword) {
                alert('Password does not match');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>