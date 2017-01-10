<?php
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $exMessages = [];

    try {

        $newUser = new User();

        if (isset($_POST['name'])) {
            $newUser->setName($_POST['name']);
        }
        if (isset($_POST['surname'])) {
            $newUser->setSurname($_POST['surname']);
        }
        if (isset($_POST['email'])) {
            $newUser->setEmail($_POST['email']);
        }
        if (isset($_POST['password1']) && isset($_POST['password2'])) {
            $newUser->setHashedPassword($_POST['password1'], $_POST['password2']);
        }
    } catch (InvalidNameException $ex) {
        $exMessages['name'] = $ex->getMessage();
    } catch (InvalidSurnameException $ex) {
        $exMessages['surname'] = $ex->getMessage();
    } catch (InvalidEmailException $ex) {
        $exMessages['email'] = $ex->getMessage();
    } catch (InvalidPasswordException $ex) {
        $exMessages['invalidPassword'] = $ex->getMessage();
    } catch (DifferentPasswordsException $ex) {
        $exMessages['differentPasswords'] = $ex->getMessage();
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
            echo $exMessages['name'] . '<br>';
            }
            ?>

            <br>
            Surname: <br> <input type="text" name="surname"><br>

            <?php
            if (isset($exMessages['surname'])) {
            echo $exMessages['surname'] . '<br>';
            }
            ?>

            <br>
            E-mail: <br> <input type="text" name="email"><br>

            <?php
            if (isset($exMessages['email'])) {
            echo $exMessages['email'] . '<br>';
            }
            ?>

            <br>
            Your password: <br> <input type="password" name="password1"><br>

            <br>
            Repeat password: <br> <input type="password" name="password2"><br>

            <?php
            if (isset($exMessages['invalidPassword'])) {
            echo $exMessages['invalidPassword'] . '<br>';
            }
            if (isset($exMessages['differentPasswords'])) {
            echo $exMessages['differentPasswords'] . '<br>';
            }
            ?>

            <br>
            <label>
                <input type="checkbox" name="regulations" />I accept regulations
            </label>
            <br>

            <?php
            ?>

            <br>

            <input type="submit" value="Register" />
            <br><br>
            <a href="UserLoginPage.php">Go to the login page</a>

        </form>
    </body>
</html>