<?php

require_once("_connect.php");
require("../wp-blog-header.php");
require("../wp-admin/includes/taxonomy.php");
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy") ;


$showId = $_POST["myId"];

//$showId = 3;

$q = <<<MOUT
SELECT *
FROM shows
WHERE show_pk = $showId
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$showDetails = $row;
}

if ($showDetails["show_post"]){
	$out["msg"] = "This show already has a Wordpress post associated with it.";
	$out["q"] = $q;
	$out["err"] = 1;
	echo json_encode($out);
	exit();
}

// Create post object
$my_post = array(
	'post_type'    => "program",
	'post_title'    => $showDetails["show_nm"],
	'post_content'  => "",
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_date' => date("Y-m-d")
);

$postid = wp_insert_post( $my_post );

if ($postid<>""){
	$q = "UPDATE shows SET show_post = $postid WHERE show_pk = " . $showDetails["show_pk"];
	$conn->query($q);

	if ($showDetails["img_post"]=="" && $showDetails["img_url"]<>""){

		require_once('../wp-admin/includes/media.php');
		require_once('../wp-admin/includes/file.php');
		require_once('../wp-admin/includes/image.php');

		$image = media_sideload_image($showDetails["img_url"], $postid);
		if ($image){
			$media = get_attached_media( 'image', $postid );
			$last = array_pop($media);
			if (set_post_thumbnail( $postid, $last->ID )){
				$q = sprintf("UPDATE shows SET img_post=%d WHERE show_pk=%d",$last->ID,$myId);
				$conn->query($q);	
			}
		}
	}

}
else {
	$out["msg"] = "There may have been an error creating the Wordpress post.  Please check the Shows page.";
	$out["q"] = $q;
	$out["err"] = 1;
	echo json_encode($out);
	exit();
}

$out["err"] = 0;
echo json_encode($out);

?>