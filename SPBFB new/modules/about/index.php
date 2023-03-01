<div class="module"><div class="mb" id='news'><h2>About Us

<?php
$_GET['InfoID'] = (isset($_GET['InfoID']) && is_numeric($_GET['InfoID'])) ? $_GET['InfoID'] : 1; 

?>
</h2>	  
<div id="links">
<?php
$query = "SELECT `id`, `title` FROM `info` ORDER BY `id` ASC";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

while($r = $result->fetch_assoc()) {
echo '<span>';
echo '<a href="/about?InfoID='. $r['id'] .'">'. $r['title'] .'</a>';
echo '</span>'. "\n";
}
?>
</div>

<?php

if ($_GET['InfoID'] == 5) {
include_once("modules/about/members.php");
}elseif ($_GET['InfoID'] == 6) {
include_once("modules/about/playlist.php");
} else {
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {
	echo '<div style="float: right; padding-right: 7px;"><a href="/about?action=edit&InfoID='.$_GET['InfoID'].'">Edit Section</a></div>';
	echo '<div style="clear: both;"></div>';
} 

} 



$query2 = "SELECT `content` FROM `info` WHERE `id` = '". (int)$_GET['InfoID'] ."' LIMIT 1";
$result = $mysqli->query($query2) or die($mysqli->error.__LINE__);
$r = mysqli_fetch_array($result);

echo '<div style="padding: 0 5px 5px 5px;">';
echo $r['content'];
echo '</div>';
} 
?>
</div></div>