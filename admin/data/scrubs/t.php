<?php

// JOE ROGAN SHOW
// http://podcasts.joerogan.net/podcasts/
$showid = 206;

$dom = new DOMDocument();

$exp1 = './/div[contains(concat(" ", normalize-space(@class), " "), " episode ")]';
$exp2 = './/div[contains(concat(" ", normalize-space(@class), " "), " podcast-date ")]/h3';
$exp3 = './/div[contains(concat(" ", normalize-space(@class), " "), " podcast-details ")]/a/h3';
$exp4 = './/div[contains(concat(" ", normalize-space(@class), " "), " podcast-links ")]/ul/li/a';
$exp5 = './/div//a[contains(concat(" ", normalize-space(@class), " "), " ajax-permalink ")]';


$expLink2Vid = './/a[contains(concat(" ", normalize-space(@class), " "), " podcast-video-container ")]';
$expLink2Mp3 = './/button[contains(concat(" ", normalize-space(@class), " "), " play-podcast ")]';
//$expLink2Vid = './/div[contains(concat(" ", normalize-space(@class), " "), " podcast-single ")]';

error_reporting(0);


for($p=1;$p<=77;$p++){

//	echo "<hr> Page $p <hr>";

	$html = file_get_contents("http://podcasts.joerogan.net/podcasts/page/$p?load");
	$document = new DOMDocument();
	$document->loadHTML($html);
	$xpath = new DOMXpath($document);


	foreach ($xpath->evaluate($exp1) as $div) {

//		echo "<hr>found episode... <br>";
		
		$app = Array();

		$datedivs = $xpath->evaluate($exp2,$div)->item(0);

		$dts = explode(".",$datedivs->nodeValue);
		
		$app["dt"] = date("m/d/y", mktime(0, 0, 0, $dts[0], $dts[1], $dts[2]));


		$details = $xpath->evaluate($exp3,$div)->item(0);
		$app["person"] = str_replace(array("&",","),"|",$details->nodeValue);

		
		$foundvid = 0;
		$links = $xpath->evaluate($exp4,$div);
		foreach ($links as $l){
			$mylink = $l->getAttribute("href");
			if (strpos($mylink,"vimeo")){
				$foundvid = 1;
				$v["type"] = 2;
				$v["cd"] = substr($mylink,strpos($mylink,"vimeo.com")+10);
				$app["media"][] = $v;
			}
			if (strpos($mylink,".mp3")){
				$foundvid = 1;
				$v["type"] = 5;
				$v["cd"] = $mylink;
				$app["media"][] = $v;
			}
		}

		if (!$foundvid){
			$link2 = $xpath->evaluate($exp5,$div)->item(0);
			$slug = $link2->getAttribute("data-slug");
			$mylink2 = "http://podcasts.joerogan.net/wp-admin/admin-ajax.php?action=loadPermalink&slug=$slug";

			$j1 = json_decode(file_get_contents($mylink2));

			$html2 = $j1->response->html;
			$document2 = new DOMDocument();
			$document2->loadHTML($html2);
			$xpath2 = new DOMXpath($document2);

			$vidlink = $xpath2->evaluate($expLink2Vid)->item(0);
			$mp3link = $xpath2->evaluate($expLink2Mp3)->item(0);

			$v["type"] = 1;
			$v["cd"] = $vidlink->getAttribute("data-video-id");
			if ($v["cd"]) $app["media"][] = $v;

			$v["type"] = 5;
			$v["cd"] = $mp3link->getAttribute("data-stream-url");
			if ($v["cd"]) $app["media"][] = $v;						
		}

		$apps[] = $app;
		
		continue;



	}

}

?>

<table>

	<?php foreach ($apps as $a) { ?>

		<?php foreach ($a["media"] as $m) { ?>
			<tr>
				<td><?=$showid;?></td>
				<td><?=$a["dt"];?></td>
				<td><?=$a["person"];?></td>
				<td><?=$m["type"];?></td>
				<td><?=$m["cd"];?></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>		
		<?php } ?>

	<?php } ?>	
</table>


