<?php
$check = 0;
$show_forn = 1;

$query = mysql_query("SELECT * FROM `news` WHERE id = '".$_GET['NewsID']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This news post does not exisit or has been removed by the admin");
}

$date = explode("-", $r['date']);
$date 	= date("D, jS F Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 
?>

<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Edit News</h2>
<?php
if ($_POST['action'] == "doeditnews") {

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
	mysql_query("UPDATE `news` SET `date` = NOW( ), `title` = '".$_POST['title']."', `MainBody` = '".$_POST['editor1']."' WHERE `id` =".(int)$_GET['NewsID']." LIMIT 1");
	
	echo "<p>This news item has been updated.</p>";
	redirect("index.php?view=news&action=admin", 5);
	
	
	
}


}


if ($show_forn == 1) {
?>



<form method="post" name="post" action="?view=news&action=edit&NewsID=<?php echo $_GET['NewsID']; ?>">
<input type="hidden" name="action" value="doeditnews">

<b>News Subject:</b><br />
<input name="title" id="title" type="text" value="<?php echo $r['title']; ?>" style="width: 85%;" />
<?php
if ($check == 1 && isset($title_error)) {
	echo '<br>';
	echo $title_error;
}
?>
<br /><br />

<strong>Body:</strong><br />
<?php
include("ckeditor/ckeditor.php");
$CKEditor = new CKEditor();
$CKEditor->returnOutput = true;
$CKEditor->basePath = 'ckeditor/';
$config['skin'] = 'office2003';
$config['removePlugins'] = 'resize';
$config['removePlugins'] = 'elementspath';
$config['resize_enabled'] = false;
$config['toolbarCanCollapse'] = false;

$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 4);

$initialValue = $r['MainBody'];

$config['toolbar'] = array(
array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'NumberedList', 'BulletedList', '-',  'Outdent','Indent','Blockquote', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array('Link','Unlink','Anchor','-','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak', 'TextColor','BGColor'),
array('Styles','Format','Font','FontSize')
);


$code = $CKEditor->editor("editor1", $initialValue, $config);

echo $code;

if ($check == 1 && isset($editor1_error)) {
	echo '<br>';
	echo $editor1_error;
}
?>

<br /><br />

<b>Date Submitted</b> <?php echo $date; ?>

<br />

<b>Author</b> <?php echo idtoname($r['poster']); ?>
  
  <div align="center">
<input type='submit' name="submit" value='Save Changes' accesskey='s'>
</div>
</form>

<?php
}
?>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
