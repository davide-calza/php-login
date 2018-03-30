<?php
session_start();
require_once('php/user.php');
require_once('php/script.php');
$session=new User();

/**  If the user is not logged in, it will be redirected to the login page */
Script::RedirectToLogin($session);