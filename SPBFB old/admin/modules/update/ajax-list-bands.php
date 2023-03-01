<?php
$conn = mysql_connect("localhost","admin","l04031425");
mysql_select_db("admin_spb",$conn);

if(isset($_GET['getBandsByLetters']) && isset($_GET['letters'])){
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysql_query("select ID,bandName from ajax_Bands where bandName like '".$letters."%'") or die(mysql_error());
	#echo "1###select ID,bandName from ajax_Bands where bandName like '".$letters."%'|";
	while($inf = mysql_fetch_array($res)){
		echo $inf["ID"]."###".$inf["bandName"]."|";
	}	
}
?>
