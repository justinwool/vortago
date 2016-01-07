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

$conn->query("SET character_set_results=utf8");

//$showId = 3;

$q = <<<MOUT
SELECT *
FROM shows
WHERE img_url IS NOT NULL
AND (show_post IS NULL OR show_post=0)

MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {

	echo "<hr>";

	$details = $row;

	$out = Array();

	// Create post object
	$my_post = array(
		'post_type'    => "program",
		'post_title'    => utf8_encode($details["show_nm"]),
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
		$q = "UPDATE shows SET show_post = $postid WHERE show_pk = " . $details["show_pk"];
		$conn->query($q);

		$out["jw1"] = "Loading image...";

		if ($details["img_url"]<>""){

			$out["jw1"] .= "Found image url...";


/*
			require_once('../wp-admin/includes/media.php');
			require_once('../wp-admin/includes/file.php');
			require_once('../wp-admin/includes/image.php');
*/

			$image = media_sideload_image($details["img_url"], $postid);
			if ($image){

				$out["jw1"] .= "Attaching image...";

				$media = get_attached_media( 'image', $postid );
				$last = array_pop($media);
				if (set_post_thumbnail( $postid, $last->ID )){
					$out["jw1"] .= "Setting thumb...";
					$q = sprintf("UPDATE shows SET img_post=%d WHERE show_pk=%d",$last->ID,$details["show_pk"]);
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

}


?>