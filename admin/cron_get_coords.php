<?php

require_once("_connect.php");

$id = $_GET["myId"];

$mykey = "AIzaSyAD3HRSQhR-P4m5AlVV5s53ZDzGcdw0r0w";

$q = <<<MOUT
SELECT *
FROM shows
WHERE show_lat IS NULL
AND address IS NOT NULL
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {

	echo "<hr>";
	echo "Show: " . $row["show_nm"] . "<br>";
	$out = Array();
	
	$myAddress = str_replace(" ","%20",$row["address"]);

	echo "Address: " . $myAddress . "<br>";

	if (!trim($myAddress)) continue;

	$url = "https://maps.googleapis.com/maps/api/geocode/json?key=$mykey&address=$myAddress";

	$json = json_decode(file_get_contents($url));

	$mylat = $json->results[0]->geometry->location->lat;
	$mylong = $json->results[0]->geometry->location->lng;

	if ($mylat && $mylong){
		$q = sprintf ("UPDATE shows SET show_lat='%s', show_long='%s' WHERE show_pk = %d",
			$mylat,
			$mylong,
			$row["show_pk"]
			);
	
		$result2 = $conn->query($q);
		
		if ($result2){
			$out["err"] = 0;
			echo json_encode($out);
		}
		else{
			$out["msg"] = "There may have been a database problem when updating the record.  Please refresh and verify results.";
			$out["q"] = $q;
			$out["err"] = 1;
			echo json_encode($out);
		}
	}
	else {
		$out["msg"] = "There may have been a problem retrieving the coordinates.  Try again or do it manually.";
		$out["err"] = 1;
		echo json_encode($out);
	}

}


?>


