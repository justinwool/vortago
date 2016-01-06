<?php




//echo date("jS F, Y",strtotime("06 Feb 12"));
//echo "<hr>";

$reps[]="Pres.";

$reps[]="Dr."; $reps2[]="";
$reps[]="Dr "; $reps2[]="";
$reps[]="Prof."; $reps2[]="";
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
$reps[]="Former Governor"; $reps2[]="";
$reps[]="Retired General "; $reps2[]="";


$dels[]=",";
$dels[]=" and ";
$dels[]=" And ";
$dels[]="&amp;";
$dels[]="&";


/*
$s = '<a target="_blank" href="http://www.tvmaze.com/episodes/74978/the-tonight-show-with-jay-leno-2001-04-12-troy-aikman-kim-delaney-kirk-franklin-and-mary-mary">Troy Aikman, Kim Delaney, Kirk Franklin And Mary Mary';
$s2 = str_replace($dels,$dels[0],$s);
$s2 = implode("~",explode($dels[0],$s2));
echo $s . "<br>" . $s2 . "<hr>";
*/

$showcode = $_GET["s"];

//$showcode = "TonightShowwithJayLeno_1992";

$url="http://epguides.com/" . $showcode . "/";

$html_big = file_get_contents($url);

preg_match_all(
	'~<pre>(.*?)</pre>~s'
	,
	$html_big,
	$pre2, // will contain the blog posts
	PREG_SET_ORDER // formats data into an array of posts
);

//print_r($pre2);

$pre = $pre2[0][0];

$lines = explode(PHP_EOL, $pre);

foreach ($lines as $l){
	$dt = str_replace("/"," ",substr($l,27,9));
	$pp = substr($l,39);

//	$pp = "Johnson, Roger Ebert & Richard Roeper";

	$pp2 = str_replace($reps,$reps2,$pp);
	$pp2 = str_replace($dels,$dels[0],$pp2);
	$pp2 = implode("~",explode($dels[0],$pp2));

	if (strtotime($dt))
		echo "$dt~$pp~$pp2" . "<br>";
}


?>