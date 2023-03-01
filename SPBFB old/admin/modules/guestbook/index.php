<?php
if (level($_SESSION['uid']) >= 3) { 
?>

<style>
.reply {
width:100%;
padding: 0px;
margin: 0px;
font-style:italic;
font-weight:bold;
}
</style>

<script language="javascript">
<!--	
function deletepost(id)
{
if (confirm('Are you sure you want to delete this guestbook item?'))
{document.location.href = 'index.php?manager=guestbook&action=delete&id='+id;}
}

function deletereplypost(id)
{
if (confirm('Are you sure you want to delete this guestbook item?'))
{document.location.href = 'index.php?manager=guestbook&action=deletereply&id='+id;}
}

function banuser(ip, id)
{
if (confirm('Are you sure you want to ban this user?'))
{document.location.href = 'index.php?manager=guestbook&action=ban&ip='+ip+'&id='+id;}
}
   
// -->

</script>

<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Guestbook Entries</div>
  </h2>
 <p>
 	<br />
 	You can select to edit or delete information, viewable to the Public.
 	<br />
 	&nbsp; </p>
</div>
<br >

<div class='tableheaderalt'>Guestbook Overview ** New **</div>

<table cellpadding='4' cellspacing='0' width='100%'>
<tr>
<td class='tablesubheader' width='13%'>ID</td>
<td class='tablesubheader' width='13%'>Date / Time</td>
<td class='tablesubheader' width='29%'>Author</td>
<td class='tablesubheader' width='22%'>E-Mail</td>
<td class='tablesubheader' width='23%'>Action</td>
</tr>

<?php
 $query = mysql_query("SELECT `id`, `status`, `date`, `favband`, `location`, `author`, `email`, `ip`, `message` FROM `guestbook` ORDER BY `id` DESC");
 $count = 0;
 
 while (list($id[$count], $status[$count], $date[$count], $favband[$count], $location[$count], $author[$count], $email[$count], $ip[$count], $message[$count]) = mysql_fetch_array($query)) {

	$date[$count] = date("d/m/Y", strtotime($date[$count]));
	$email[$count] = (empty($email[$count])) ? 'N/A' : $email[$count];
	
	$reply_class[$count]   = ($status[$count] == 0) ? 'tablerow1shaded' : 'tablerow1' ;
	$icon[$count] 			= ($status[$count] == 1) ? "red" : "green";
	$title[$count] = ($status[$count] == 1) ? "UN-Accecpt Post" : "Accecpt Post";
	$status[$count] = ($status[$count] == 1) ? "0" : "1";
	
	$reply_label[$count]   = '';
	$count++;
 }
 
 
for($i=0; $i<$count; $i++) {
?>
<tr>
<td class='<?php echo $reply_class[$i]; ?>' width='13%'><?php echo $id[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='13%'><?php echo $date[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='29%'><?php echo $author[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='22%'><?php echo $email[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='23%'>
<a href="./?manager=guestbook&action=status&status=<?php echo $status[$i]; ?>&id=<?php echo $id[$i]; ?>">
<img src='images/flag_<?php echo $icon[$i]; ?>.png' border='0' alt='<?php echo $title[$i]; ?>'/></a>
&nbsp;
<a href="./?manager=guestbook&action=reply&id=<?php echo $id[$i]; ?>"><img src='images/page_go.png' border='0' alt='Reply' width="16" height="16"   /></a> 
<a href="index.php?manager=guestbook&action=edit&id=<?php echo $id[$i]; ?>"><img src='images/page_edit.png' border='0' alt='Edit' width="16" height="16"   /></a> 
<a href="javascript:deletepost('<?php echo $id[$i]; ?>');"><img src='images/page_delete.png' border='0' alt='Delete' width="16" height="16"   /></a> 
</td>
</tr>
<tr>
<td colspan="6" class='<?php echo $reply_class[$i]; ?>'>
<?php 
echo $reply_label[$i];
echo nl2br($message[$i]); 
?>
</td>
</tr>
<?php
$query2 = mysql_query("SELECT * FROM `guestbook_reply` WHERE `replyto` = '".$id[$i]."' ORDER BY id DESC");
if (mysql_num_rows($query2) > 0) { 
$r = mysql_fetch_array($query2);


		if ($id[$i] == $r['replyto']) {
		/*
		id  replyto  date  author  ip  message  
		*/
		
			$id[$i] = $r['id'];
			$replyto[$i] = $r['replyto'];
	
			$date[$i] = date("d/m/Y", strtotime($r['date']));

			$author[$i] = idtoname($r['author']);
			
			$message[$i] = $r['message'];
			$reply_class[$i]   = 'tablerow2highlight';
			$reply_label[$i]   = "<div class='reply'>Reply to comment # {$replyto[$i]}</div>";
		} 
 ?>
<tr>
<td class='<?php echo $reply_class[$i]; ?>' width='13%'><?php echo $id[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='13%'><?php echo $date[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='29%' colspan="2"><?php echo $author[$i]; ?></td>
<td class='<?php echo $reply_class[$i]; ?>' width='23%'><a href="index.php?manager=guestbook&action=edit_reply&id=<?php echo $id[$i]; ?>"><img src='images/page_edit.png' border='0' alt='Edit' width="16" height="16"   /></a> 
<a href="javascript:deletereplypost('<?php echo $id[$i]; ?>');"><img src='images/page_delete.png' border='0' alt='Delete' width="16" height="16"   /></a> </td>
</tr>
<tr>
<td colspan="6" class='<?php echo $reply_class[$i]; ?>'>
<?php 
echo $reply_label[$i];
echo $message[$i]; 
?>
</td>
</tr>


<?php
}

}
?>
</table>







 <?php
} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>