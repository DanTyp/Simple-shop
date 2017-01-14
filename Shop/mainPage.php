<?php
require_once __DIR__ . '/../src/session.php';

if (!isset($_SESSION['loggedUserId'])) {
    header('Location: UserLoginPage.php');
    exit();
}



echo "Wellcome to the Simple Shop!";
echo '<br>';

?>

<html>
    <body>
        <a href="UserLogoutPage.php">Go to the logout page</a>
    </body>
</html>

