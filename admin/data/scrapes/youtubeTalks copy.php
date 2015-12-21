<?php

$skipInitialScrape = $_GET["skip"];

$file = "youtubetalks_food.txt";
$url = "authors_at_google.html";
$url = "youtubeTalks_food.html";


//$pages = 57;
//$pages = 1;


if (!$skipInitialScrape){

	$html = file_get_contents($url);

	preg_match_all(
		'~<a class="pl-video-title-link.*?href="(.*?)".*?>(.*?)</a>~s'
		,
		$html,
		$results, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($results as $t){

		$ct++;
		$me = Array();
	
		$me["url"] = trim($t[1]);
		$me["title"] = trim($t[2]);

		$title = trim($t[2]);

		if (strpos($title,":"))
			$me["speaker"] = substr($title,0,strpos($title,":"));
		else
			$me["speaker"] = "";

		$recs[] = $me;

	}

	$myfile = fopen($file,"w");
	fwrite($myfile,json_encode($recs));
	fclose($myfile);

}

else {

	echo "<h1>Looking up dates...</h1>";
	
	// ALREADY SCRAPED TO GET RECS IN MY FILE
	$recs = json_decode(file_get_contents($file),true);

	foreach ($recs as $id=>$t){

		if ($t["dt"]) continue;

		$url = "http://youtube.com" . $t["url"];
	
		$html = file_get_contents($url);

		preg_match_all(
			'~<meta itemprop="datePublished" content="(.*?)"~s'
			,
			$html,
			$results, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		$recs[$id]["dt"] = $results[0][1];

		$myfile = fopen($file,"w");
		fwrite($myfile,json_encode($recs));
		fclose($myfile);
	
		echo "Added date to:  " . $recs[$id]["dt"] . " - " . $t["speaker"] . "<br>";

	}
}

foreach ($recs as $t){

	echo $t["url"] . "~";
	echo $t["dt"] . "~";
	echo $t["title"] . "~";
	echo $t["speaker"] . "~";
	echo "<br>";	

}


?>