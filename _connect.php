<?php

/*
$hostname='localhost';
$username='appgam5_celeb';
$password='Dago1234';
$dbname='appgam5_celeb';
*/

$hostname='localhost';
$username='appgam5_vortago';
$password='B)XBCK*Q&kf*';
$dbname='appgam5_vortago';


$conn = new mysqli($hostname, $username, $password, $dbname);

$conn->set_charset("utf8");

$conn -> select_db($dbname);

$conn->query("SET character_set_results=utf8");

error_reporting(0);

?>