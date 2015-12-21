<?php

require_once("_connect.php");
require("../wp-blog-header.php");
require("../wp-admin/includes/taxonomy.php");
require_once('../wp-admin/includes/media.php');
require_once('../wp-admin/includes/file.php');
require_once('../wp-admin/includes/image.php');
header("HTTP/1.1 200 OK");
header("Status: 200 All rosy") ;


error_reporting(E_ALL);

$q = <<<MOUT
SELECT *
FROM test_utf1
MOUT;

echo "Query 1: $q<br>";

$conn->query("SET character_set_results=utf8");

$result = $conn->query($q);


echo "Starting Loop<br>";

while($row = $result->fetch_assoc()) {

	echo "<hr>";
	echo $row["nm"] . "<br>";
	echo utf8_encode($row["nm"]) . "<br>";

	$nm = $row["nm"];

}

echo $nm;

$my_post = array(
	'post_type'    => "person",
	'post_title'    => $nm ,
	'post_content'  => "",
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_date' => date("Y-m-d")
);

$postid = wp_insert_post( $my_post );

echo "<br>postid is " . $postid . "<br>";

$my_post = array(
	'post_type'    => "person",
	'post_title'    => "aaaatest" ,
	'post_content'  => "",
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_date' => date("Y-m-d")
);

$q2 = sprintf("INSERT INTO people (person_nm) VALUES ('%s')",$nm);
$conn->query($q2);

$postid = wp_insert_post( $my_post );

echo "postid is " . $postid;




?>


