<?php

require_once("../_connect.php");

$filename = "testload.txt";

$sql = "TRUNCATE test_hold";
$conn->query($sql) or die("oops - $sql");

$sql = <<<MOUT
load data local infile '$filename'
into table test_hold
character set utf8
lines terminated by "\r\n"
(vidid,pubdt,vidtit,viddesc)
MOUT;

$conn->query($sql) or die("oops $sql");

$sql = <<<MOUT
SHOW WARNINGS
MOUT;

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	echo $row["Level"] . " " . $row["Code"] . " :    " . $row["Message"] . "<br>";

//	print_r($row);
//	echo $row["Level"];

}



?>


