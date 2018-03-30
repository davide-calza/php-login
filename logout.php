<?php
require_once('session.php');
require_once('php/user.php');
$user = new USER();

/** If users are already logged in, they will be redirected to home.php */
if($user->LoggedIn()!=""){
    $user->redirect('home.php');
}

/** If logout variable is set, it will be redirected to login form */
if(isset($_GET['logout']) && $_GET['logout']=="true"){
    $user->Logout();
    $user->Redirect('index.php');
}