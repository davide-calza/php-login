<?php
require_once('user.php');

$us = new User();
$us->ConnectDB("localhost", "phplogin", "root", "root");
$us->Register("davide", "davide@calza.it", "password1234");
