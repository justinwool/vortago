<?php

require_once("../../_connect.php");

require('../../wp-blog-header.php');
require("../../wp-admin/includes/taxonomy.php");

$q= <<<MOUT
SELECT *, DATE_FORMAT(dt,"%W %M %D, %Y") dt2
FROM appearances a, media, shows, people
LEFT JOIN
(
	SELECT peoplefk, GROUP_CONCAT(term_id SEPARATOR ',') mycats
	FROM peoplecat, cats, wp_terms
	WHERE catfk = catpk
	AND catnm = name
	GROUP BY peoplefk
) cats
ON cats.peoplefk = person_pk
WHERE appear_pk = appearfk
AND a.person_fk = person_pk
AND show_fk = show_pk
AND appear_post IS NULL
AND person_pk = 124699
LIMIT 5
MOUT;

echo $q . "<hr>";

$appearances = array();

$peopleAdded = array();
$peopleAdded[] = "";

$showsAdded = array();
$showsAdded[] = "";

// create or lookup the People category
$peoplecat = wp_create_category("People");
$showscat = wp_create_category("Shows");

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {

	$appid = $row["appear_pk"];
	$appearances[$appid][] = $row;

	if (!$row["show_post"] && !in_array($row["show_pk"],$showsAdded)){

		// Create post object
		$my_post = array(
			'post_type'    => "program",
			'post_title'    => $row["show_nm"],
			'post_content'  => "",
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_date' => date("Y-m-d")
		);

		// add PERSON to categories if not a category yet
		$showcat = wp_create_category($row["show_nm"], $showscat);
		$postid = wp_insert_post( $my_post );

		if ($postid<>""){
			$q = "UPDATE shows SET show_post = $postid, show_cat = $showcat WHERE show_pk = " . $row["show_pk"];
			$conn->query($q);
		}

		$showsAdded[] = $row["show_pk"];
	}

	if (!$row["person_post"] && !in_array($row["person_pk"],$peopleAdded)){

		// Create post object
		$my_post = array(
			'post_type'    => "person",
			'post_title'    => $row["person_nm"] . " Appearances",
			'post_content'  => "",
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_date' => date("Y-m-d")
		);

		// add PERSON to categories if not a category yet
		$personcat = wp_create_category($row["person_nm"], $peoplecat);

		$postid = wp_insert_post( $my_post );

		if ($postid<>"" && $personcat<>""){
			$q = "UPDATE people SET person_post = $postid, person_cat = $personcat WHERE person_pk = " . $row["person_pk"];
			$conn->query($q);
		}

		$peopleAdded[] = $row["person_pk"];

	}

}

foreach ($appearances as $a){

	$postfk = $a[0]["appear_post"];
	$appear_pk = $a[0]["appear_pk"];
	$peoplepk = $a[0]["person_pk"];
	$peoplenm = $a[0]["person_nm"];
	$shownm = $a[0]["show_nm"];
	$dt = $a[0]["dt"];
	$dt2 = $a[0]["dt2"];
	$mycats = explode(",",$a[0]["mycats"]);

	echo "$appear_pk <br>";

	$tags = "";
	if ($a[0]["show_nm2"])	$tags .= "," . $a[0]["show_nm2"];
	if ($a[0]["show_nm3"])	$tags .= "," . $a[0]["show_nm3"];

/*
	// add show to categories if not a category yet
	$showcat = wp_create_category($shownm, 161);
	if ($showcat) $mycats[] = $showcat;
*/

	// add PERSON to categories if not a category yet
	$personcat = wp_create_category($peoplenm, $peoplecat);
	if ($personcat) $mycats[] = $personcat;

	$title = $peoplenm . " on " . $shownm . " on " . $dt2;

//		'ID'            => $postfk,

	// Create post object
	$my_post = array(
		'post_type'    => "appearance",
		'post_title'    => $title,
		'post_content'  => "",
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_category' => $mycats,
		'tags_input' => $shownm . "," . $peoplenm . $tags,
		'post_date' => $dt
	);

	print_r($my_post);

	$postid = wp_insert_post( $my_post );

	update_post_meta($postid, '_wp_page_template', 'single-appear.php');

	$q = "UPDATE appearances SET appear_post = $postid WHERE appear_pk = $appear_pk";
	$conn->query($q);

	echo $q;

	echo "<hr>";

//	break;
}

?>
