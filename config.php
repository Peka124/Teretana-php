<?php

session_start();

$servername="localhost";
$db_username="root";
$db_password="";
$database_name="teretana";

$konekcija=mysqli_connect($servername, $db_username, $db_password, $database_name);

if(!$konekcija)
{
    die("Neuspesna konekcija sa bazom");
}

?>