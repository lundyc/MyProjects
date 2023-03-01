<div align="center" style="padding: 5px; font-weight:700;">
Click on the Image to enlarge it.
<br /><br />

<?php
$columns = "2";
$rows = "0";
$posts_per_page = 6; 
$i = 0;

@$start = (!$_GET['start']) ? 0 : $_GET['start'];

$query = "SELECT COUNT(*) FROM `images` "; 
$result = mysql_query($query) or die (mysql_error()); 
$row = mysql_fetch_row($result); 
$total_records = $row[0]; 

if (($total_records > 0) && ($start < $total_records))  { 
$query = "SELECT * FROM `images` ORDER BY id desc LIMIT $start, $posts_per_page"; 
$result = mysql_query($query) or die (mysql_error()); 

while($r = mysql_fetch_array($result)) { 
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;
?>


<a href="image.php?img=<?php echo $r['image']; ?>">
<img src="uploads/media/images/<?php echo $r['image']; ?>" width="128" height="96" class='imgborder' style='margin-right: 5px; margin-bottom: 5px;' />
</a>


<?php
}
} 
?>
</div>

<?php
echo '<div id="NextPrevious">'; 
if ($start >= $posts_per_page) 
{ 
echo "<a href=?view=media&start=".($start-$posts_per_page)."> << $start </a>"; 
} 
if ($start+$posts_per_page < $total_records && $start >= 0) 
{ 
  $sum; 
  $sum = $start + 5; 
  if ($start == 0){ 
  echo "$start - <a href=?view=media&start=".($start + $posts_per_page)."> $sum >> </a>"; 
  } 
  else 
  { 
   echo " -<a href=?view=media&start=".($start + $posts_per_page)."> $sum >> </a>"; 
  } 
} 
echo '</div>';
?>
