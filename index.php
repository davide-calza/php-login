<?php
session_start();
require_once('user.php');
$login = new User();

if($login->LoggedIn()){
    $login->redirect('home.php');
    echo "LOGGED IN INDEX";
}

