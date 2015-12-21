<table>
<tr>
	<th>Page</th>
	<th>Date</th>
	<th>Title</th>
	<th>URL</th>
</tr>


<?php



$url = "http://www.c-span.org/search/?sdate=&edate=&searchtype=Videos&sort=Least+Recent+Airing&text=0&show100=&sdate=&edate=&formatid%5B%5D=28&ajax&page=";
$show = "CSPAN";

for ($page=1;$page<=145;$page++){

	$html_big = file_get_contents($url.$page);

//	echo $url.$page . "<br>";

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

		echo "<tr>";
		echo "<td>$page</td>";
		echo "<td>$mydate </td>";
		echo "<td>$mytitle</td>";
		echo "<td>$myurl</td>";
		echo "</tr>";

		continue;

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

	}

}

?>

</table>
