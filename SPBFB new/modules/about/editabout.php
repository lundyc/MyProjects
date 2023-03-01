<div class="module"><div class="mb" id='about'>
<h2>
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
Edit Section</h2>
<?php
$_GET['InfoID'] = (isset($_GET['InfoID']) && is_numeric($_GET['InfoID'])) ? $_GET['InfoID'] : 1; 

$check = 0;
$show_forn = 1;

if ($_POST['action'] == "doedit") {

if (empty($_POST['title'])) {
	$check = 1;
	$title_error = "Please enter a title";
}

if (empty($_POST['editor1'])) {
	$check = 1;
	$editor1_error = "please enter some news";
}

if ($check == 0) {
	$show_forn = 0;
	
	$title = $_POST['title'];
	$content = $_POST['editor1'];
	
	$q = "UPDATE `info` SET 
	`title` = '".$title."', 
	`content` = '".$content."' WHERE `id` = ".$_GET['InfoID'].";";
	
if (!$mysqli->query($q)) {
    echo "INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error;
} 
	
	echo '<div style="border: 1px solid #B3B5B5; background-color: #E9E3D1; padding: 3px; margin: 3px;">';
	echo '<b>Congrats:</b> This item has been updated.</div>';
	
	?>
		<script>
	window.setTimeout(function() {
    window.location.href = '/about';
}, 2000);
 </script>
 <?php
//	redirect("index.php?view=news&action=admin", 5);
} 


}


if ($show_forn == 1) {


if ($check == 1) {

if (isset($title_error)) {
	echo '<div style="border: 1px solid red; background-color: pink; padding: 3px; margin: 3px;"><b>Error:</b> Please enter a title!</div>';
}

if (isset($editor1_error)) {
	echo '<div style="border: 1px solid red; background-color: pink;  padding: 3px; margin: 3px;"><b>Error:</b> Please enter content!</div>';
}


}



$query2 = "SELECT `title`, `OrderID`, `content` FROM `info` WHERE `id` = '". (int)$_GET['InfoID'] ."' LIMIT 1";
$result = $mysqli->query($query2) or die($mysqli->error.__LINE__);
$r = $result->fetch_assoc();
?>

<form method="post" name="post" action="/about?action=edit&InfoID=<?php echo $_GET['InfoID']; ?>">
<input type="hidden" name="action" value="doedit">

<b>Title:</b><br />
<input name="title" id="title" type="text" value="<?php echo $r['title']; ?>" style="padding: 4px; width: 99%; font-size:20px;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;"  />
<br /><br />

		<textarea cols="80" id="editor1" name="editor1" rows="10">
		<?php
		echo $r['content'];
		?>
		</textarea>
		<script>

			// This call can be placed at any point after the
			// <textarea>, or inside a <head><script> in a
			// window.onload event handler.

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.

		
			
			CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/browse.php',
    filebrowserUploadUrl: '/upload.php'
});

		</script>


  <div align="center">
<input type='submit' name="submit" value='Save Changes' accesskey='s'>

</div>
</form>
<?php
}
?>
</div></div>