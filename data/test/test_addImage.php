<?php

require_once("../../_connect.php");

require('../../wp-blog-header.php');
require("../../wp-admin/includes/taxonomy.php");

require_once('../../wp-admin/includes/media.php');
require_once('../../wp-admin/includes/file.php');
require_once('../../wp-admin/includes/image.php');


/*
$url = "http://i.dailymail.co.uk/i/pix/2014/10/05/1412469260802_wps_18_image003_png.jpg";
$post_id = 6;
$desc = "Sam Harris Daily Show";

$image = media_sideload_image($url, $post_id);

set_post_thumbnail( $post, $image );
*/

$media = get_attached_media( 'image', 6 );

print_r($media);

$last = array_pop($media);

set_post_thumbnail( 6, 62 );

echo "<hr>";
print_r($last);
echo "<hr>";

echo "<hr>" . $last->ID . "<hr>";

?>
