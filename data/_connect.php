<?php

/*
$hostname='localhost';
$username='appgam5_celeb';
$password='Dago1234';
$dbname='appgam5_celeb';
*/

$hostname='localhost';
$username='appgam5_wpCeleb';
$password='lQx)2]P5S6';
$dbname='appgam5_wpCeleb';


$conn = new mysqli($hostname, $username, $password, $dbname);

$conn -> select_db($dbname);

error_reporting(1);

?>