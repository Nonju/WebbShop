<?php
//PDO-connection with password, username and stuff

$dbserver = "hannes2-192206.mysql.binero.se";
$database = "192206-hannes2";
$username = "192206_sx46985";
$password = "Zerg6pool";


$dbh = new PDO("mysql:host={$dbserver}; dbname={$database}; charset=utf8",$username,$password);
