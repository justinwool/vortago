<?php

$myYear1 = 2009;
$myYear2 = "";

$myDate1 = (checkdate($myDate1p[0],$myDate1p[1],$myDate1p[2]) ? $myDate1 : "";
$myDate2 = (checkdate($myDate2p[0],$myDate2p[1],$myDate2p[2]) ? $myDate2 : "";

$myYear1 = (is_int($myYear1) && $myYear1 >= 1940 && $myYear1 <= 2050) ? $myYear1 : "";
$myYear2 = (is_int($myYear2) && $myYear2 >= 1940 && $myYear2 <= 2050) ? $myYear2 : "";




?>

<?=$myYear1;?>

<br>

<?=$myYear2;?>