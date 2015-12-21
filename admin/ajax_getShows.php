<?php

require_once("_connect.php");


$q = <<<MOUT
SELECT *
FROM shows
MOUT;

$result = $conn->query($q);
while($row = $result->fetch_assoc()) {
	$shows[] = $row;
}



?>



<? foreach ($shows as $s) { ?>
	<tr id="row<?=$s["show_pk"];?>">
		<td><?=$s["show_pk"];?></td>
		<td><? echo ($s["show_post"]=="") ? "" : "Yes"; ?></td>
		<td><?=$s["show_nm"];?></td>
		<td><?=$s["show_nm2"];?></td>
		<td><?=$s["show_nm3"];?></td>
		<td><?=$s["show_nm4"];?></td>
		<td><? echo ($s["show_status"]) ? "Active" : "Finished"; ?></td>
		<td><? echo ($s["show_wiki"]) ? "Yes" : ""; ?></td>
	</tr>
<? } ?>