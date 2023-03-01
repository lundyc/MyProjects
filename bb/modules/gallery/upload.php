<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_POST['Submit'])) {
$uploadNeed = $_POST['uploadNeed'];
for($x=0;$x<$uploadNeed;$x++){
$file_name = $_FILES['uploadFile'. $x]['name'];
$file_name = stripslashes($file_name);
$file_name = str_replace("'","",$file_name);

$copy = copy($_FILES['uploadFile'. $x]['tmp_name'],"uploads/gallery/tmp/". $file_name);

 if($copy){
 echo "$file_name | uploaded sucessfully!<br>";
 }else{
 echo "$file_name | could not be uploaded!<br>";
 }
 
} 
?>	
}


if (empty($_GET['name'])) {
// time to select a album
?>
<table width='100%' cellpadding='4' cellspacing='0'>

<?php
$columns = "3";
$rows = "0";
$i = 0;

$query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
while ($r = mysql_fetch_array($query)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;
?>
<td align="center" style="padding: 5px;">
<img src="../uploads/gallery/thumbs/<?php echo $r['thumb']; ?>" style="border: 1px solid black"/>
<br />
<?php echo $r['title']; ?><br />


<form method="post" action="./?manager=gallery&action=upload&name=<?php echo $r['cid']; ?>">
  <input type="submit" value="Select"/>
</form>
<br />

</td>
<?php
}
?>
</table>
<?php
} else {
$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".addslashes($_GET['name'])."' LIMIT 1");
$r = mysql_fetch_array($query);
$album = $r['title']; 
?>

<form name="form1" enctype="multipart/form-data" method="post" action="">
<?php
$uploadNeed = 5;
for($x=0;$x<$uploadNeed;$x++){
?>
 <input name="uploadFile<? echo $x;?>" type="file" id="uploadFile<? echo $x;?>">
<?php
  }
?>
  <p><input name="uploadNeed" type="hidden" value="<? echo $uploadNeed;?>">
    <input type="submit" name="Submit" value="Submit">
  </p>
</form>
<?php
}
?>