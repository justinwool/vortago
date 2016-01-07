<?php

echo "go...<br>";

require_once("../_connect.php");

echo "go...<br>";

$dir    = 'data/files';
$files = scandir($dir,0);
print_r($files);

$logname = "data_load_from_file";

foreach ($files as $filename){
	if (substr($filename,-4)==".csv") {
		process_file($dir."/".$filename);
	}
	else {
	}
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
into table data_in
fields terminated by ","
optionally enclosed by "\""
lines terminated by "\r"
IGNORE 1 ROWS
(show_fk,dt,people,media_type,media_code,media_title,media_desc)
MOUT;

	$conn->query($sql) or die("oops $sql");

//	echome("Deleting file",1);
//	unlink("$filepath");

	echome("Done");

}


// ****************************************
// ****************************************


?>


