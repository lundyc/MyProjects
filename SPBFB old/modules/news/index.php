<?php
/*
// Disabled 
<script src="script/jquery-1.7.js" type="text/javascript"></script>
<script src="script/jquery.jcountdown1.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript">
$(document).ready(function() {
			
	$("#time").countdown({
		date: "July 12, 2012 08:00",
		onComplete: function( event ){
			//$("#time").removeData('jcdData');
			$("#time").countdown({
				date: "march 30, 2012 11:00",
				onComplete: function( event ) {

					$(this).html("Completed");
				},
				leadingZero: true
			});
		},
		leadingZero: true
	});


});
</script>

*/
?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>News</h2>
	  

<?php
/*
// Disabled

<div class='fadelisting'>
<div class='header'>Belfast Trip Countdown</div>
<div class='h4'>
By: <b> the SPB
</b>
</div>
<br/>

<div class='MainBody'>
	<p id="time" class="time"></p>
</div>

<div style='clear: both'></div>
</div>
*/


$query = safe_query("SELECT * FROM `news` ORDER BY `date` DESC , `OrderBy` DESC limit 5;");
if (mysql_num_rows($query) == 0) {
echo "<center>There is currently no news in our database. Please try again later</center>";
} else {

while ($r = mysql_fetch_array($query)) {
$date = explode("-", $r['date']);
$day 	= date("D, jS F Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 

$poster = '<a href="./?view=mypanel&action=profile&id='. $r['poster'].'">'.IDtoFullName($r['poster']).'</a>';

echo "<div class='fadelisting'>";
echo "<div class='header'>".$r['title']."</div>";
echo "<div class='h4'>";
echo "By: <b>";
echo (isset($_SESSION['uid'])) ? $poster." " : "webmaster ";
echo "</b>on " . $day;

echo "</div>";
echo "<br/>";

echo "<div class='MainBody'>";
echo $r['MainBody']; 
echo "</div>";

echo "<div style='clear: both'></div>";
echo "</div>";
}

}
?>
		
		
</div>
  <div class="bb"><div><div></div></div></div>
</div>

