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


$show = "Tonight Show with Jimmy Fallon";

$url = "http://www.nbc.com/the-tonight-show/content/a/filter-items/?type=video&segmentType=Interview&offset=";

$offset = 0;

$ct=0;
while (1) {

	$json = file_get_contents($url . $offset);
	$eps = json_decode($json);

	if (!count($eps->content)) break;

	foreach ($eps->content as $e){
		$ct++;
//		print_r($e);
		echo "<hr>";
		echo "Appearance $ct<br>";
		echo $e->schema->releasedEvent->startDate . "<Br>";
		echo $e->schema->url . "<Br>";

		foreach  ($e->schema->actor as $actor){
			echo $actor->name . "<Br>";
		}
	}

	$offset = $ct+1;

}


?>

</table>
