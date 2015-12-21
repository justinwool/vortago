<?php

$file = "ted.txt";

$json = json_decode(file_get_contents($file),true);

$urls = Array();

foreach ($json as $j){
	$urls[] = $j["url"];
}

print_r($urls);



$pages = 57;
//$pages = 1;

$pages=0; $teds=$json;
for ($p=1; $p<=$pages; $p++){

	$url = "http://www.ted.com/talks?sort=oldest&page=$p";
	
	$html = file_get_contents($url);

	preg_match_all(
		"~<h4 class='h12 talk-link__speaker'>(.*?)</h4>.*?<a href='(.*?)'>(.*?)</a>~s"
		,
		$html,
		$results, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($results as $t){

		$ct++;
		$me = Array();
		
		$me["speaker"] = trim($t[1]);
		$me["url"] = trim($t[2]);
		$me["title"] = trim($t[3]);
	
		$teds[] = $me;
	
	}

}


echo "<hr>";
foreach ($teds as $id=>$t){

	echo "working on " . $t["url"] . "<br>";

//	if (in_array($t["url"],$urls)) continue;

	if ($teds["dt"]) continue;

	$url = "http://www.ted.com" . $t["url"];
	
		$html = file_get_contents($url);

	preg_match_all(
		'~,"filmed":(.*?),~s'
		,
		$html,
		$results, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($results as $r){	
		$epoch = $r[1];
		$dt = new DateTime("@$epoch");
		$teds[$id]["dt"] = $dt->format('Y-m-d');	
	}

	$tedfile = fopen($file,"w");
	fwrite($tedfile,json_encode($teds));
	fclose($tedfile);
	
	echo $teds[$id]["dt"] . " - " . $t["speaker"] . "<br>";

}



?>