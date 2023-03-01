<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//

/*
<div id="listing1_header"><span>Members</span> Area</div>

<div style="border-left: 1px solid #314562; border-right: 1px solid #314562; border-bottom: 1px solid #314562">
<table width="100%" cellspacing="0" class='ipbtable'>
<tr>
<td class="row2">
<table border="0" cellpadding="0" cellspacing="0" style="text-align:center; width: 100%;">
<tr>
<td colspan="2" align="left">
<span class="home"><b>Logged in as:  <?php echo idtoname($_SESSION['uid']); ?></b></span>
*/


/* 	This one is for if they GET there delete's */
if ($_GET['delete'] == "true") {
$q = mysql_query("SELECT * FROM `msgs` WHERE `to`='".$_SESSION['uid']."' AND `id`='".(int)$_GET['id']."'");
$count = mysql_num_rows($q);

if ($count > 0) {
mysql_query("DELETE FROM msgs WHERE id='".(int)$_GET['id']."'");
}

}

/*$q = mysql_query("SELECT `group` FROM `members` WHERE id='".$_SESSION['uid']."' LIMIT 1;");
$res = mysql_fetch_array($q);

$q2 = mysql_query("SELECT `canviewadmin` FROM `permissions` WHERE pid = '".$res['0']."' LIMIT 1;");
$cansee = mysql_fetch_array($q2);
?>



<table width="100%" cellpadding="2" cellspacing="0" class="rightpanel">
<tr> 
<td>&nbsp;</td>
<td><span class="style1">Your Account</span><br> 

<?php
if ($cansee['0'] == 1) {
?>
&nbsp;&nbsp; <font color="#333333"><strong>&#8250;</strong></font> 
<a href="./admin/index.php">Admin Panel</a><br> 
<?php
}
?>

&nbsp;&nbsp; <font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=mycontrols">My Controls</a><br> 
<?php
//if (in_array("admin", $mail['list'])) { echo "admin is there<br />"; } else { echo "admin is not there<br />"; }
?>
&nbsp;&nbsp; 
<font color="#333333"><strong>&#8250;</strong></font> 
<a href="logout.php">Logout</a> <br> </td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td><span class="style1">Bannd Overview</span><br />
  &nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> Members List <br />
  &nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> Cash Box<br />
  </td>
  <td valign="top"></td>
  <td>&nbsp;</td>
</tr>
<tr> 
<td width="5">&nbsp;</td>
<td width="1248"><span class="style1">Personal Messages</span><br> 
&nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=inbox">Inbox</a> <br> &nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=sendmessage">Compose</a><br> </td>
<td width="36" valign="top">
<div align="right"><br>
(<?php echo mysql_num_rows(mysql_query("SELECT `id` FROM `msgs` WHERE `to` = '".$_SESSION['uid']."' AND status='unread'")); ?>) </div></td>
<td width="25">&nbsp;</td>
</tr>
 </table>
				 
</td>
    </tr>
      </table>

	  
	  </td>
</tr>
</table>
</div>
<br />

*/
?>