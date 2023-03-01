<?php
if (level($_SESSION['uid']) > 4) {
?>
<script type="text/javascript" language="JavaScript"><!--
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
//--></script>

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

<span style="color:#FF0000; font-size:16px; font-weight:bold">
THIS PAGE IS CURRENTLY BEING WORKED ON.... DO NOT TRY AND ADD, EDIT OR DELETE ANY MEMBERS
</span>

<div class='tableheaderalt'>Filter Members</div>
<table cellpadding='4' cellspacing='0' width='100%'>
<tr>
<td>
	Show Only: 
    <select name="showonly">
    <option>Please Select</option>
    	<?php
			$query = mysql_query("SELECT roleID, name FROM `role` ORDER BY displayID");
			while ($s = mysql_fetch_array($query)) {
				echo '<option value="'.$s['roleID'].'">'. $s['name'] .'</option>';
			}	
		?>
    </select>
</td>
<td>
Search Username:
<input type="text" />
</td>
<td>Search Fullname: <input type="text" /></td>
</tr>
</table>



<div class='tableheaderalt'>Members Overview</div>
<table cellpadding='4' cellspacing='0' width='100%'>


<?php
/////////////////////////////////////
//0,1,2,3,4,5
$color = array("", "", "#be6aea", "#ea6ae0", "#eab56a", "#6abbea");

//0,1,2,3,4,5
$levels = array("", "Band Member", "Band Committee", "Administrator", "Root Admin", "Webmaster");
//////////////////////////////////////
/*
$query = mysql_query("SELECT * FROM `role` WHERE roleID = '1'");
$r = mysql_fetch_array($query);
?>
 <tr>
  <td class='tablesubheader' onclick="javascript:ReverseDisplay('officers')" onmouseover="style.cursor='pointer'">
  <?php echo $r['name']; ?>
  </td>
</tr>

<tr>
<td style="padding: 0px; margin: 0px; display: none" id="officers" >

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Full Name</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>User Name</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Position</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Admin Options</strong></td>
</tr>


<?php

$query2 = mysql_query("SELECT * FROM `members` WHERE section1 = '1'");
while ($m = mysql_fetch_array($query2)) {

$p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$m['id']."'"));

$query3 = mysql_query("SELECT * FROM `memberstatus` WHERE statusid = '".$m['rank1']."'");
$rank = mysql_fetch_array($query3);
?>
<tr>
<td class="tablerow2">
<?php  echo $p['realname']; ?></td>
<td class="tablerow2">
<?php echo $m['username']; ?></td>
<td class="tablerow2">
<?php echo (strlen($rank['statusname']) > 0) ? $rank['statusname'] : "&nbsp;"; ?></td>
<td width="20%" align="center" class="tablerow2">
<a href="index.php?manager=members&action=profile&id=<?php echo $m['id']; ?>"><img src="images/page_go.png" /></a> 
<a href="index.php?manager=members&action=edit&id=<?php echo $m['id']; ?>"><img src="images/page_edit.png" /></a> 
<a href="#"><img src="images/lock.png" /></a> 
<a href="#"><img src="images/page_delete.png" /></a></td>
</tr>
<?php
}
?>
</table>
</td>
</tr>

<?php
*/
$query = mysql_query("SELECT * FROM `role` ORDER BY displayID");
while ($r = mysql_fetch_array($query)) {

$sec = ($r['roleID'] == 1) ? "section1 = '" : "section2 = '";
$sec .= $r['roleID']."'";

$query2 = mysql_query("SELECT * FROM `members` WHERE $sec");

if (mysql_num_rows($query2) > 0) {
?>
 <tr>
  <td class='tablesubheader' onclick="javascript:ReverseDisplay('<?php echo $r['name']; ?>')" onmouseover="style.cursor='pointer'">
  <?php echo $r['name']; ?>
  </td>
</tr>

<tr>
<td style="padding: 0px; margin: 0px; display: none" id="<?php echo $r['name']; ?>" >

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Full Name</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>User Name</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Position</strong></td>
<td width="25%" class="tablerow1shaded" style="padding-bottom: 2px; padding-top: 3px;"><strong>Admin Options</strong></td>
</tr>
<?php
while($m = mysql_fetch_array($query2)) {

$rank = ($r['roleID'] == 1) ? $m['rank1'] : $m['rank2'];

$p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$m['id']."'"));

$query3 = mysql_query("SELECT * FROM `memberstatus` WHERE statusid = '".$rank."'");
$rank = mysql_fetch_array($query3);
?>
<tr>
<td class="tablerow1">
<?php  echo $p['realname']; ?></td>
<td class="tablerow1">
<?php echo $m['username']; ?></td>
<td class="tablerow1">
<?php echo (strlen($rank['statusname']) > 0) ? $rank['statusname'] : "&nbsp;"; ?></td>
<td width="20%" align="center" valign="top" class="tablerow1">
<a href="index.php?manager=members&action=profile&id=<?php echo $m['id']; ?>"><img src="images/page_go.png" /></a> 
<a href="index.php?manager=members&action=edit&id=<?php echo $m['id']; ?>"><img src="images/page_edit.png" /></a> 
<a href="#"><img src="images/lock.png" /></a> 
<a href="#"><img src="images/page_delete.png" /></a></td>
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

}
?>
</table>
