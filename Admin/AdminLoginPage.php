<?php
require_once __DIR__ . '/../src/Admin.php';
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/connection.php';

if (isset($_SESSION['loggedAdminId'])) {
    header('Location: AdministratorPanel.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errorMessages = [];
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($adminId = Admin::verifyEmailAndPassword($connection, $email, $password)) {
            $_SESSION['loggedAdminId'] = $adminId;
            header('Location: AdministratorPanel.php');
        } else {
            $errorMessages['invalidEmailOrPassword'] = 'Invalid e-mail or password!';
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Simple shop - sign in!</title>
        <link rel="stylesheet" href="../assets/style.css" type="text/css">
    </head>

    <body>

        Welcome to Administrator Panel! Sign in!<br /><br />

        <form action="AdminLoginPage.php" method="POST">

            E-mail:<br> <input type = "text" name="email" /> <br>
            Password:<br> <input type = "password" name="password" /> <br>
            <?php
            if (isset($errorMessages['invalidEmailOrPassword'])) {
                echo '<div class="error">' . $errorMessages['invalidEmailOrPassword'] . '</div>';
            }
            ?>
            <br>
            <input type="submit" value="Zaloguj się" />


        </form>

    </body>
</html>
