<?php

global $postid, $conn, $personPosts, $myAppearances;

/*
SELECT *, DATE_FORMAT(dt,"%M %D, %Y") dt2, $groupSelect mysubgroup, DATE_FORMAT(dt,'%Y') myyear
FROM wp_postmeta, people, shows, appearances LEFT JOIN wp_posts
ON postfk = id
WHERE meta_key = "_wp_attached_file"
AND meta_value = peoplepk
AND post_id = $postid
AND peoplepk = peoplefk
AND showfk = showpk
ORDER BY $groupOrder
*/

$but1 = '<a href="|URL|">View <i class="fa-icon-play-sign fa_icon" style="vertical-align:middle; font-size: 13px; color: black;"></i><span class="mom_icon_hover_effect border_increase_effect" style=""></a>';

$totalct=0;

foreach ($myAppearances as $row) {


	$totalct++;
	$url = $row["post_name"];

	$myname = $row["peoplenm"];
	$myid = $row["peoplepk"];

	if ($url)
		$but = str_replace("|URL|",$url,$but1);
	else
		$but = "";

	if ($url)
		$showlink = "<a href='$url'>" . $row["show_nm"] . "</a>";
	else
		$showlink = $row["show_nm"];

	$personPosts[] = $row["appear_post"];

	$appearances .= "<tr>";
	$appearances .= "<td>" . $showlink . "</td>";
	$appearances .= "<td>" . $row["dt2"] . "</td>";
	$appearances .= "<td>" . $but . "</td>";
	$appearances .= "</tr>";
}


?>

<table class=myListing>
<tr><th>Show / Program / Event</th><th>Date</th><th>Action</th></tr>
<?php foreach ($myAppearances as $a) { ?>
	<tr itemscope itemtype="http://schema.org/TVSeries">
	<td>
		<?php echo ($row["post_name"]) ? "<a href='".$row["post_name"]."'>" : "";?>
		<span itemprop="name"><?=$a["show_nm"];?></span>
		<?php echo ($row["post_name"]) ? "</a>" : "";?>
		<?php if ($a["show_wiki"]<>"") { ?>
			<link itemprop="sameAs" href="<?=$a["show_wiki"];?>"/>
		<?php } ?>
	</td>
	<td itemprop="episode" itemscope itemtype="http://schema.org/TVEpisode">
		<meta itemprop="datePublished" content="<?=$a["appear_dt"];?>"><?=$a["dt2"];?>
	</td>
	<td>
		<?php echo str_replace("|URL|",$a["post_name"],$but1);?>
	</td>
	</tr>
<?php } ?>
</table>

<style>
.myListing th {font-weight:bold;background:navy; color:white;}
</style>