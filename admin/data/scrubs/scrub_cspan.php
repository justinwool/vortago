<table>
<tr>
	<th>PK</th>
	<th>Title</th>
	<th>People</th>
</tr>


<?php

require_once("../_connect.php");

$sql = "SELECT * FROM dataload_working WHERE shownm = 'CSPAN' AND statusfk = 0 ORDER BY RAND() LIMIT 1";

$recs=1;
$ct = 0;
while ($recs){

	$ct++;

	$recs = 0;
	$conn->query($sql) or die("oops $sql");

	$result = $conn->query($sql);

	while($row = $result->fetch_assoc()) {

		$recs=1;

		$pk = $row["pk"];
		$title = $row["title"];
		$url = $row["url"];

		$html_big = file_get_contents($url);

		echo $url;

		preg_match_all(
			'~www.c-span.org/person.*?>(.*?)</a>~s'
			,
			$html_big,
			$posts, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);


		$people2 = Array();
		foreach ($posts as $post){
			$people2[] = trim($post[1]);
		}

		$people = implode("|",$people2);

		$sql2 = sprintf("UPDATE dataload_working SET people='%s', statusfk=%d WHERE pk=%d",
			addslashes($people),
			1,
			$pk
		);

		echo "$sql2 <br>";

		echo "<tr>";
		echo "<td>$pk</td>";
		echo "<td>$title</td>";
		echo "<td>$people</td>";
		echo "</tr>";

		$conn->query($sql2);

	}

}


?>

</table>
