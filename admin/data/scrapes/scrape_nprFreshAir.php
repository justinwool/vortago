<table><tr><td>Show Code</td><td>Date</td><td>Person</td><td>Media Type</td><td>Media Code/URL</td><td>Title</td><td>Description</td></tr>

<?php

//echo date("jS F, Y",strtotime("06 Feb 12"));
//echo "<hr>";

$reps[]="Pres.";

$reps[]="Dr. "; $reps2[]="";
$reps[]="Dr "; $reps2[]="";
$reps[]="Prof. "; $reps2[]="";
$reps[]="Prof "; $reps2[]="";
$reps[]=",MD"; $reps2[]="";
$reps[]=", MD"; $reps2[]="";
$reps[]=",MD."; $reps2[]="";
$reps[]=", MD."; $reps2[]="";
$reps[]=",M.D."; $reps2[]="";
$reps[]=", M.D."; $reps2[]="";
$reps[]=", P.H.D."; $reps2[]="";
$reps[]=", PHD."; $reps2[]="";
$reps[]=", PHD"; $reps2[]="";
$reps[]="Former "; $reps2[]="";
$reps[]="President "; $reps2[]="";
$reps[]="Pres. "; $reps2[]="";
$reps[]="Pres "; $reps2[]="";
$reps[]="Senator "; $reps2[]="";
$reps[]="Sen. "; $reps2[]="";
$reps[]="Rep "; $reps2[]="";
$reps[]="Rep. "; $reps2[]="";
$reps[]="Representative "; $reps2[]="";
$reps[]="Governor "; $reps2[]="";
$reps[]="Gov. "; $reps2[]="";
$reps[]="Hon. "; $reps2[]="";
$reps[]="Her Majesty "; $reps2[]="";
$reps[]="His Majesty "; $reps2[]="";
$reps[]="Professor "; $reps2[]="";
$reps[]=", Esq."; $reps2[]="";
$reps[]=", Esq"; $reps2[]="";
$reps[]="General "; $reps2[]="";
$reps[]="Colonel "; $reps2[]="";
$reps[]="Admiral "; $reps2[]="";
$reps[]="Gen. "; $reps2[]="";
$reps[]="Adm. "; $reps2[]="";
$reps[]="Col. "; $reps2[]="";
$reps[]="Sgt. "; $reps2[]="";
$reps[]="Sergeant "; $reps2[]="";
$reps[]="Lt Gen "; $reps2[]="";
$reps[]="Former President "; $reps2[]="";
$reps[]="Former Governor "; $reps2[]="";
$reps[]="Retired General "; $reps2[]="";


$dels[]=",";
$dels[]=" and ";
$dels[]=" And ";
$dels[]="&amp;";
$dels[]="&";

$url="http://www.npr.org/programs/fresh-air/archive";

$html_big = file_get_contents($url);

while (1){

	if ($epid) $html_big = file_get_contents($url . "?date=$dt&eid=$epid");

	preg_match_all(
		'~<article class="program-archive-episode.*?data-episode-id="(.*?)" data-episode-date="(.*?)">(.*?)<a class="full-show reprise".*?/a>\s*</article>~s'
		,
		$html_big,
		$episodes, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	if (!count($episodes)) break;

	foreach ($episodes as $episode){

		$epid = $episode[1];
		$dt = $episode[2];
		$fullep = $episode[3];

/*
		echo "Epid = $epid <br>";
		echo "Dt = $dt<br>";
*/

		preg_match_all(
			'~<article class="program-archive-segment">.*?<h1 class="title">(.*?)</h1>\s*<p class="teaser">(.*?)</p>.*?<li class="download"><a href="(.*?)?dl=1"~s'
			,
			$fullep,
			$segs, // will contain the blog posts
			PREG_SET_ORDER // formats data into an array of posts
		);

		foreach ($segs as $vals){

			echo "<tr>";
			echo "<td>" . $showcode . "</td>";
			echo "<td>" .  $dt . "</td>";
			echo "<td>" .  "" . "</td>";
			echo "<td>" .  5 . "</td>";
			echo "<td>" .  $vals[3] . "</td>";
			echo "<td>" .  $vals[1] . "</td>";
			echo "<td>" .  $vals[2] . "</td>";
			echo "</tr>";

		}

		continue;

	}

}
?>