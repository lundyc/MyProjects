<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

if (isset($_POST['action']) && $_POST['action'] == "doedit") {
$_SESSION['error'] = '';
$error = 0;
$status = 0;

if (empty($_POST['title'])) {
$_SESSION['error'] .= "<li>Please enter a Title</li>\n";
$error = 1;
}

if (strlen($_POST['content']) < 5) {
$_SESSION['error'] .= "<li>Please enter a description.</li>\n";
$error = 1;
}

if ($error == 0) {
$title = trim(addslashes(htmlentities($_POST['title'], ENT_QUOTES)));
$content = trim(addslashes(htmlentities($_POST['content'], ENT_QUOTES)));

mysql_query("UPDATE `gallery` SET `title` = '".$title."', `desc` = '".$content."' WHERE `id` =".(int)$_GET['id']." LIMIT 1 ;") or die("Error: " . mysql_error());
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Thank you, this photo has been edited.
 </p>
</div>
<br>

<?php
redirect("./?manager=gallery", 3);

} else {

$query = mysql_query("SELECT * FROM `gallery` WHERE id='".(int)$_GET['id']."'");
$r = mysql_fetch_array($query);

$query2 = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$r['category']."' LIMIT 1;");
$c = mysql_fetch_array($query2);

$href = "../uploads/gallery/".$r['filename'];
$title = "<b>". stripslashes($r['title']) ."</b><br /> ". stripslashes($r['desc']);
?>

<div class='tableborder'>
<div class='tableheaderalt'>Edit Photo</div>

<form method="post" name="edit" action="./?manager=gallery&action=edit&id=<?php echo $r['id']; ?>">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>

<tr>
 <td align="center" colspan="2" class='tablerow1' valign="top"> 
 <a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="thickbox" rel="lightbox">
<img src="../uploads/gallery/thumbs/<?php echo $r['filename']; ?>" style="BORDER: 1px solid #000000" title="<?php echo $r['title']; ?>"/></a></td>
</tr>

<tr>
<td width="15%" class='tablerow1'><strong>Title:</strong></td>
<td width="85%" class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $r['title']; ?>"></td>
</tr>

<tr>
<td class='tablerow1'><strong>Description:</strong></td>
<td class='tablerow1'>
<textarea name="content" rows="15" wrap="virtual" style="width:85%; height: 100px; overflow:auto;" tabindex="3" class="form_table"><?=$r['desc']?></textarea>
</td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>

</table>
</form>
</div>

<?php
}

} else {

$query = mysql_query("SELECT * FROM `gallery` WHERE id='".(int)$_GET['id']."'");
$r = mysql_fetch_array($query);

$query2 = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".$r['category']."' LIMIT 1;");
$c = mysql_fetch_array($query2);

$cover = ($r['filename'] == $c['thumb']) ? "<img src=\"images/misc/aff_tick.png\"> yes" : "<img src=\"images/misc/exclamation.png\"> no";

$href = "../uploads/gallery/".$r['filename'];
$title = "<b>". stripslashes($r['title']) ."</b><br /> ". stripslashes($r['desc']);
?>

<div class='tableborder'>
<div class='tableheaderalt'>Edit Photo</div>

<form method="post" name="edit" action="./?manager=gallery&action=edit&id=<?php echo $r['id']; ?>">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellpadding='4' cellspacing='0'>

<tr>
 <td align="center" colspan="2" class='tablerow1' valign="top"> 
 <a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="thickbox" rel="lightbox">
<img src="../uploads/gallery/thumbs/<?php echo $r['filename']; ?>" style="BORDER: 1px solid #000000" title="<?php echo $r['title']; ?>"/></a></td>
</tr>

<tr>
<td width="15%" class='tablerow1'><strong>Title:</strong></td>
<td width="85%" class='tablerow1'><input type='text' name='title' size='30' class='textinput' style="width: 85%" value="<?php echo $r['title']; ?>"></td>
</tr>

<tr>
<td class='tablerow1'><strong>Description:</strong></td>
<td class='tablerow1'>
<textarea name="content" rows="15" wrap="virtual" style="width:85%; height: 100px; overflow:auto;" tabindex="3" class="form_table"><?=$r['desc']?></textarea>
</td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>

</table>
</form>
</div>
<?php
}
} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}
?>