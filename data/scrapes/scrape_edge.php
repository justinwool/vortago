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



$url = "http://edge.org/videos?page=";
$show = "Edge";

for ($page=0;$page<=23;$page++){

	$html_big = file_get_contents($url.$page);




	preg_match_all(
		'~<h2 class="views-field views-field-title margin-top-zero">.*?<span class="field-content">.*?<a.*?>(.*?)</a>.*?<span class="member-name"><a.*?>(.*?)</a>.*?<span class="views-field views-field-field-date">.*?\[(.*?)\].*?vimeo.com/video/(.*?)"~s'
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$mytitle = trim($post[1]);
		$mypeople = trim($post[2]);
		$mydate = $post[3];
		$myvidid = $post[4];
		$myvidtype = "vimeo";

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
