<?php
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/Shop/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $newUser = new User();
    
    if(isset($_POST['username'])){
        try {
            $newUser->setName($_POST['username']);
        } catch (InvalidNameException $ex) {
            echo  $ex->getMessage();
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

            Name: <br> <input type="text" name="username"><br>

            <?php
                
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
            <a href="loginPage.php">Go to the login page</a>

        </form>
    </body>
</html>