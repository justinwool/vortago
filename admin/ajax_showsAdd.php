<?php

require_once("_connect.php");

$myId = $_POST["myId"];
$myNotes = $_POST["myNotes"];
$myName = $_POST["myName"];
$myName2 = $_POST["myName2"];
$myName3 = $_POST["myName3"];
$myName4 = $_POST["myName4"];
$myWiki = $_POST["myWiki"];
$myStatus = $_POST["myStatus"];
$myLat = $_POST["myLat"];
$myLong = $_POST["myLong"];
$myYear1 = $_POST["myYear1"];
$myYear2 = $_POST["myYear2"];
$myDate1 = $_POST["myDate1"];
$myDate2 = $_POST["myDate2"];
$myAddress = $_POST["myAddress"];
$myLocation = $_POST["myLocation"];
$myImgUrl = $_POST["myImgUrl"];
$myTaxPreset = $_POST["myTaxPreset"];
$mySort = $_POST["mySort"];

$out["y1"] = $myYear1;
$out["y2"] = $myYear2;

$myDate1p = explode("-",$myDate1);
$myDate2p = explode("-",$myDate2);

$myDate1 = (checkdate($myDate1p[1],$myDate1p[2],$myDate1p[0])) ? "'$myDate1'" : "null";
$myDate2 = (checkdate($myDate2p[1],$myDate2p[2],$myDate2p[0])) ? "'$myDate2'" : "null";


$out["is_year1_int"] = is_int($myYear1);

$myYear1 = (is_numeric($myYear1) && $myYear1 >= 1940 && $myYear1 <= 2050) ? $myYear1 : "";
$myYear2 = (is_numeric($myYear2) && $myYear2 >= 1940 && $myYear2 <= 2050) ? $myYear2 : "";

$out["y1b"] = $myYear1;
$out["y2b"] = $myYear2;

if ($myId){

	$q = sprintf("SELECT * FROM shows WHERE show_pk=%d",$myId);
	$result = $conn->query($q);
	while($row = $result->fetch_assoc()) {
		$showDetails = $row;
		if ($showDetails["img_post"]=="" && $myImgUrl<>""){
			require("../wp-blog-header.php");
			require("../wp-admin/includes/taxonomy.php");
			require_once('../wp-admin/includes/media.php');
			require_once('../wp-admin/includes/file.php');
			require_once('../wp-admin/includes/image.php');
			header("HTTP/1.1 200 OK");
			header("Status: 200 All rosy") ;

			$image = media_sideload_image($myImgUrl, $showDetails["show_post"]);
			$out["show_post"] = $showDetails["show_post"];
			$out["myImgUrl"] = $myImgUrl;
			$out["img_post"] = $img_post;

			if ($image){
				$out["image"] = "yes";
				$media = get_attached_media( 'image', $showDetails["show_post"] );
				$last = array_pop($media);
				if (set_post_thumbnail( $showDetails["show_post"], $last->ID )){
					$q = sprintf("UPDATE shows SET img_post=%d WHERE show_pk=%d",$last->ID,$myId);
					$conn->query($q);
				}
			}

/*
		$myImgUrl = "http://www.clivewilkinson.com/wp/wp-content/uploads/2015/04/99u.png";
		$image = media_sideload_image($myImgUrl, 5);
		$media = get_attached_media( 'image', 5 );
		$last = array_pop($media);
*/
		}
	}

	$q = sprintf("UPDATE shows SET
			show_nm='%s',
			show_nm2='%s',
			show_nm3='%s',
			show_nm4='%s',
			show_wiki='%s',
			show_status=%d,
			show_lat='%s',
			show_long='%s',
			year_start='%d',
			year_end='%d',
			dt_start=%s,
			dt_end=%s,
			location='%s',
			address='%s',
			img_url='%s',
			sort_by='%s',
			tax_fk=%d
			WHERE show_pk=%d",
		addslashes($myName),
		addslashes($myName2),
		addslashes($myName3),
		addslashes($myName4),
		$myWiki,
		$myStatus,
		$myLat,
		$myLong,
		$myYear1,
		$myYear2,
		$myDate1,
		$myDate2,
		$myLocation,
		$myAddress,
		$myImgUrl,
		$mySort,
		$myTaxPreset,
		$myId
		);
}
else{
	$q = sprintf ("INSERT INTO shows (
			show_nm,
			show_nm2,
			show_nm3,
			show_nm4,
			show_wiki,
			show_status,
			show_lat,
			show_long,
			year_start,
			year_end,
			dt_start,
			dt_end,
			location,
			address,
			img_url,
			sort_by,
			tax_fk
			) VALUES ('%s','%s','%s','%s','%s','%d','%s','%s','%d','%d',%s,%s,'%s','%s','%s','%s',%d)",
		addslashes($myName),
		addslashes($myName2),
		addslashes($myName3),
		addslashes($myName4),
		$myWiki,
		$myStatus,
		$myLat,
		$myLong,
		$myYear1,
		$myYear2,
		$myDate1,
		$myDate2,
		$myLocation,
		$myAddress,
		$myImgUrl,
		addslashes($mySort),
		$myTaxPreset
		);
}

$out["q1"] = $q;

$result = $conn->query($q);

if (!$myId) $myId = $conn->insert_id;

if ($myId){
	if ($myNotes){
		$q = sprintf ("INSERT INTO show_notes VALUES (%d,'%s') ON DUPLICATE KEY UPDATE show_notes = '%s'",
			$myId,
			addslashes($myNotes),
			addslashes($myNotes)
		);
	}
	else {
		$q = sprintf ("DELETE FROM show_notes WHERE show_fk = %d",
			$myId
		);
	}
	$conn->query($q);
}
else {
	$out["msg"] = "There may have been an error.  Please check the Shows page.";
	$out["q"] = $q;
	$out["err"] = 1;
	echo json_encode($out);
	exit();
}

$out["err"] = 0;
echo json_encode($out);

?>


