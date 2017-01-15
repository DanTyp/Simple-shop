<?php

require_once __DIR__ . '/../src/connection.php';
require_once __DIR__ . '/../src/Admin.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $errorMessages = [];
    $successMessages = [];
    $newAdmin = new Admin();

    if (isset($_POST['email']) && is_string($_POST['email'])) {
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($emailB, FILTER_VALIDATE_EMAIL) == true && ($emailB == $email)) {

            if ($finalEmail = Admin::verifyEmailsAvailability($connection, $email)) {
                $newAdmin->setEmail($email);
            } else {
                $errorMessages['reservedEmail'] = 'The selected e-mail is already reserved!';
                $allIsRight = false;
            }
        } else {
            $errorMessages['invalidEmail'] = 'Please enter correct e-mail address!';
            $allIsRight = false;
        }
    }

    if (isset($_POST['password1']) && isset($_POST['password2'])) {
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if (strlen($password1) >= 8 && strlen($password1) <= 20 && $password1 === $password2) {
            $newAdmin->setHashedPassword($password1);
        } else if (strlen($password1) < 8 || strlen($password1) > 20) {
            $errorMessages['invalidPassword'] = "Password must have between 8 and 20 characters!";
            $allIsRight = false;
        } else {
            $errorMessages['differentPasswords'] = "Given passwords are not identical!";
            $allIsRight = false;
        }
    }
    
    if( $allIsRight == true) {
        $newAdmin->saveAdminToDB($connection);
        //header('Location: AdminLoginPage.php');
        $successMessages['newAdministratorAdded'] = 'New Administrator account has been succesfully added!';
    }
}
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SimpleShop - create free account!</title>
        <link rel="stylesheet" href="../assets/style.css" type="text/css">
    </head>

    <body>
        <form method="POST">

            E-mail: <br> <input type="text" name="email"><br>

            <?php
            if (isset($errorMessages['invalidEmail'])) {
                echo '<div class="error">' . $errorMessages['invalidEmail'] . '</div>';
            }
            if (isset($errorMessages['reservedEmail'])) {
                echo '<div class="error">' . $errorMessages['reservedEmail'] . '</div>';
            }
            ?>

            <br>
            Your password: <br> <input type="password" name="password1"><br>

            <br>
            Repeat password: <br> <input type="password" name="password2"><br>

            <?php
            if (isset($errorMessages['invalidPassword'])) {
                echo '<div class="error">' . $errorMessages['invalidPassword'] . '</div>';
            }
            if (isset($errorMessages['differentPasswords'])) {
                echo '<div class="error">' . $errorMessages['differentPasswords'] . '</div>';
            }
            if (isset($successMessages['newAdministratorAdded'])) {
                echo '<div class="success">' . $successMessages['newAdministratorAdded'] . '</div>';
            }
            
            ?>
            
            

            <br>

            <input type="submit" value="Register" />
            <br><br>
            <a href="AdministratorPanel.php">Go to the Administrator Panel</a>

        </form>
    </body>
</html>
