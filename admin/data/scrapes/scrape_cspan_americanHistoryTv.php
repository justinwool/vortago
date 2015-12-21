<?php

echo date('l jS \of F Y h:i:s A');

$json = json_decode(file_get_contents("file_cspan_amhist.txt"),true);
$apps = $json["apps"];

foreach ($apps as $k=>$a){
	$urls[] = $a["url"];
}


$url = "http://www.c-span.org/search/?sdate=&edate=&searchtype=Videos&sort=Most+Recent+Airing&text=0&seriesid%5B%5D=70&formatid%5B%5D=55&show100=&ajax&page=";
$show = "American History TV";

$showid = 456;

$dom = new DOMDocument();


$expLinks = './/li//a[contains(concat(" ", normalize-space(@class), " "), " thumb ")]';
$expNext = './/li//a[contains(concat(" ", normalize-space(@class), " "), " load-more ")]';

//$expLink2Vid = './/a[contains(concat(" ", normalize-space(@class), " "), " podcast-video-container ")]';
//$expLink2Mp3 = './/button[contains(concat(" ", normalize-space(@class), " "), " play-podcast ")]';
//$expLink2Vid = './/div[contains(concat(" ", normalize-space(@class), " "), " podcast-single ")]';

$expDate = './/span[contains(concat(" ", normalize-space(@class), " "), " time ")]';
$expDate = './/time';
$expTitle = './/div[contains(concat(" ", normalize-space(@class), " "), " overview ")]/h1';
$expDesc = './/div[contains(concat(" ", normalize-space(@class), " "), " more_info ")]/p';

$expPeopleDiv = './/section[contains(concat(" ", normalize-space(@class), " "), " program-info ")]';
$expPeople = './/li';

error_reporting(0);

$p=1;

while ($p){

	echo "<hr> Page $p <br>";
	
	$html = file_get_contents("$url" . $p);
	$document = new DOMDocument();
	$document->loadHTML($html);
	$xpath = new DOMXpath($document);

	foreach ($xpath->evaluate($expLinks) as $l) {

		$app = Array();
		
		$mylink = $l->getAttribute("href");

		echo $mylink . "<br>";

		if (in_array($mylink,$urls)) {
			echo "Already done.<br>";
			continue;
		}

		$app["url"] = $mylink;

		$apps[] = $app;

	}

	$file = fopen("file_cspan_amhist.txt","w");
	$output["apps"] = $apps;
	fwrite($file,json_encode($output));
	fclose($file);

	$p = "";
	$nextLink = $xpath->evaluate($expNext)->item(0);
	if ($nextLink) $p = $nextLink->getAttribute("data-page");


}

$file = fopen("file_cspan_amhist.txt","w");
$output["apps"] = $apps;
fwrite($file,json_encode($output));
fclose($file);

echo date('l jS \of F Y h:i:s A');


?>

</table>
