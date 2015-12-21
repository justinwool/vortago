<table>
<tr>
	<th>Show</th>
	<th>Date</th>
	<th>Title</th>
	<th>Person</th>
	<th>Media Type</th>
	<th>Media Value</th>
</tr>


<?php



$url = "http://intelligencesquaredus.org/debates/past-debates";
$show = "Intelligence Squared";

while (1==1){

	$html_big = file_get_contents($url);

	$next_link = "";
	preg_match_all(
		'~<div class="PressPagination">(.*?)</div>~s'
		,
		$html_big,
		$s_next, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	libxml_use_internal_errors(true);
	$dom = new DomDocument();
	$dom->loadHTML($s_next[0][1]);
	$urls = $dom->getElementsByTagName('a');

	foreach ($urls as $u){
		if ($u->getAttribute('title') == "> Next"){
			$next_link = $u->getAttribute('href');
			break;
		}
	}

	preg_match_all(
		'~<a class="readmore" href="(.*?)">View Result</a>~s'
		,
		$html_big,
		$s_links, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($s_links as $d){

		$html = file_get_contents("http://intelligencesquaredus.org" . $d[1]);

		preg_match_all(
			'~<p class="date">(.*?)</p>~s'
			,
			$html,
			$s_date, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		$mydate = trim($s_date[0][1]);

		preg_match_all(
			'~<h2 class="catItemTitle">(.*?)</h2>~s'
			,
			$html,
			$s_title, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		$mytitle = trim($s_title[0][1]);

		preg_match_all(
			'~http://www.youtube.com/embed/(.*?)\?~s'
			,
			$html,
			$s_youtube, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		$myvidid = trim($s_youtube[0][1]);

		if ($myvidid<>""){
			$myvidtype = "youtube";
		}
		else{
			$myvidtype = "url";
			$myvidid = "http://intelligencesquaredus.org" . $d[1];
		}

		preg_match_all(
			'~<ul class="foragainst">(.*?)</ul>~s'
			,
			$html,
			$s_people, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		preg_match_all(
			'~<ul class="foragainst">(.*?)</ul>~s'
			,
			$html,
			$s_allpeople, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		preg_match_all(
			'~<h5>(.*?)</h5>~s'
			,
			$s_allpeople[0][1],
			$s_people, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		foreach ($s_people as $p){

			echo "<tr>";
			echo "<td>$show</td>";
			echo "<td>$mydate </td>";
			echo "<td>$mytitle</td>";
			echo "<td>" . trim($p[1]) . "</td>";
			echo "<td>$myvidtype</td>";
			echo "<td>$myvidid</td>";
			echo "</tr>";

		}


/*
		echo "$url <br>";
		echo "$mytitle <br>";
		echo "$mydate <br>";
		echo "$myvidtype <br>";
		echo "$myvidid <br>";
		echo implode(", ",$people);
		echo "<hr>";
*/

	}

	if (!$next_link) break;
	$url = "http://intelligencesquaredus.org" . $next_link;

//	echo "Next link:  $next_link";

//	break;
}

?>

</table>
