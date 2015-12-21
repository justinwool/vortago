<?php

require_once("../_connect.php");

$filename = "testload.txt";

$sql = <<<MOUT
load data local infile '$filename'
into table test_hold
lines terminated by "\r\n"
MOUT;

$conn->query($sql) or die("oops $sql");




?>


