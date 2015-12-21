<table>
<tr>
	<th>Show</th>
	<th>Date</th>
	<th>Title</th>
	<th>Person</th>
	<th>Description</th>
	<th>Media Type</th>
	<th>Media Value</th>
</tr>


<?php





$show = "Charlie Rose";



$url = "http://www.charlierose.com/archive";
$json = file_get_contents($url);
$eps = json_decode($json);


foreach ($eps as $e){

//	echo $e->_id . "<br>";

	$mydate1 = explode("T",$e->pubDate);
	$mydate = $mydate1[0];
	$mydesc= $e->description;
	$mytitle = $e->title;
	$myvidid = "http://www.charlierose.com/watch/" . $e->content_id;
	$myvidtype = "url";

	echo "<tr>";
	echo "<td>$show</td>";
	echo "<td>$mydate </td>";
	echo "<td>$mytitle</td>";
	echo "<td>" . "</td>";
	echo "<td>$mydesc</td>";
	echo "<td>$myvidtype</td>";
	echo "<td>$myvidid</td>";
	echo "</tr>";

}

/*

	$ct++;
	$trackID = $track->id;
	$trackTitle = $track->title;
	$uri = $track->uri;
	$desc = $track->description;


for ($page=1;$page<=60;$page++){

	$html_big = file_get_contents($url.$page);


	preg_match_all(
		'~<div class="post-wrap">.*?<div class="h3 h3-b"><a href="(.*?)">(.*?)</a></div>.*?<div class="speaker-name">(.*?)</div><div class="date">(.*?)</div>~s'
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$myurl = $post[1];
		$mytitle = trim($post[2]);

		libxml_use_internal_errors(true);
		$dom = new DomDocument();
		$dom->loadHTML($post[3]);
		$people = $dom->getElementsByTagName('a');

		$speakers = Array();
		foreach ($people as $p){
			$speakers[] = $p->textContent;
		}

		$mypeople = implode("|",$speakers);

		$mydate = $post[4];

		$html = file_get_contents($myurl);

		preg_match_all(
			'~youtube.com/embed/(.*?)"~s'
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
			$myvidid = $myurl;
		}

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
