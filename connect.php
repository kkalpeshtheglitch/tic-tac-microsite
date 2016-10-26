<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kurkure_db";*/


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tictacco_microsite";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
ini_set('session.cookie_httponly', 1);
?>