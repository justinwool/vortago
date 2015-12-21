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



$url = "http://videolectures.net/site/ajax/drilldown/?l=en&cid=1&w=5&p=";
$show = "Video Lectures";

for ($page=1;$page<=422;$page++){

	$html_big = file_get_contents($url.$page);


//	echo $html_big;

// <div class='lec_thumb'><a href='/rldm2015_stachenfeld_cognitive_map/'
// "~<span class='thumb_short' title='(.*?)'.*?<div class=\"author\"><span class='thumb_short'>(.*?)</span>~s"

	preg_match_all(
		"~<div class='lec_thumb'><a href='(.*?)' ~s"
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$myurl = "http://videolectures.net/" . $post[1];

		$html = file_get_contents($myurl);

		preg_match_all(
			'~<meta property="og:title" content="(.*?)".*?<span>author: </span>.*?<a.*?>(.*?)<.*?<span>recorded:</span>(.*?),~s'
			,
			$html,
			$posts2, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		foreach ($posts2 as $p2){

			$mytitle = trim($p2[1]);
			$mypeople = trim($p2[2]);
			$mydate = $p2[3];
			$myvidid = $myurl;
			$myvidtype = "url";

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

}

?>

</table>
