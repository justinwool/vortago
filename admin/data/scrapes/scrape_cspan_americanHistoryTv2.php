<?php

echo date('l jS \of F Y h:i:s A') . "<hr>";


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



$url = "http://www.charlierose.com/archive";
$json = json_decode(file_get_contents("file_cspan_amhist.txt"),true);
$apps = $json["apps"];

$ctq=0;
$ctd=0;
foreach ($apps as $k=>$a){
	if ($a["p"]) $ctd++;
	else $ctq++;
}

echo "Total Appearances:  " . count($apps) . "<br>";
echo "Already Done:  " . $ctd . "<br>";
echo "Remaining:  " . $ctq . "<br>";


foreach ($apps as $k=>$a){

	echo $a["url"] . "<br>";
	
	if ($a["p"]) {
		echo "Already done.<br>";
		continue;
	}
	
	
	$html = file_get_contents($a["url"]);
	$document = new DOMDocument();
	$document->loadHTML($html);
	$xpath = new DOMXpath($document);

	$myDate = $xpath->evaluate($expDate)->item(0)->nodeValue;
	$myTitle = $xpath->evaluate($expTitle)->item(0)->nodeValue;
	$myDesc = $xpath->evaluate($expDesc)->item(0)->nodeValue;	
	if (substr($myDesc,-8)==". close ") $myDesc=substr($myDesc,0,-7);
	
	$peopleDiv = $xpath->evaluate($expPeopleDiv)->item(0);
	
	$people = $xpath->evaluate($expPeople,$peopleDiv);
	
	$myPeople2 = Array();
	foreach ($people as $p){
		$myPeople2[] = $p->getElementsByTagName('a')->item(0)->nodeValue;	
	}
	
	$myPeople = implode("|",$myPeople2);

	/*
	echo "<tr>";
	echo "<td>$showid</td>";
	echo "<td>$myDate</td>";
	echo "<td>$myPeople</td>";
	echo "<td>4</td>";
	echo "<td></td>";
	echo "<td>$l</td>";
	echo "<td>$myTitle</td>";
	echo "<td>$myDesc</td>";
	echo "</tr>";
	*/
	
	echo "New and done.<br>";

	$apps[$k]["tit"] = $myTitle;
	$apps[$k]["dt"] = $myDate;
	$apps[$k]["p"] = $myPeople;

	$file = fopen("file_cspan_amhist.txt","w");
	$output["apps"] = $apps;
	fwrite($file,json_encode($output));
	fclose($file);


/*	
	echo "$l<br>";
	echo "$myTitle <br>";	
	echo "$myDate <br>";	
	echo "$myDesc <br>";	
	echo "$myPeople <br>";	
*/


}


?>

</table>
