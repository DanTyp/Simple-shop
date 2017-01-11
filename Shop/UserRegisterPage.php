<?php
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $errorMessages = [];
    $newUser = new User();

    if (isset($_POST['name']) && is_string($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $newUser->setName(trim($_POST['name']));
    } else {
        $errorMessages['invalidName'] = 'Please enter correct name!';
    }

    if (isset($_POST['surname']) && is_string($_POST['surname']) && strlen(trim($_POST['surname'])) > 0) {
        $newUser->setSurname(trim($_POST['name']));
    } else {
        $errorMessages['invalidSurname'] = 'Please enter correct surname!';
    }

    if (isset($_POST['country']) && is_string($_POST['country']) && strlen(trim($_POST['country'])) > 0) {
        $newUser->setCountry(trim($_POST['country']));
    } else {
        $errorMessages['invalidCountry'] = 'Please enter correct country name!';
    }

    if (isset($_POST['city']) && is_string($_POST['city']) && strlen(trim($_POST['city'])) > 0) {
        $newUser->setCountry(trim($_POST['city']));
    } else {
        $errorMessages['invalidCity'] = 'Please enter correct city name!';
    }

    if (isset($_POST['postalCode']) && preg_match('/[0-9][0-9]-[0-9][0-9][0-9]/', $_POST['postalCode']) == 1) {
        $newUser->setPostalCode($_POST['postalCode']);
    } else {
        $errorMessages['invalidPostalCode'] = 'Please enter correct postal code!';
    }

    if (isset($_POST['houseNo']) && preg_match('/[0-9]+[A-Z]{0,1}|[0-9]+[a-z]{0,1}/', $_POST['houseNo']) == 1) {
        $newUser->setPostalCode($_POST['houseNo']);
    } else {
        $errorMessages['invalidHouseNo'] = 'Please enter correct house number!';
    }

    if (isset($_POST['apartmentNo']) && preg_match('/[0-9]*/', $_POST['apartmentNo']) == 1) {
        $newUser->setPostalCode($_POST['apartmentNo']);
    } else {
        $errorMessages['invalidApartmentNo'] = 'Please enter correct apartment number!';
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

            Name: <br> <input type="text" name="name"><br>

            <?php
            if (isset($errorMessages['invalidName'])) {
                echo '<div class="error">' . $errorMessages['invalidName'] . '</div>';
            }
            ?>

            <br>
            Surname: <br> <input type="text" name="surname"><br>

            <?php
            if (isset($errorMessages['invalidSurname'])) {
                echo '<div class="error">' . $errorMessages['invalidSurname'] . '</div>';
            }
            ?>

            <br>
            Country: <br> <input type="text" name="country"><br>
            <?php
            if (isset($errorMessages['invalidCountry'])) {
                echo '<div class="error">' . $errorMessages['invalidCountry'] . '</div>';
            }
            ?>

            <br>
            City: <br> <input type="text" name="city"><br>
            <?php
            if (isset($errorMessages['invalidCity'])) {
                echo '<div class="error">' . $errorMessages['invalidCity'] . '</div>';
            }
            ?>


            <br>
            Postal Code: <br> <input type="text" name="postalCode"><br>
            <?php
            if (isset($errorMessages['invalidPostalCode'])) {
                echo '<div class="error">' . $errorMessages['invalidPostalCode'] . '</div>';
            }
            ?>

            <br>
            House number: <br> <input type="text" name="houseNo"><br>
            <?php
            if (isset($errorMessages['invalidHouseNo'])) {
                echo '<div class="error">' . $errorMessages['invalidHouseNo'] . '</div>';
            }
            ?>

            <br>
            Apartment number: <br> <input type="text" name="apartmentNo"><br>
            <?php
            if (isset($errorMessages['invalidApartmentNo'])) {
                echo '<div class="error">' . $errorMessages['invalidApartmentNo'] . '</div>';
            }
            ?>

            <br>
            E-mail: <br> <input type="text" name="email"><br>

            <?php
            ?>

            <br>
            Your password: <br> <input type="password" name="password1"><br>

            <br>
            Repeat password: <br> <input type="password" name="password2"><br>

            <?php
            ?>

            <br>
            <label>
                <input type="checkbox" name="regulations" />I accept regulations
            </label>
            <br>

            <?php ?>

            <br>

            <input type="submit" value="Register" />
            <br><br>
            <a href="UserLoginPage.php">Go to the login page</a>

        </form>
    </body>
</html>