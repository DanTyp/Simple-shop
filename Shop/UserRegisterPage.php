<?php
require_once __DIR__ . '/../src/session.php';
require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../src/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allIsRight = true;
    $errorMessages = [];
    $newUser = new User();

    if (isset($_POST['name']) && is_string($_POST['name']) && strlen(trim($_POST['name'])) > 0) {
        $newUser->setName(trim($_POST['name']));
    } else {
        $errorMessages['invalidName'] = 'Please enter correct name!';
        $allIsRight = false;
    }

    if (isset($_POST['surname']) && is_string($_POST['surname']) && strlen(trim($_POST['surname'])) > 0) {
        $newUser->setSurname(trim($_POST['surname']));
    } else {
        $errorMessages['invalidSurname'] = 'Please enter correct surname!';
        $allIsRight = false;
    }

    if (isset($_POST['country']) && is_string($_POST['country']) && strlen(trim($_POST['country'])) > 0) {
        $newUser->setCountry(trim($_POST['country']));
    } else {
        $errorMessages['invalidCountry'] = 'Please enter correct country name!';
        $allIsRight = false;
    }

    if (isset($_POST['city']) && is_string($_POST['city']) && strlen(trim($_POST['city'])) > 0) {
        $newUser->setCity(trim($_POST['city']));
    } else {
        $errorMessages['invalidCity'] = 'Please enter correct city name!';
        $allIsRight = false;
    }
    
    if (isset($_POST['street']) && is_string($_POST['street']) && strlen(trim($_POST['street'])) > 0) {
        $newUser->setStreet(trim($_POST['street']));
    } else {
        $errorMessages['invalidStreet'] = 'Please enter correct street name!';
        $allIsRight = false;
    }

    if (isset($_POST['postalCode']) && preg_match('/[0-9][0-9]-[0-9][0-9][0-9]/', $_POST['postalCode']) == 1) {
        $newUser->setPostalCode($_POST['postalCode']);
    } else {
        $errorMessages['invalidPostalCode'] = 'Please enter correct postal code!';
        $allIsRight = false;
    }

    if (isset($_POST['houseNo']) && preg_match('/[0-9]+[A-Z]{0,1}|[0-9]+[a-z]{0,1}/', $_POST['houseNo']) == 1) {
        $newUser->setHouseNo($_POST['houseNo']);
    } else {
        $errorMessages['invalidHouseNo'] = 'Please enter correct house number!';
        $allIsRight = false;
    }

    if (isset($_POST['apartmentNo']) && preg_match('/[0-9]*/', $_POST['apartmentNo']) == 1) {
        $newUser->setApartmentNo($_POST['apartmentNo']);
    } else {
        $errorMessages['invalidApartmentNo'] = 'Please enter correct apartment number!';
        $allIsRight = false;
    }
    
    if (isset($_POST['email']) && is_string($_POST['email'])){
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);  
        
        if (filter_var($emailB, FILTER_VALIDATE_EMAIL) == true && ($emailB == $email)) {
            
            if($finalEmail = User::verifyEmailsAvailability($connection, $email)) {
                $newUser->setEmail($email);
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
            $newUser->setHashedPassword($password1);
        } else if (strlen($password1) < 8 || strlen($password1) > 20) {
            $errorMessages['invalidPassword'] = "Password must have between 8 and 20 characters!";
            $allIsRight = false;
        } else {
            $errorMessages['differentPasswords'] = "Given passwords are not identical!";
            $allIsRight = false;
        }
    }
    
    if (!isset($_POST['regulations'])) {
        $allIsRight = false;
        $errorMessages['regulationsError'] = "Confirm acceptance of the Regulations!";
    }
    
    if( $allIsRight == true) {
        $newUser->saveUserToDB($connection);
        header('Location: UserLoginPage.php');
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
            Street: <br> <input type="text" name="street"><br>
            <?php
            if (isset($errorMessages['invalidStreet'])) {
                echo '<div class="error">' . $errorMessages['invalidStreet'] . '</div>';
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
            ?>

            <br>
            <label>
                <input type="checkbox" name="regulations" />I accept Regulations
            </label>
            <br>

            <?php 
            if (isset($errorMessages['regulationsError'])) {
                echo '<div class="error">' . $errorMessages['regulationsError'] . '</div>';
            }
            ?>

            <br>

            <input type="submit" value="Register" />
            <br><br>
            <a href="UserLoginPage.php">Go to the login page</a>

        </form>
    </body>
</html>