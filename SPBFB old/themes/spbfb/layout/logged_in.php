<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
?>

<div class="listing1_header"><span class="style5">Members </span><span class="style6">Login</span> <div>

<table width="100%" cellspacing="0" class='ipbtable'>
<tr>
<td class="row2">
<table border="0" cellpadding="0" cellspacing="0" style="text-align:center; width: 100%;">
<tr>
<td colspan="2" align="left">
<span class="home"><b>Logged in as:  <?php echo idtoname($_SESSION['uid']); ?></b> ( <a href="logout.php">Log Out</a> )</span>

<?php
/* 	This one is for if they POST there delete's */
if ($_POST['submit'] == "delete") {
$q = mysql_query("SELECT * FROM `msgs` WHERE `to`='".$_SESSION['uid']."'");
$count = mysql_num_rows($q);

for($i=0; $i < $count; $i++){
mysql_query("DELETE FROM msgs WHERE id='".(int)$_POST['checkbox'][$i]."'");
}

}

/* 	This one is for if they GET there delete's */
if ($_GET['delete'] == "true") {
$q = mysql_query("SELECT * FROM `msgs` WHERE `to`='".$_SESSION['uid']."' AND `id`='".(int)$_GET['id']."'");
$count = mysql_num_rows($q);

if ($count > 0) {
mysql_query("DELETE FROM msgs WHERE id='".(int)$_GET['id']."'");
}

}


$msgs = mysql_query("SELECT `id` FROM `msgs` WHERE `to` = '".$_SESSION['uid']."' AND status='unread'");
$new = mysql_num_rows($msgs);

$inbox = ($new > 0) ? "<strong>Inbox</strong> <font color=\"blue\">(".$new.")</font>" : "Inbox";


?>



<table width="100%" cellpadding="2" cellspacing="0" class="rightpanel">
<tr> 
<td>&nbsp;</td>
<td><span class="style1">Your Account</span><br> 
&nbsp;&nbsp; <font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=admin">Admin Panel</a><br> 
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
<td width="5">&nbsp;</td>
<td width="1248"><span class="style1">Personal Messages</span><br> 
&nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=inbox">Inbox</a> <br> &nbsp;&nbsp;<font color="#333333"><strong>&#8250;</strong></font> 
<a href="./?view=sendmessage">Compose</a><br> </td>
<td width="36" valign="top">
<div align="right"><br>
(<?php echo $new; ?>) </div></td>
<td width="25">&nbsp;</td>
</tr>
 </table>
				 
</td>
    </tr>
      </table>

	  
	  </td>
</tr>
</table>