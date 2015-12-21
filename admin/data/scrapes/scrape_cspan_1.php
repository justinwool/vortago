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



$url = "http://www.c-span.org/search/?sdate=&edate=&searchtype=Videos&sort=Most+Recent+Airing&text=0&seriesid%5B%5D=55&show100=&sdate=&edate=&searchtype=Videos&sort=Most+Recent+Airing&text=0&seriesid%5B%5D=55&ajax&page=";
$show = "American History TV";

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

?>

</table>
