<?php
if (level($_SESSION['uid']) >= 3) { 

$query = mysql_query("SELECT * FROM `guestbook` WHERE `id`='".$_GET['id']."'");
$r = mysql_fetch_array($query);

$query3 = mysql_query("SELECT * FROM `flags` WHERE `id` = '".$r['location']."' LIMIT 1;");
$results = mysql_fetch_array($query3);
  
  $date = explode("-", $r['date']);
$date 	= date("d M Y", mktime(0,0,0, $date['1'], $date['2'], $date['0'])); 

?>
<div class='tableborder'>
<div class='tableheaderalt'>Guestbook Entry Overview </div>

<table cellpadding='4' cellspacing='0' width='100%'>
<tr>
  <td valign="top" class='tablerow1'>Admin Options</td>
  <td class='tablerow2'>Accecpt : Reply : Edit : Delete</td>
</tr>
<td width='30%' valign="top" class='tablerow1'>ID</td>
<td width='70%' class='tablerow2'><?php echo str_pad($r['id'], 5, "0", STR_PAD_LEFT);  ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'>Status</td>
<td class='tablerow2'><?php echo ($r['status'] == 1) ? "Accepted" : "Awaiting Acceptance"; ?></td>
</tr>	

<tr>
<td valign="top" class='tablerow1'>Date Submitted</td>
<td class='tablerow2'><?php echo $date; ?></td>
</tr>                

<tr>
<td valign="top" class='tablerow1'>Fav Band</td>
<td class='tablerow2'><?php echo (strlen($r['favband']) > 0) ? $r['favband'] : "N/A"; ?></td>
</tr>                

<tr>
<td valign="top" class='tablerow1'>Location</td>
<td class='tablerow2'><?php echo userflag($r['location']) . " " . $results['name']; ?></td>
</tr>   

<tr>
<td valign="top" class='tablerow1'>Name</td>
<td class='tablerow2'><?php echo $r['name']; ?></td>
</tr>


<tr>
<td valign="top" class='tablerow1'>Email</td>
<td class='tablerow2'><?php echo (strlen($r['email']) > 0) ? $r['email'] : "N/A"; ?></td>
</tr>

<tr>
<td valign="top" class='tablerow1'>IP Address</td>
<td class='tablerow2'><?php echo $r['ip']; ?></td>
</tr>

<tr>
<td colspan="2" class='tablerow2'>
<?php echo nl2br(stripslashes(BBcode(icon($r['message'])))); ?></td>
</tr>			
</table>

</div>
 <?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>