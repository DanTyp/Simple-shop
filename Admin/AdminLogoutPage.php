<?php
require_once __DIR__ . '/../src/session.php';

session_unset();

header('Location: AdminLoginPage.php');

?>
