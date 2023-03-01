<?php
if (level($_SESSION['uid']) > 4) {
?>
<script type="text/javascript" language="JavaScript">
<!--
function HideContent(d) {
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
else { document.getElementById(d).style.display = "none"; }
}

function delmember(id)
{
if (confirm('Are you sure you want to delete this member?'))
{document.location.href = 'index.php?manager=members&action=delete&id='+id;}
}
   
//-->
</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Band Members </div>
  </h2>
 <p>
 	<br />
You can select to edit, delete members of the website.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Office Members</div>

<table cellpadding='4' cellspacing='0' width='100%'>

<tr>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Full Name</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>User Name</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>E-mail</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Position</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Admin Options</strong></td>
</tr>

<?php
$query = mysql_query("SELECT 
`office`.`position`, 
`office`.`orderid`, 
`office`.`member_id`,

`profile`.`realname`,

`members`.`username`,
`members`.`email`

FROM `office`, `members`, `profile` 

WHERE `office`.`member_id` = `profile`.`mid` AND `office`.`member_id` = `members`.`id`
ORDER BY `office`.`orderid`");
while ($r = mysql_fetch_array($query)) {
?>
<tr>
<td class="tablerow2">
<?php  echo $r['realname']; ?></td>
<td class="tablerow2">
<?php echo $r['username']; ?></td>
<td class="tablerow2">
<?php 
$na = explode(' ', $r['realname']);
$email = strtolower($na['0']) ."@". strtolower($na['1']).".com";

echo ($r['email'] == $email) ? "<span style='color: red'>" : '';
echo $r['email'];
echo ($r['email'] == $email) ? "</span>" : '';
 ?>
</td>
<td class="tablerow2">
<?php echo $r['position']; ?></td>
<td width="27%" align="center" class="tablerow2">
<a href="index.php?manager=members&action=profile&id=<?php echo $r['member_id']; ?>"><img src="images/page_go.png" alt="View Profile" /></a> 
<a href="index.php?manager=members&action=edit&id=<?php echo $r['member_id']; ?>"><img src="images/page_edit.png" alt="Edit Member" /></a> 
<a href="javascript:delmember('<?php echo $r['member_id']; ?>');"><img src="images/page_delete.png" alt="Delete Member" /></a></td>
</tr>
<?php
}
?>
</table>

<br>


<div class='tableheaderalt'>Members Overview</div>


<table cellpadding='4' cellspacing='0' width='100%'>

<?php
$query = mysql_query("SELECT * FROM `role` ORDER BY displayID");
while ($r = mysql_fetch_array($query)) {

$q2 = "SELECT
`profile`.`realname`, 
`members`.`email`,
`members`.`username`,
`members`.`id`,
`members`.`rank2`,

(SELECT `displayorder` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `display_order`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `name`

FROM `members`, `profile` WHERE `members`.`section2` = '".$r['roleID']."' AND `members`.`id` = `profile`.`mid` ORDER BY `display_order`, `members`.`id`;";

$query2 = mysql_query($q2);

if (mysql_num_rows($query2) > 0) {
?>
 <tr>
  <td class='tablesubheader' onclick="javascript:ReverseDisplay('<?php echo $r['name']; ?>')" onmouseover="style.cursor='pointer'">
  <?php echo $r['name']; ?>
  </td>
</tr>

<tr>
<td style="padding: 0px; margin: 0px; display: block" id="<?php echo $r['name']; ?>" >

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Full Name</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>User Name</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>E-mail</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Position</strong></td>
<td width="20%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Admin Options</strong></td>
</tr>
<?php
while($m = mysql_fetch_array($query2)) {
	
?>
<tr>
<td class="tablerow1">
<?php  echo $m['realname']; ?></td>
<td class="tablerow1">
<?php echo $m['username']; ?></td>
<td class="tablerow1">
<?php 
$na = explode(' ', $m['realname']);
$email = strtolower($na['0']) ."@". strtolower($na['1']).".com";

if ($m['email'] == $email) {
echo "<span style='color: red'>";
echo $m['email'];
echo "</span>";
} else {
echo $m['email'];
}
 ?>
</td>
<td class="tablerow1">
<?php echo (strlen($m['name']) > 0) ? $m['name'] : "&nbsp;"; ?></td>
<td align="center" valign="top" class="tablerow1">
<a href="index.php?manager=members&action=profile&id=<?php echo $m['id']; ?>"><img src="images/page_go.png" /></a> 
<a href="index.php?manager=members&action=edit&id=<?php echo $m['id']; ?>"><img src="images/page_edit.png" /></a> 
<a href="javascript:delmember('<?php echo $m['id']; ?>');"><img src="images/page_delete.png" /></a></td>
</tr>

<?php
}
?>
</table>
</td>
</tr>

<?php
}

}
?>
</table>


<?php
}
?>






