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

$url = "http://api.presentation.abc.go.com/api/ws/presentation/v2/module/1072540.jsonp?brand=001&device=001&authlevel=1&size=35&show=SH559060&=&callback=load_more&start=";

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
