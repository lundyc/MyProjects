<div class="module">
<div class="mb"><h2 style="margin-bottom: 0px;">Upcoming Events</h2>

<?php
$query = "SELECT  `date` , `time` ,  `ID` ,  `title`  
FROM  `new_events` 
WHERE STATUS =  'Upcoming'
ORDER BY  `date` ASC 
LIMIT 5";

$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

if ($result->num_rows == 0) {
echo '<tr><td align="center">no upcoming events</td></tr>';
}

while ($r = $result->fetch_assoc()) {
$date 	= date("D jS F", strtotime($r['date'])); 
$time 	= date("g:i a", strtotime($r['time'])); 

?>
<div class="subtitle openpopup" id="<?php echo $r['ID']; ?>">
	<?php echo ucfirst($r['title']); ?>
</div>
  
<span class="row1">Date:</span>
<span class="row2"><?php echo $date; ?></span>

<div>
<span class="row1">Time:</span>
<span class="row2"><?php echo $time; ?></span>
</div>
  
<div class="where"></div> 
<?php
}
?>
</div>
</div>