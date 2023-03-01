<?php
/*
if ($per['manage_articles'] == 0) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
*/

?>

<script language="javascript">
<!--	
function delmember(id)
{
if (confirm('Are you sure you want to delete this news item?'))
{document.location.href = 'index.php?manager=members&action=delete&id='+id;}
}
   
// -->

</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Site Members </div>
  </h2>
 <p>
 	<br />
You can select to edit, delete members of the website.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Members Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='tablesubheader' width='28%'>Username</td>
  <td class='tablesubheader' width='15%'>Group</td>
  <td class='tablesubheader' width='17%'>Added</td>
  <td class='tablesubheader' width='20%'>Last Login</td>
  <td class='tablesubheader' width='20%'>&nbsp;</td>
 </tr>
 
 <?php
 $query = mysql_query("SELECT * FROM `members` ORDER BY mgroup DESC");
 $rows = mysql_num_rows($query);
 while ($r = mysql_fetch_array($query)) {
  $p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$r['id']."'"));

 $q = mysql_fetch_array(mysql_query("SELECT * FROM `groups` WHERE g_id = '".$r['mgroup']."'"));
 
$class = ($r['mgroup'] == 1) ? "tablerow2highlight" : "tablerow2";
$class2 = ($r['mgroup'] == 1) ? "tablerow2highlight" : "tablerow1";

?>
 
 
<tr>
<td class='<?php echo $class; ?>'>
<strong><?php echo $p['realname'] . " (". $r['username'].")"; ?></strong>
</td>
<td align='center' class='<?php echo $class; ?>'>
<i><?php echo $q['g_title']; ?></i>
</td>
<td align='center' class='<?php echo $class; ?>'>
<?php echo date("d.m.y", $r['joined']); ?>
</td>
<td align='center' class='<?php echo $class; ?>'>
<?php echo date("jS M @ h:ia", $r['last_logged']); ?>
</td>
<td align='center' class='<?php echo $class2; ?>'>
<?php
if ($_SESSION['uid'] == $r['id'] || level($_SESSION['uid']) >= $r['mgroup']) {
?>

<div align='center' style='white-space:nowrap'>
<a href="index.php?manager=members&action=edit&id=<?php echo $r['id']; ?>"><img src='images/user_edit.png' border='0' alt='Edit User'  /></a> 
<a href="index.php?manager=members&action=profile&id=<?php echo $r['id']; ?>"><img src='images/page_edit.png' border='0' alt="Edit User's Profile"  /></a> 
<a href="index.php?manager=members&action=permissions&id=<?php echo $r['id']; ?>"><img src='images/shield_go.png' border='0' alt='Edit Permissions'  /></a> 

<?php
if ($_SESSION['uid'] != $r['id']) {
?>
<a href="javascript:delmember('<?php echo $r['id']; ?>');"><img src='images/user_delete.png' border='0' alt='Delete User'  /></a>
<?php
} else {
echo "--";
}
?>

</div>
<?php
} else {
echo "-";
}
?>
</td>
</tr>
<?php
}
?>

 </table>
</div>