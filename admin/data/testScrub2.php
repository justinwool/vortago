<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php

require_once("../_connect.php");

$conn->set_charset("utf8");


$sql = <<<MOUT
SELECT *
FROM test_hold
WHERE vidtit like "%:%" OR vidtit like " on "
MOUT;

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	$pk = $row["pk"];
	$vidid = $row["vidid"];
	$vidtit = $row["vidtit"];

	$p = explode(":",$vidtit);
	$p2 = explode(" ",$p[0]);
	if (count($p2)<=4){
		$out2 .= "<tr><td>$vidid</td><td>" . $p[0] . "</td><td>$vidtit</td></tr>";
		continue;
	}

	$p = explode(" on ",$vidtit);
	$p2 = explode(" ",$p[0]);
	if (count($p2)<=4){
		$out2 .= "<tr><td>$vidid</td><td>" . $p[0] . "</td><td>$vidtit</td></tr>";
		continue;
	}

	$out2 .= "<tr><td>$vidid</td><td></td><td>$vidtit</td></tr>";

}



$sql = <<<MOUT
SELECT *
FROM test_hold
WHERE statusfk = 0
LIMIT 100
MOUT;

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

	$pk = $row["pk"];
	$vidid = $row["vidid"];
	$vidtit = str_replace("’","'",$row["vidtit"]);
	$pubdt = $row["pubdt"];
	$desc = str_replace("’","'",$row["viddesc"]);

	$out .= "<tr id=row$pk>";
	$out .= "<td>$vidid</td>";
	$out .= "<td id=myguest$pk><input type=text style='width:150px'></td>";
	$out .= "<td class=postext id=mytit$pk>$vidtit<br>$desc</td>";
	$out .= "</tr>";
}

?>

<table cellspacing=0>
<tr>
	<th>ID</th>
	<th>Inferred Guest</th>
	<th>Title</th>
</tr>
<?=$out2;?>
</table>


<table cellspacing=0>
<tr>
	<th>ID</th>
	<th>Guest</th>
	<th>Title + Description</th>
</tr>
<?=$out;?>
</table>

<style>
td {vertical-align:top}
th, td {border-bottom: thin solid black; padding:5px; text-align:left;}
</style>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>

<script>

if(!window.Kolich){
  Kolich = {};
}

Kolich.Selector = {};
Kolich.Selector.getSelected = function(){
  var t = '';
  if(window.getSelection){
    t = window.getSelection();
  }else if(document.getSelection){
    t = document.getSelection();
  }else if(document.selection){
    t = document.selection.createRange().text;
  }
  return t;
}

Kolich.Selector.mouseup = function(){
	console.log($(this).attr("id"));
  var st = String(Kolich.Selector.getSelected());
  if(st!=''){
		st = st.replace("'s","");
		st = st.replace("’s","");

//    alert("You selected:\n"+st);
	$("#myguest"+$(this).attr("id").substr(5)+" input").val(st);
  }
}

$(document).ready(function(){
  $(".postext").bind("mouseup", Kolich.Selector.mouseup);
});

</script>
