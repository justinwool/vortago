<?php

require_once("../_connect.php");

$file = "in/harris.txt";

$lines = file($file);

function addPerson($i){
	$q = sprintf("SELECT * FROM people WHERE peoplenm = '%s'",$i);
 	$result = $GLOBALS[conn]->query($q);
	$myid="";
	while($row = $result->fetch_assoc()) {
		return $row["peoplepk"];
	}
	if (!$myid){
		$q = sprintf("INSERT INTO people (peoplenm) VALUES ('%s')",$i);
		$result = $GLOBALS[conn]->query($q);
		return $GLOBALS[conn]->insert_id;
	}
}

function addShow($i){
	$q = sprintf("SELECT * FROM shows WHERE shownm = '%s'",$i);
	$result = $GLOBALS[conn]->query($q);
	$myid="";
	while($row = $result->fetch_assoc()) {
		return $row["showpk"];
	}
	if (!$myid){
		$q = sprintf("INSERT INTO shows (shownm) VALUES ('%s')",$i);
		$result = $GLOBALS[conn]->query($q);
		return $GLOBALS[conn]->insert_id;
	}
}

function formatVideo($i){

	if (strpos($i,"youtube")){
		$vid[0] = 2;
		$args = explode("&",substr($i,strpos($i,"?")+1));
		foreach($args as $arg){
			$arg2 = explode("=",$arg);
			if ($arg2[0]=="v"){
				$vid[1] = $arg2[1];
				return $vid;
			}
		}
	}
	else if (strpos($i,"youtu.be")){
		$vid[0] = 2;
		$args = explode("?",substr($i,strrpos($i,"/")+1));
		$vid[1] = $args[0];
		return $vid;
	}
	else if (strpos($i,"vimeo")){
		$vid[0] = 3;
		$vid[1] = substr($i,strrpos($i,"/")+1);
		return $vid;
	}
	else {
		$vid[0] = 0;
		$vid[1] = $i;
		return $vid;
	}
}


function addAppearance($s,$p,$d,$f){

		$q = sprintf("INSERT INTO appearances (showfk,peoplefk,dt) VALUES (%d,%d,STR_TO_DATE('%s', '%s')) ON DUPLICATE KEY UPDATE appearpk=LAST_INSERT_ID(appearpk)",$s,$p,$d,$f);
		$result = $GLOBALS[conn]->query($q);
		$appid = $GLOBALS[conn]->insert_id;

		return $appid;

}


function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

foreach ($lines as $lnum=>$l) {

	echo "<hr>processing $lnum ...<br>";

	$p = explode("|",$l);

	$person = addPerson(addslashes($p[0]));
	echo "person is $person <br>";

	if (!$person) continue;

	$show = addShow(addslashes($p[5]));
	echo "show is $show <br>";

	if (!$show) continue;

	$date = $p[2];

	$dateformat = "%m/%d/%Y";

	$appearance = addAppearance($show,$person,$date,$dateformat);
	echo "appearance is $appearance <br>";

	if (!$appearance) continue;

	$video = formatVideo($p[3]);

	$videotitle = trim(cleanString($p[4]));

	$q = sprintf("INSERT INTO media (appearfk,medtype,medid,medtitle) VALUES (%d,%d,'%s','%s')
		ON DUPLICATE KEY UPDATE medtype=%d, medid='%s', medtitle='%s'
		",
		$appearance,
		$video[0],
		$video[1],
		addslashes($videotitle),
		$video[0],
		$video[1],
		addslashes($videotitle)
		);

	echo $q . "<br>";

	$result = $GLOBALS[conn]->query($q);

}


	$q = "SELECT * FROM media WHERE mediapk = 408";
	$result = $GLOBALS[conn]->query($q);
	while($row = $result->fetch_assoc()) {
		echo "<hr><hr>" . $row["medtitle"] . "<hr>";
	}



?>