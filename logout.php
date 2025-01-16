<?php
require_once __DIR__ . '/classes/User.php';
use classes\User;
$logout = new User();
$logout->logout();
?>