<?php

require_once("_connect.php");
require("../wp-blog-header.php");
require("../wp-admin/includes/taxonomy.php");
require_once('../wp-admin/includes/media.php');
require_once('../wp-admin/includes/file.php');
require_once('../wp-admin/includes/image.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy") ;


//$showId = 3;

$q = <<<MOUT
SELECT *
FROM people
LEFT JOIN media m
	ON media_pk = (
		SELECT media_pk
		FROM appearances, media mm
		WHERE appear_fk = appear_pk
		AND person_pk = person_fk
		AND media_type in (1,2)
		LIMIT 1
	)
WHERE person_post IS NULL OR person_post=0
MOUT;

/*
wp_defer_term_counting( true );
wp_defer_comment_counting( true );
$wpdb->query( 'SET autocommit = 0;' );
*/

$ct=0;
$result = $conn->query($q);
while($row = $result->fetch_assoc()) {

	$ct++;
//	if($ct>=20) break;

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
		'post_type'    => "person",
		'post_title'    => utf8_encode($details["person_nm"]),
		'post_content'  => "",
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_date' => date("Y-m-d")
	);

	$postid = wp_insert_post( $my_post );

	if ($postid<>""){

		$q = "UPDATE people SET person_post = $postid WHERE person_pk = " . $details["person_pk"];
		$conn->query($q);

/*
		if ($row["media_type"]==2){
				$imgid = $details["media_code"];
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
				$image = media_sideload_image($hash[0]['thumbnail_large'], $postid);

				if ($image){
					$media = get_attached_media( 'image', $postid );
					$last = array_pop($media);
					if (set_post_thumbnail( $postid, $last->ID )){
						$q = sprintf("UPDATE people SET person_img_post=%d WHERE person_pk=%d",$last->ID,$details["person_pk"]);
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
						$q = sprintf("UPDATE people SET person_img_post=%d WHERE person_pk=%d",$last->ID,$details["person_pk"]);
						$conn->query($q);
					}
				}	
		}
*/


	}
	else {
		echo "<br>";
		echo utf8_encode($details["person_nm"]) . "<br>";
		print_r($my_post);
		echo "<br>";
		$out["msg"] = "There may have been an error creating the Wordpress post.";
		$out["q"] = $q;
		$out["err"] = 1;
		echo json_encode($out);
		continue;
	}

	$out["err"] = 0;
	echo json_encode($out);

}

/*
$wpdb->query( 'COMMIT;' );
$wpdb->query( 'SET autocommit = 1;' );
wp_defer_term_counting( false );
wp_defer_comment_counting( false );
*/

?>