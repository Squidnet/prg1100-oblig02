<?php   //db-connect.php

$host = "host";
$user = "user";
$password = "password";
$database = "database";

$db = mysqli_connect($host, $user, $password, $database) or die ("Tilkobling misslykket..");

?>