<table>
<tr>
	<th>Show ID</th>
	<th>Date</th>
	<th>People</th>
	<th>Media Type</th>
	<th>Media Code</th>
	<th>Media URL</th>
	<th>Title</th>
	<th>Desc</th>
</tr>


<?php

echo date('l jS \of F Y h:i:s A');


$url = "http://www.c-span.org/search/?sdate=&edate=&searchtype=Videos&sort=Most+Recent+Airing&text=0&seriesid%5B%5D=55&show100=&ajax&page=";
$show = "Lectures in History";

$showid = 123;

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
		
		$mylink = $l->getAttribute("href");
		
		echo $mylink . "<br>";

		$links[] = $mylink;

	}

	$p = "";
	$nextLink = $xpath->evaluate($expNext)->item(0);
	if ($nextLink) $p = $nextLink->getAttribute("data-page");

}


foreach ($links as $l){

	$html = file_get_contents($l);
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

/*	
	echo "$l<br>";
	echo "$myTitle <br>";	
	echo "$myDate <br>";	
	echo "$myDesc <br>";	
	echo "$myPeople <br>";	
*/


}

echo date('l jS \of F Y h:i:s A');



/*

for($p=1;$p<=77;$p++){

//	echo "<hr> Page $p <hr>";






for ($page=1;$page<=4;$page++){

	$html_big = file_get_contents($url.$page);

	preg_match_all(
		"~<li class='onevid'>.*?<div class='text'>.*?<time datetime='(.*?)'>.*?<a href='(.*?)'.*?<h3>(.*?)</h3>~s"
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$mydate = $post[1];
		$myurl = $post[2];
		$mytitle = $post[3];

		$html = file_get_contents($myurl);

		preg_match_all(
			"~<a href='http://www.c-span.org/person.*?'>(.*?)</a>~s"
			,
			$html,
			$posts2, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		$mypeople2 = Array();
		foreach ($posts2 as $p2){
			$mypeople2[] = trim($p2[1]);
		}

		$mypeople = implode("|",$mypeople2);

		$myvidtype = "url";
		$myvidid = $myurl;

		echo "<tr>";
		echo "<td>$show</td>";
		echo "<td>$mydate </td>";
		echo "<td>$mytitle</td>";
		echo "<td>" . $mypeople . "</td>";
		echo "<td>$myvidtype</td>";
		echo "<td>$myvidid</td>";
		echo "</tr>";

	}

}
*/

?>

</table>
