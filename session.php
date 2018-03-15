<?php
session_start();
require_once('scripts/user.php');
$session=new User();

//If the user is not logged in, it will be redirected to the login page
if(!$session->LoggedIn()) {
    //redirect to login page
    $session->Redirect('index.php');
}