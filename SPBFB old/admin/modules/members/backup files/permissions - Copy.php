<?php
if (isset($_POST['action'])) { 

$updatestring = '';

while (list($settingname, $settingvalue) = each($_POST['permission'])) {
$updatestring .= $settingname."='".$settingvalue."',";
}

$updatestring = substr($updatestring,0,strlen($updatestring) - 1);

mysql_query("UPDATE `permissions` SET $updatestring WHERE `permissions`.`uid` =".$_GET['id']." LIMIT 1 ;");

echo "Done";

} else {

//index.php?view=admin&manager=news&action=edit&id=<?php echo $_GET['id']; 

$query = mysql_query("SELECT * FROM `permissions` WHERE uid = '".$_GET['id']."'");
$r = mysql_fetch_array($query);
?>

<div class='tableborder'>
<div class='tableheaderalt'>User Permissions Overview</div>

<form method="post" name="post" action="">
<input type="hidden" name="action" value="doit">
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td colSpan="2" class='tablerow1' style="font-weight: bold">News Permissions</td>
<td colspan="2" class='tablerow1' style="font-weight: bold">Band Information Permissions</td>
</tr>

<tr>
<td width="25%" class='tablerow2'>Can add News</td>
<td width="25%" class='tablerow2'><select class='input3' name='permission[canaddnews]'>
  <option value='1' <?php echo ($r['canaddnews'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddnews'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td width="25%" class='tablerow2'>Can add Info</td>
<td width="25%" class='tablerow2'><select class='input3' name='permission[canaddinfo]'>
  <option value='1' <?php echo ($r['canaddinfo'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddinfo'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>


<tr>
<td class='tablerow2'>Can edit News</td>
<td class='tablerow2'><select class='input3' name='permission[caneditnews]'>
  <option value='1' <?php echo ($r['caneditnews'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditnews'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td width="25%" class='tablerow2'>Can edit Info</td>
<td width="25%" class='tablerow2'><select class='input3' name='permission[caneditinfo]'>
  <option value='1' <?php echo ($r['caneditinfo'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditinfo'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can delete News</td>
<td class='tablerow2'><select class='input3' name='permission[candeletenews]'>
  <option value='1' <?php echo ($r['candeletenews'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeletenews'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td width="25%" class='tablerow2'>Can delete Info</td>
<td width="25%" class='tablerow2'><select class='input3' name='permission[candeleteinfo]'>
  <option value='1' <?php echo ($r['candeleteinfo'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeleteinfo'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td colSpan="2" class='tablerow1' style="font-weight: bold">Parades Permissions</td>
<td colSpan="2" class='tablerow1' style="font-weight: bold">Gallery Permissions</td>
</tr>

<tr>
<td class='tablerow2'>Can delete Parade Notes</td>
<td class='tablerow2'><select class='input3' name='permission[candeletenotes]'>
  <option value='1' <?php echo ($r['candeletenotes'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeletenotes'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can add Album</td>
<td class='tablerow2'><select class='input3' name='permission[canaddalbum]'>
  <option value='1' <?php echo ($r['canaddalbum'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddalbum'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can add Parade</td>
<td class='tablerow2'><select class='input3' name='permission[canaddparade]'>
  <option value='1' <?php echo ($r['canaddparade'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddparade'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can edit Album</td>
<td class='tablerow2'><select class='input3' name='permission[caneditalbum]'>
  <option value='1' <?php echo ($r['caneditalbum'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditalbum'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can edit Parade</td>
<td class='tablerow2'><select class='input3' name='permission[caneditparade]'>
  <option value='1' <?php echo ($r['caneditparade'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditparade'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can delete Album</td>
<td class='tablerow2'><select class='input3' name='permission[candeletealbum]'>
  <option value='1' <?php echo ($r['candeletealbum'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeletealbum'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can delete Parade</td>
<td class='tablerow2'><select class='input3' name='permission[candeleteparade]'>
  <option value='1' <?php echo ($r['candeleteparade'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeleteparade'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can add Photo</td>
<td class='tablerow2'><select class='input3' name='permission[canaddphoto]'>
  <option value='1' <?php echo ($r['canaddphoto'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddphoto'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can add Parade Category</td>
<td class='tablerow2'><select class='input3' name='permission[canaddparadecat]'>
  <option value='1' <?php echo ($r['canaddparadecat'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canaddparadecat'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can edit Photo</td>
<td class='tablerow2'><select class='input3' name='permission[caneditphoto]'>
  <option value='1' <?php echo ($r['caneditphoto'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditphoto'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can edit Parade Category</td>
<td class='tablerow2'><select class='input3' name='permission[caneditparadecat]'>
  <option value='1' <?php echo ($r['caneditparadecat'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditparadecat'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can delete Photo</td>
<td class='tablerow2'><select class='input3' name='permission[candeletephoto]'>
  <option value='1' <?php echo ($r['candeletephoto'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeletephoto'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can delete Parade Category</td>
<td class='tablerow2'><select class='input3' name='permission[candeleteparadecat]'>
  <option value='1' <?php echo ($r['candeleteparadecat'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeleteparadecat'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
<td class='tablerow2'>Can move Photo</td>
<td class='tablerow2'><select class='input3' name='permission[canmovephoto]'>
  <option value='1' <?php echo ($r['canmovephoto'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['canmovephoto'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>


<tr>
<td colSpan="4" class='tablerow1' style="font-weight: bold">Guestbook Permissions</td>
</tr>

<tr>
<td class='tablerow2'>Can edit Guestbook Entries</td>
<td colspan="3" class='tablerow2'><select class='input3' name='permission[caneditguestbook]'>
  <option value='1' <?php echo ($r['caneditguestbook'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['caneditguestbook'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>

<tr>
<td class='tablerow2'>Can delete Guestbook Entries</td>
<td colspan="3" class='tablerow2'><select class='input3' name='permission[candeleteguestbook]'>
  <option value='1' <?php echo ($r['candeleteguestbook'] == 1) ? "selected" : ''; ?>>Yes&nbsp;&nbsp;&nbsp;&nbsp;</option>
  <option value='0' <?php echo ($r['candeleteguestbook'] == 0) ? "selected" : ''; ?>>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
</select></td>
</tr>


	<tr>
		<td class="formsubmit" colSpan="4" align="center"><input type="submit" name="add" value="Modify this Accessgroup"></td>
	</tr>
</table>
</form>
</div>
<?php
}
?>