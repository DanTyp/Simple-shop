<?php
require_once __DIR__ . '/../src/session.php';

if (!isset($_SESSION['loggedAdminId'])) {
    header('Location: AdminLoginPage.php');
    exit();
}

var_dump($_SESSION);



echo "Wellcome to Administrator Panel!";
echo '<br>';
?>

<html>
    <body>
        <a href="AdminRegisterPage.php">Registration - register new Administrator!</a>
        <br><br>
        <a href="AdminLogoutPage.php">Go to the logout page</a>
    </body>
</html>