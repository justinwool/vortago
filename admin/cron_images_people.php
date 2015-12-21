<?php

require_once("_connect.php");
require("../wp-blog-header.php");
require("../wp-admin/includes/taxonomy.php");
require_once('../wp-admin/includes/media.php');
require_once('../wp-admin/includes/file.php');
require_once('../wp-admin/includes/image.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy") ;

ini_set('max_execution_time', 60); //300 seconds = 5 minutes

//$showId = 3;

$q = <<<MOUT
SELECT *
FROM people
INNER JOIN media m
	ON media_pk = (
		SELECT media_pk
		FROM appearances, media mm
		WHERE appear_fk = appear_pk
		AND person_pk = person_fk
		AND media_type in (1,2)
		LIMIT 1
	)
WHERE person_post IS NOT NULL AND person_img_post IS NULL
MOUT;

/*
wp_defer_term_counting( true );
wp_defer_comment_counting( true );
$wpdb->query( 'SET autocommit = 0;' );
*/

echo $q . "<br>";

$ct=0;
$result = $conn->query($q);
echo $result->num_rows . " people left to assign.<hr>";
while($row = $result->fetch_assoc()) {

	$ct++;
//	if($ct>=3) break;

	echo "<hr>";

	$details = $row;

	$postid = $row["person_post"];
	
	$out = Array();
	
	
	echo $row["person_nm"] . "....<br>";

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
					echo "success";
				}
			}	
	}
	if ($row["media_type"]==1){
			echo "youtube...";
			$imgid = $details["media_code"];
			$imgurl = "http://img.youtube.com/vi/$imgid/0.jpg";
			$image = media_sideload_image($imgurl, $postid);
			if ($image){
				$media = get_attached_media( 'image', $postid );
				$last = array_pop($media);
				if (set_post_thumbnail( $postid, $last->ID )){
					$q = sprintf("UPDATE people SET person_img_post=%d WHERE person_pk=%d",$last->ID,$details["person_pk"]);
					$conn->query($q);
					echo "success";
				}
			}	
	}


}

?>