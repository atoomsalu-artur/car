<?php
$db_server = 'localhost';
$db_andmebaas = 'car_rent';
$db_kasutaja = 'artur';
$db_salasona = 'artur';


// Ühendus andmebaasiga
$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);


// Ühenduse kontroll
if (!$yhendus) {
    die('Ei saa ühendust andmebaasiga');
}
?>