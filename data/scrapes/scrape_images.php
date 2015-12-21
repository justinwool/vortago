<table>
<tr>
	<th>Name</th>
	<th>URL</th>
	<th>Image</th>
	<th>Size</th>
</tr>



<?php

$url = "http://www.theplace2.ru/photos/celebs-A.html";
$show = "American History TV";

$ct=0;
for ($page=1;$page<=1;$page++){


	$html_big = file_get_contents($url);

	preg_match_all(
		'~<div class="model_id">.*?<a href="(.*?)".*?<span class="name">(.*?)</span>~s'
		,
		$html_big,
		$posts, // will contain the blog posts
		PREG_SET_ORDER // formats data into an array of posts
	);

	foreach ($posts as $post){

		$ct++;
		$myurl = "http://www.theplace2.ru" . $post[1];
		$myname = $post[2];

		echo "<hr>$myname <br>";

		$pg=1;
		$pgmax=1;
		while ($pg<=$pgmax){

			$html = file_get_contents($myurl . "page" . $pg . "/");

			if ($pgmax==1){
				preg_match_all(
					'~<div class="listalka ltop">(.*?)</div>~s'
					,
					$html,
					$pagediv, // will contain the blog posts
					PREG_SET_ORDER // formats data into an array of posts
				);
				preg_match_all(
					"~<a.*?>(.*?)<~s"
					,
					$pagediv[0][1],
					$posts2, // will contain the blog posts
					PREG_SET_ORDER // formats data into an array of posts
				);
				foreach ($posts2 as $p2){
//					$pgmax = $p2[1];
					$pgmax = max($pgmax,$p2[1]);
				}
			}

			echo "page $pg of $pgmax<br>";
			echo $myurl . "page" . $pg . "/" . "<Br>";

			preg_match_all(
				'~<div class="pic_box">.*?<a href="(.*?)" .*?<div class="size">(.*?)</div>~s'
				,
				$html,
				$posts2, // will contain the blog posts
				PREG_SET_ORDER // formats data into an array of posts
			);

			$myimg = "";  $mysize="";
			foreach ($posts2 as $p2){
				$mysize2 = explode("x",$p2[2]);
				$mysize2 = explode("x",	str_replace(array('[',']'),"",strip_tags($p2[2],"<span>")));
				echo $p2[2] . " ~ ";
				if ($p2[2] <> "850x1000"){
					if ($mysize2[0]<=1000 || $mysize2[0]>=3500 || $mysize2[0]/$mysize2[1]<1.1) continue;
				}
				$myimg = $p2[1];
				$mysize = $p2[2];
				break 2;
			}

	//		if ($ct >= 2) break;

			$pg++;
		}

		echo "<tr>";
		echo "<td>$myname</td>";
		echo "<td>$myurl </td>";
		echo "<td>$myimg</td>";
		echo "<td>$mysize</td>";
		echo "</tr>";

	}
}

?>

</table>
