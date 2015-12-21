<?php

header('Content-type: application/json; charset=UTF-8');

require_once("_connect.php");

error_reporting(E_ALL);

echo "Starting<br>";

$conn->query("SET character_set_results=utf8");


/*
STATUSES
0 = Ready for load
1 = Completed successfully
2 = Show does not exist
3 = Required Field - Person
4 = Invalid date
5 = DB Error on Insert
6 = DB Error on Insert of Appearance
7 = DB Error on Insert of Media
8 = Invalid Media Type
*/


function setStatus($pk,$s){
	global $conn;
	$q2 = "UPDATE data_in SET data_status = $s WHERE load_pk = $pk";
	$conn->query($q2);
}

function getPerson($nm){
	global $conn;
	$q2 = sprintf("SELECT person_pk FROM people WHERE person_nm = '%s'",addslashes($nm));
	echo "$q2<br>";
	$result2 = $conn->query($q2);
	echo " --- getPerson <br>";
	if ($result2->num_rows){
		echo "person exists<br>";
		$row = $result2->fetch_assoc();
		return $row["person_pk"];
	}
	else{
		echo "inserting new person<br>";
		$q2 = sprintf("INSERT INTO people (person_nm) VALUES ('%s')",addslashes($nm));
		$result2 = $conn->query($q2);
		return $conn->insert_id;
	}
}

$q = <<<MOUT
SELECT *, DATE_FORMAT(STR_TO_DATE(dt,"%m/%d/%Y"),"%Y-%m-%d") dt1
FROM data_in_records
LEFT JOIN shows ON show_fk = show_pk
WHERE data_status = 0
MOUT;

echo "Query 1: $q<br>";

$result = $conn->query($q);

echo "Starting Loop<br>";

while($row = $result->fetch_assoc()) {

	echo "<hr>";
	print_r($row);
	echo "<br>";

	$pk = $row["load_pk"];

	echo "<hr>Row $pk<br>";

	if ($row["show_pk"]==""){
		setStatus($pk,2);
		continue;
	}

	if ($row["people"]==""){
		setStatus($pk,3);
		continue;
	}

	if ($row["dt"]==""){
		setStatus($pk,4);
		continue;
	}

	echo "finding person: " . $row["person"] . "<br>";
	$person_pk = getPerson($row["person"]);

	echo "pk returned: $person_pk<Br>";
	if ($person_pk=="") {
		setStatus($pk,5);
		continue;
	}

	echo "showpk: " . $row["show_pk"] . "<br>";

try {
	$q3 = sprintf("INSERT INTO appearances (show_fk,person_fk,appear_dt) VALUES (%d,%d,STR_TO_DATE('%s','%%m/%%d/%%Y'))",
		$row["show_pk"],
		$person_pk,
		$row["dt"]
		);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

	echo "query3: $q3 <br>";

	$result3 = $conn->query($q3);
	$appear_pk = "";
	$appear_pk = $conn->insert_id;
	if ($appear_pk=="") {
		setStatus($pk,6);
		continue;
	}

	echo "appear_pk: $appear_pk<Br>";

	$q3 = sprintf("INSERT INTO media (appear_fk,media_type,media_code,media_url,media_title,media_desc) VALUES (%d,%d,'%s','%s','%s','%s')",
		$appear_pk,
		$row["media_type"],
		$row["media_code"],
		$row["media_url"],
		$row["media_title"],
		$row["media_desc"]
		);

	echo "query3: $q3 <br>";

	$result3 = $conn->query($q3);
	$media_pk = "";
	$media_pk = $conn->insert_id;
	if ($media_pk=="") {
		$conn->query("DELETE FROM appearances WHERE appear_pk = $appear_pk");
		setStatus($pk,7);
		continue;
	}


}



?>


