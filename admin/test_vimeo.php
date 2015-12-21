<?php

$imgid = 6271487;

$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));

print_r($hash);

echo "<hr>";
echo $hash[0]['thumbnail_medium'];  

?>

<img src="<?=$hash[0]['thumbnail_small'];?>">
<img src="<?=$hash[0]['thumbnail_medium'];?>">
<img src="<?=$hash[0]['thumbnail_large'];?>">