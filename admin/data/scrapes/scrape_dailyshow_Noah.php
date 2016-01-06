<?php

$show = "Daily Show with Trevor Noah";

$url = "http://www.cc.com/feeds/ent_m112_cc/V1_0_5/980d89f3-ccac-4cd7-b463-9208cad3555e/7c2d44b4-c8b1-43a9-9bfc-32af988eab20/?fullEpisodes=0&hash=e042d08deed56f8981241046d8421aee66fec14a&pageNumber=";

$page=1;

while ($page){

	$json1 = file_get_contents($url.$page.$errors);
	$json = json_decode($json1);

	$totct = $json->result->itemCount;

	if (!$json) {
		echo "<b>Error</b><br>";
		$errors .= "&j";
		continue;
	} else {
		$errors ="";
	}

/*
	if ($url=="http://www.cc.com/feeds/ent_m112_cc/V1_0_5/980d89f3-ccac-4cd7-b463-9208cad3555e/2796e828-ecfd-11e0-aca6-0026b9414f30/?pageNumber=137&fullEpisodes=0&hash=1451593943")
	{
	echo "<hr>page 137!!<br>";	
	echo $json1;
	}
*/
	
//	echo "$url$page<br>";
	

	foreach ($json->result->items as $e){
		$dt = $e->airDateNY->month . "/" . $e->airDateNY->day . "/" . $e->airDateNY->year; 
		$title = $e->title;
		$myurl = $e->url;
		$people = strpos($title," - ") ? trim(substr($title,strpos($title," - ")+3)) : "";
		if ($people) echo "$dt~$people~$myurl<br>";
	}

/*
	if ($json->result->nextPageURL)
		$url = $json->result->nextPageURL;
	else
		$url = "";
*/

//	$page = ($page<$totct/15) ? $page+1 : "";
	$page = ($json->result->nextPageURL) ? $page+1 : "";

}



?>
