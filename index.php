<?php
require_once('user.php');

$us = new User();
$us->ConnectDB("localhost", "phplogin", "root", "root");
$us->Query("INSERT INTO user (username, email, password) VALUES ('daddolo','davide20799@gmail.com', 'provaprova123')");
