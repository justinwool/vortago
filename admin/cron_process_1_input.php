<?php

require_once("_connect.php");

echo "Starting<br>";

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

$q = "SELECT * FROM media_types";
$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$media_code_required[$row["media_type_pk"]] = $row["code_required"];
	$media_url_required[$row["media_type_pk"]] = $row["url_required"];
}

$q = <<<MOUT
SELECT *
FROM data_in
LEFT JOIN shows ON show_fk = show_pk
WHERE data_status = 0
MOUT;

echo "Query 1<br>";

$conn->query("SET character_set_results=utf8");

$result = $conn->query($q);

echo "Starting Loop<br>";

while($row = $result->fetch_assoc()) {

	$pk = $row["load_pk"];

	if ($row["show_pk"]==""){
		setStatus($pk,2);
		continue;
	}

	if (trim($row["people"])==""){
		setStatus($pk,3);
		continue;
	}

	echo "Media Type: " . $row["media_type"] . "<br>";
	echo "Media Code: " . $row["media_code"] . "<br>";
	echo "Key Exists: " . array_key_exists($row["media_type"],$media_code_required) . "<br>";
	echo "Media Code Req: " . $media_types[$row["media_type"]] . "<br>";

	if ($row["media_type"]==""){
	}
	else {
		if (!array_key_exists($row["media_type"],$media_code_required)){
			setStatus($pk,8);
			continue;
		}
		else {
			if ($media_code_required[$row["media_type"]] && trim($row["media_code"]=="")){
				echo "*****";
				setStatus($pk,8);
				continue;
			}
			if ($media_url_required[$row["media_type"]] && trim($row["media_url"]=="")){
				echo "*****";
				setStatus($pk,8);
				continue;
			}
		}
	}

	$dtPieces = explode("/",$row["dt"]);

	if (!checkdate($dtPieces[0],$dtPieces[1],$dtPieces[2])){
		setStatus($pk,4);
		continue;
	}

	$people = explode("|",$row["people"]);

	foreach ($people as $p){
		if ($p=="") continue;

		echo "Person: $p <br>";

		$q3 = sprintf("INSERT INTO data_in_records SELECT *, '%s' FROM data_in WHERE load_pk = %d",
			$p,
			$pk
			);
		echo "$q3 <br>";
		if(!$conn->query($q3)){
			$conn->query("DELETE FROM data_in_records WHERE load_pk = $pk");
			setStatus($pk,5);
			continue 2;
		}

	}

	setStatus($pk,1);

}


?>


