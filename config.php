<?php
$host = "localhost";
$user = "caruser";
$pass = "carpass123";
$dbname = "car_rent";

$yhendus = mysqli_connect($host, $user, $pass, $dbname);

if (!$yhendus) {
    die("Andmebaasi ühendus ebaõnnestus: " . mysqli_connect_error());
}
?>
