<?php

require_once("../../_connect.php");

require('../../wp-blog-header.php');
require("../../wp-admin/includes/taxonomy.php");


$taxonomy = Array("program_name","program_name2");
$terms = wp_get_post_terms( 3, $taxonomy);

print_r($terms);

echo "<hr>";

foreach ($terms as $t){
	echo $t->taxonomy . ": " . $t->name . "<br>";
}

?>
