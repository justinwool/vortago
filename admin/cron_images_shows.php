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
FROM shows
WHERE show_post IS NOT NULL AND img_post IS NULL AND img_url IS NOT NULL
MOUT;

/*
wp_defer_term_counting( true );
wp_defer_comment_counting( true );
$wpdb->query( 'SET autocommit = 0;' );
*/

echo $q . "<br>";

$ct=0;
$result = $conn->query($q);
echo $result->num_rows . " images left to assign.<hr>";
while($row = $result->fetch_assoc()) {

	$ct++;
//	if($ct>=3) break;

	echo "<hr>";

	$details = $row;

	$postid = $row["show_post"];
	
	$out = Array();
	
	echo $row["show_pk"] . "....<br>";

	$imgurl = $details["img_url"];
	$image = media_sideload_image($imgurl, $postid);
	if ($image){
		$media = get_attached_media( 'image', $postid );
		$last = array_pop($media);
		if (set_post_thumbnail( $postid, $last->ID )){
			$q = sprintf("UPDATE shows SET img_post=%d WHERE show_pk=%d",$last->ID,$details["show_pk"]);
			$conn->query($q);
			echo "success";
		}
	}	

}

?>