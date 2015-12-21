<?php

echo "go...<br>";

require_once("../_connect.php");

echo "go...<br>";

$logname = "data_load_from_file";
$filename = 'files/204.csv';

if (file_exists($filename)) {
	process_file($filename);
}
else {

}

// *******************************************************************
// ****  process file  ***********************************************
// *******************************************************************

function process_file ($filename){

	global $conn;

	echome("Processing file $filename",1);

	$fi2 = file($filename);
	$filepath = $filename;

$sql = <<<MOUT
load data local infile '$filepath'
into table data_in2 
fields terminated by ","
optionally enclosed by "\""
lines terminated by "\r"
(show_fk,dt,people,media_type,media_code,media_url,media_title,media_desc)
MOUT;

	$conn->query($sql) or die("oops $sql");

//	echome("Deleting file",1);
//	unlink("$filepath");

	echome("Done");

}


// ****************************************
// ****************************************


?>


