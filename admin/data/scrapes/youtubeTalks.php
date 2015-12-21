<?php

$skipInitialScrape = $_GET["skip"];

$file = "youtubetalks_all.txt";

$files[] = "youtubeTalks_academics.html";
$files[] = "youtubeTalks_artists.html";
$files[] = "youtubeTalks_broadway.html";
$files[] = "youtubeTalks_films.html";
$files[] = "youtubeTalks_food.html";
$files[] = "youtubeTalks_green.html";
$files[] = "youtubeTalks_investors.html";
$files[] = "youtubeTalks_leading.html";
$files[] = "youtubeTalks_media.html";
$files[] = "youtubeTalks_musicians.html";
$files[] = "youtubeTalks_nasa.html";
$files[] = "youtubeTalks_photographers.html";
$files[] = "youtubeTalks_politics.html";
$files[] = "youtubeTalks_pride.html";
$files[] = "youtubeTalks_television.html";

$shows[] = "Academics at Google";
$shows[] = "Artists at Google";
$shows[] = "Broadway at Google";
$shows[] = "Films at Google";
$shows[] = "Food at Google";
$shows[] = "Green at Google";
$shows[] = "Investors at Google";
$shows[] = "Leading at Google";
$shows[] = "Media at Google";
$shows[] = "Musicians at Google";
$shows[] = "Nasa at Google";
$shows[] = "Photographers at Google";
$shows[] = "Politics at Google";
$shows[] = "Pride at Google";
$shows[] = "Television at Google";


if (!$skipInitialScrape){

	foreach ($files as $id=>$url){

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
			$me["show"] = $shows[$id];

			$title = trim($t[2]);

			if (strpos($title,":"))
				$me["speaker"] = substr($title,0,strpos($title,":"));
			else
				$me["speaker"] = "";

			$recs[] = $me;

		}

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

echo "<hr>";

foreach ($recs as $t){

	echo $t["show"] . "~";
	echo $t["url"] . "~";
	echo $t["dt"] . "~";
	echo $t["title"] . "~";
	echo $t["speaker"] . "~";
	echo "<br>";	

}


?>