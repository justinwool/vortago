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



$url = "http://iai.tv/debates-and-talks?start=10";
$show = "The Veritas Forum";

for ($page=1;$page<=1;$page++){

	$html_big = file_get_contents($url.$page);

	preg_match_all(
		'~<div class="listedtiles_item">.*?<div class="listedtiles_item_title">.*?<a href="(.*?)".*?>(.*?)</a>.*?<strong>Speakers:</strong>(.*?)</div>~s'
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$myurl = $post[1];
		$mytitle = trim($post[2]);
		$speakers2 = explode(",",$post[3]);
		foreach ($speakers2 as $s){
			$speakers[] = trim($s);
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

?>

</table>
