<?php
require_once 'src/session.php';

session_unset();

header('Location: mainPage.php');

?>
