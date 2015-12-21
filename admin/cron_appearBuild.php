<?php

require_once("_connect.php");

echo "Starting<br>";


/*
STATUSES
0 = Ready for load
1 = Completed successfully
2 = Show does not exist
3 = Missing required field (person, media type, dt)
4 = Invalid date
5 = DB Error on Insert of Person
6 = DB Error on Insert of Appearance
7 = DB Error on Insert of Media
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
		$row = $result->fetch_assoc();
		return $row["person_pk"];
	}
	else{
		$q2 = sprintf("INSERT INTO people (person_nm) VALUES ('%s')",addslashes($nm));
		$result2 = $conn->query($q2);
		return $conn->insert_id;
	}
}

$q = <<<MOUT
SELECT *, DATE_FORMAT(STR_TO_DATE(dt,"%m/%d/%Y"),"%Y-%m-%d") dt1
FROM data_in
LEFT JOIN shows ON show_fk = show_pk
WHERE data_status = 0
MOUT;

echo "Query 1<br>";

$result = $conn->query($q);

echo "Starting Loop<br>";

while($row = $result->fetch_assoc()) {

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

	if ($row["dt1"]==""){
		setStatus($pk,4);
		continue;
	}

	$people = explode("|",$row["people"]);

	echo "Ready to Load<br>";

	foreach ($people as $p){
		if ($p=="") continue;

		echo "Person: $p <br>";

		$person_pk = "";
		$person_pk = getPerson($p);

		echo "--- pk: $person_pk <br>";

		if ($person_pk=="") {
			setStatus($pk,5);
			continue;
		}

		$q3 = sprintf("INSERT INTO appearances (show_fk,person_fk,appear_dt) VALUES (%d,%d,'%s')",
			$row["show_pk"],
			$person_pk,
			$row["dt1"]
			);
		$result3 = $conn->query($q3);
		$appear_pk = "";
		$appear_pk = $conn->insert_id;
		if ($appear_pk=="") {
			setStatus($pk,6);
			continue;
		}

		$q3 = sprintf("INSERT INTO media (appear_fk,media_type,media_code,media_url,media_title,media_desc) VALUES (%d,%d,'%s','%s','%s','%s')",
			$appear_pk,
			$row["media_type"],
			$row["media_code"],
			$row["media_url"],
			$row["media_title"],
			$row["media_desc"]
			);
		$result3 = $conn->query($q3);
		$media_pk = "";
		$media_pk = $conn->insert_id;
		if ($media_pk=="") {
			setStatus($pk,7);
			continue;
		}

	}

}



$result = $conn->query($q);

if (!$myId) $myId = $conn->insert_id;

if ($myId){
	if ($myNotes){
		$q = sprintf ("INSERT INTO show_notes VALUES (%d,'%s') ON DUPLICATE KEY UPDATE show_notes = '%s'",
			$myId,
			addslashes($myNotes),
			addslashes($myNotes)
		);
	}
	else {
		$q = sprintf ("DELETE FROM show_notes WHERE show_fk = %d",
			$myId
		);
	}
	$conn->query($q);
}
else {
	$out["msg"] = "There may have been an error.  Please check the Shows page.";
	$out["q"] = $q;
	$out["err"] = 1;
	echo json_encode($out);
	exit();
}

$out["err"] = 0;
echo json_encode($out);

?>


