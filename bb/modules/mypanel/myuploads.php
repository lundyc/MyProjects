<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}
?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>My Uploaded Pictures</h2>


<b>Accecpted Files</b>
<br />


<?php

	$query = mysql_query("SELECT * FROM `user_gallery` WHERE `UserID` = '".$_SESSION['uid']."' AND `accecpted` = 'yes' ORDER BY `CatID`");
	while ($r = mysql_fetch_array($query)) {
		
		$q2 = "SELECT * FROM  `gallery_categories` WHERE `cid` = '".$r['CatID']."';";
		$query2 = mysql_query($q2);
		$c = mysql_fetch_array($query2);
		
			$picture 	=	"uploads/user_gallery/" . $r['filename'];
			$d			=	explode("-", $r['added']);
			$date 		=	mktime(0,0,0, $d['1'], $r['2'], $r['0']);
		
			echo "<div>";
			echo '<img src="'. $picture.'" width="90" height="90" border="0" style="border: 1px solid black; float: left; content: ""; display: block;  clear      : both;" />';			
			echo ' - ';
			echo $c['title'];
			echo "<br />";
			echo date("D jS F Y",$date);
			echo "</div>\n";
	}
	?>
    <b>Pending Files</b>
<br />
<?php
	$query = mysql_query("SELECT * FROM `user_gallery` WHERE `UserID` = '".$_SESSION['uid']."' AND `accecpted` = 'no' ORDER BY `CatID`");
	while ($r = mysql_fetch_array($query)) {
		
		$q2 = "SELECT * FROM  `gallery_categories` WHERE `cid` = '".$r['CatID']."';";
		$query2 = mysql_query($q2);
		$c = mysql_fetch_array($query2);
		
			$picture 	=	"uploads/user_gallery/" . $r['filename'];
			$d			=	explode("-", $r['added']);
			$date 		=	mktime(0,0,0, $d['1'], $r['2'], $r['0']);
		
			echo "<div>";
			echo '<img src="'. $picture.'" width="90" height="90" border="0" style="border: 1px solid black; float: left;" />';			
			echo ' - ';
			echo $c['title'];
			echo "<br />";
			echo date("D jS F Y",$date);
			echo "</div>\n";
	}


?>      
      </div>
  <div class="bb"><div><div></div></div></div>
</div>