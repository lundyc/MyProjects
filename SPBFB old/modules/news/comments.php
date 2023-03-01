<?php
# Lets check if the User is logged in ...
if (!isset($_SESSION['uid'])) {
die(redirect("index.php",0));
}
?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>News</h2>
<?php
if ($_POST['action'] == "doadd" && (!empty($_POST['content']))) {
mysql_query("INSERT INTO `news_comments` (`NewsID` ,`UserID` ,`date` ,`content` )VALUES ('".$_GET['NewsID']."', '".$_SESSION['uid']."', '".date("Y-m-d")."', '".$_POST['content']."');");
}

# Time to grab the news
$r = mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE id = '".$_GET['NewsID']."' LIMIT 1"));

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
?>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Comments</h2>

<style>
.commentsfadelisting {
	margin-bottom: 10px;
	padding-left: 6px;
	padding-right: 6px;
	padding-bottom: 6px;
}
</style>
<div class='commentsfadelisting' >
<?php

// Get Comments
$query4 = mysql_query("SELECT * FROM `news_comments` WHERE NewsID = '".$_GET['NewsID']."' order by id desc");

if (mysql_num_rows($query4) == 0) {
echo "<center style='padding-top: 10px;'>* No Comments *</center>";
} else {

while ($c = mysql_fetch_array($query4)) {

$poster = '<a href="./?view=profile&id='. $c['UserID'].'">'.IDtoFullName($c['UserID']).'</a>';

$cdate = explode("-", $c['date']);
$cday 	= date("D, jS F Y", mktime(0,0,0, $cdate['1'], $cdate['2'], $cdate['0'])); 
?>

<div class='h4'>
<?php 
echo "By: <b>".$poster."</b> on " . $cday;
?>
</div>

<br/>

<div class='MainBody'>
<?php echo nl2br($c['content']); ?>
</div>

<div style='clear: both; border-bottom: 2px solid #bcbcbc; '></div>

<?php
}

}
?>
</div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Post a Comment</h2>

<?php
if ($_SESSION['uid'] == 7) {
echo "<div style='padding: 3px; text-align: center'>You are not allowed to use this function</div>";
} else {
?>

<form method="post" name="addcomment" action="index.php?view=news&action=comments&NewsID=<?php echo $_GET['NewsID']; ?>">
<input type="hidden" name="action" value="doadd">
<textarea name="content"  rows="5" style="width: 99%; overflow:auto;"></textarea>
<br />
<center><input name="submit" type="submit" class="put2" value="Post Comment" /></center>
</form>
</p>
<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>

