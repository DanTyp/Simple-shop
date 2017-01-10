<?php
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../exceptions/InvalidNameException.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $newUser = new User();
    $exMessages = [];
    
    if(isset($_POST['name'])){
        try {
            $newUser->setName($_POST['name']);
        } catch (InvalidNameException $ex) {
            $exMessages['name'] = $ex->getMessage();
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SimpleShop - create free account!</title>
    </head>

    <body>
        <form method="POST">

            Name: <br> <input type="text" name="name"><br>

            <?php
            if (isset($exMessages['name'])) {
                echo $exMessages['name'];
            }                
            ?>
            
            Surname: <br> <input type="text" name="surname"><br>

            <?php

            ?>

            E-mail: <br> <input type="text" name="email"><br>

            <?php

            ?>

            Your password: <br> <input type="password" name="password1"><br>


            Repeat password: <br> <input type="password" name="password2"><br>

            <?php

            ?>

            <label>
                <input type="checkbox" name="regulations" />I accept regulations
            </label>
            <?php

            ?>

            <br>

            <input type="submit" value="Register" />
            <br>
            <a href="UserLoginPage.php">Go to the login page</a>

        </form>
    </body>
</html>