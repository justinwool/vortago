<?php
header('Content-type: text/plain; charset=utf-8');
require_once("_connect.php");
require("../wp-blog-header.php");
require("../wp-admin/includes/taxonomy.php");
require_once('../wp-admin/includes/media.php');
require_once('../wp-admin/includes/file.php');
require_once('../wp-admin/includes/image.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy") ;

$showId = $_POST["myId"];

$conn->query("SET character_set_results=utf8");

//$showId = 3;

$q = <<<MOUT
SELECT *, DATE_FORMAT(appear_dt,"%W, %M %D, %Y") dt2
FROM people, shows, appearances
LEFT JOIN media ON appear_pk = appear_fk
WHERE show_fk = show_pk
AND person_fk = person_pk
AND (appear_post IS NULL OR appear_post=0)
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {

	echo "<hr>";

	$details = $row;

	$out = Array();

	if ($details["appear_post"]){
		$out["msg"] = "This appearance already has a Wordpress post associated with it.";
		$out["q"] = $q;
		$out["err"] = 1;
		echo json_encode($out);
		continue;
	}

	// Create post object
	$my_post = array(
		'post_type'    => "appearance",
		'post_title'    => utf8_encode($details["person_nm"] . " on " . $details["show_nm"] . " on " . $details["dt2"]),
		'post_content'  => "",
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_date' => date("Y-m-d")
	);

	echo "<br>";
	print_r($my_post);
	echo "<br>";

	try{
		$postid = wp_insert_post( $my_post );
	}
    catch(Exception $e)
    {
		$out["msg"] = "There may have been an error creating the Wordpress post.";
		$out["q"] = $q;
		$out["err"] = 1;
		echo json_encode($out);
		continue;
    }

	if ($postid<>""){
		$q = "UPDATE appearances SET appear_post = $postid WHERE appear_pk = " . $details["appear_pk"];
		$conn->query($q);
	}
	else {
		echo "$q<br>";

		$out["msg"] = "There may have been an error creating the Wordpress post.";
		$out["q"] = $q;
		$out["err"] = 1;
		echo json_encode($out);
		continue;
	}

/*
	if ($row["media_type"]==2){
			$imgid = $details["media_code"];
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			$image = media_sideload_image($hash[0]['thumbnail_large'], $postid);

			if ($image){
				$media = get_attached_media( 'image', $postid );
				$last = array_pop($media);
				if (set_post_thumbnail( $postid, $last->ID )){
					$q = sprintf("UPDATE appearances SET appear_img_post=%d WHERE appear_pk=%d",$last->ID,$details["appear_pk"]);
					$conn->query($q);
				}
			}
	}
	if ($row["media_type"]==1){
			$imgid = $details["media_code"];
			$imgurl = "http://img.youtube.com/vi/$imgid/0.jpg";
			$image = media_sideload_image($imgurl, $postid);
			if ($image){
				$media = get_attached_media( 'image', $postid );
				$last = array_pop($media);
				if (set_post_thumbnail( $postid, $last->ID )){
					$q = sprintf("UPDATE appearances SET appear_img_post=%d WHERE appear_pk=%d",$last->ID,$details["appear_pk"]);
					$conn->query($q);
				}
			}
	}
	else if ($row["img_post"]<>""){
		if (set_post_thumbnail( $postid, $row["img_post"] )){
			$q = sprintf("UPDATE appearances SET appear_img_post=%d WHERE appear_pk=%d",$last->ID,$details["appear_pk"]);
			$conn->query($q);
		}
	}
*/

	$out["err"] = 0;
	echo json_encode($out);

}


?>