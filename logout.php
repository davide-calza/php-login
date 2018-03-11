<?php
require_once('session.php');
require_once('user.php');
$user = new USER();

if($user->LoggedIn()!=""){
    $user->redirect('home.php');
}
if(isset($_GET['logout']) && $_GET['logout']=="true"){
    $user->Logout();
    $user->Redirect('index.php');
}