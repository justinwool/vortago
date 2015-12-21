<?php

require_once("../../_connect.php");

require('../../wp-blog-header.php');
require("../../wp-admin/includes/taxonomy.php");
require_once('../../wp-admin/includes/media.php');
require_once('../../wp-admin/includes/file.php');
require_once('../../wp-admin/includes/image.php');


/*
$post_id = 6;
$url = "http://i.dailymail.co.uk/i/pix/2014/10/05/1412469260802_wps_18_image003_png.jpg";
$desc = "Sam Harris Daily Show";

$image = media_sideload_image($url, $post_id);

set_post_thumbnail( $post, $image );
*/

$myImgUrl = "http://www.clivewilkinson.com/wp/wp-content/uploads/2015/04/99u.png";
$image = media_sideload_image($myImgUrl, 5);
echo $image;
echo "<hr>";
$media = get_attached_media( 'image', 5 );
$last = array_pop($media);
echo $last->ID;


?>
