<?php
if (isset($_POST['action'])) { 

mysql_query("UPDATE `members` SET `group` = '".$_POST['group']."' WHERE `id` =".$_GET['id']." LIMIT 1 ;");

echo "Done";

} else {

//index.php?view=admin&manager=news&action=edit&id=<?php echo $_GET['id']; 

?>

<script language="javascript">

var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable=0'
win = window.open(mypage,myname,settings)
}

</script>
<?php
$query2 = mysql_query("SELECT `group`, `username` FROM `members` WHERE id = '".$_GET['id']."' LIMIT 1;");
$q = mysql_fetch_array($query2);
?>
<div class='tableborder'>
<div class='tableheaderalt'>User Permissions Overview</div>

<form method="post" name="post" action="">
<input type="hidden" name="action" value="doit">
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td width="28%" class='tablerow2'>Members Name</td>
<td width="72%" class='tablerow2'><?php echo $q['username']; ?></td>
</tr>

<tr>
<td class='tablerow2'>Access Group</td>
<td class='tablerow2'>
<select name="group" class="shoutbox" style="width: 50%;">
<?php
$query = mysql_query("SELECT * FROM `permissions` ORDER BY pid ASC");
while ($r = mysql_fetch_array($query)) {
$selected = ($r['pid'] == $q['group']) ? "selected" : '';
?>
<option value="<?php echo $r['pid']; ?>" <?php echo $selected; ?>><?php echo $r['name']; ?></option>
<?php
} 
?>
  </select> <a href="modules/members/viewtable.php" onClick="NewWindow(this.href,'name','800','600','yes');return false">View Groups</a>
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
?>