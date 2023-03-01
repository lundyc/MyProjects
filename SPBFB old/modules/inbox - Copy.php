<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}

/* 	This one is for if they POST there delete's */
if ($_POST['submit'] == "delete") {
$messageID = $_POST['messageID'];
foreach($messageID as $id) {
mysql_query("DELETE FROM `msgs` WHERE `id`='".$id."' AND `to`='".$_SESSION['uid']."';");
}

}
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Inbox </h2>

<script type="text/javascript">
function SelectAll() {
	for(var x=0;x<document.form.elements.length;x++) {
		var y=document.form.elements[x];
		if(y.name!='ALL') y.checked=document.form.ALL.checked;
	}
}
</script>

<?php
$msgs = mysql_query("SELECT * FROM `msgs` WHERE `to`='".$_SESSION['uid']."' ORDER BY id DESC");
$rows = mysql_num_rows($msgs);
$width = (int) $rows / 100 * 220;
?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td valign="middle" bgcolor="#98BADC">
<table width="100%" cellspacing="1">
<tr>
<td class="style1" colspan="3">Your inbox <?php echo $rows; ?>% full</td>
</tr>
	
<tr>
<td valign="middle" class="row1" colspan="3" nowrap='nowrap'>
<img src='images/inbox/bar_left.gif' border='0'  alt='*' /><img src="images/inbox/bar.gif" width="<?php echo $width; ?>" align="middle" height="11" alt="" /><img src='images/inbox/bar_right.gif' border='0'  alt='*' /></td>
</tr>

<tr>
<td width="33%" valign="middle" class="style1">0%</td>
<td width="33%" align="center" valign="middle" class="style1">50%</td>
<td width="33%" align="right" valign="middle" class="style1">100%</td>
</tr>
</table>
</td>
			

<td align="right" valign="top">
<img src="images/inbox/nav_m_dark.gif" border="0" /> <strong><a href="./?view=sendmessage">Compose New Message</a></strong>
</td>

</tr>
</table>
<br />

<style type="text/css">
.check  {
font-family: "Lucida Sans Unicode"; 
font-size: 18px;
color: #699;
cursor: default;
width: 26px;
text-align: center;
border: 0px;
background:none;
}
</style>

<form action="" name="form" method="post">

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">
<tr>
<th width="5%" bgcolor="#98BADC"><span class="style1"></span></th>
<th width="35%" bgcolor="#98BADC"><span class="style1"><b>Message Title</b></span></th>
<th width="30%" bgcolor="#98BADC"><span class="style1"><b>Sender</b></span></th>
<th width="25%" bgcolor="#98BADC"><span class="style1"><b>Date</b></span></th>
<th align="left" width="5%" bgcolor="#98BADC"><input name="ALL" type="checkbox" class="input " onClick="SelectAll(this.form);" value="ALL"></th>
</tr>
		
<?php
while ($r = mysql_fetch_array($msgs)) {

$dateformat = date("d-m-y", $r['date']);

if ($dateformat == date("d-m-y", mktime(0, 0, 0, date("m")  , date("d"), date("Y")))) {
$date = "Today, ". date("g:i A", $r['date']); 
} elseif ($dateformat == date("d-m-y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")))) {
$date = "Yesterday, ". date("g:i A", $r['date']); 
} else {
$date = date("M j Y, g:i A", $r['date']);
}
?>
<tr id="<?php echo $r['id']; ?>">
<td align="center" bgcolor="#e8f1fa">
<img src='images/inbox/<?php echo $r['status']; ?>.png' border='0'  alt='<?php echo ($r['status'] == "read") ? "Message Opened" : "Message Not Opened"; ?>' /></td>
<td bgcolor="#e8f1fa">
<a href="./?view=viewmsg&id=<?php echo $r['id']; ?>"><?php echo $r['subject']; ?></a></td>
<td bgcolor="#e8f1fa">
<?php
if ($r['from'] == 0) {
echo "<i>SPB Welcome Message</i>";
} else {
?>

<a href='./?view=profile&id=<?php echo $r['from']; ?>'><?php echo IDtoName($r['from']); ?></a>
<?php
}
?></td>
<td bgcolor="#e8f1fa">
<?php echo $date; ?></td>
<td bgcolor="#e8f1fa">
<input class="input" type="checkbox" name="messageID[]" value="<?php echo $r['id']; ?>"> </td>
</tr>
<?php
}

if ($rows > 0) {
?>

<tr>
<td align="right" colspan="5" class="formbuttonrow">
<input type="submit" class='button' name="submit" value="delete" /> the selected messages</td>
</tr>

<?php
} else {
echo "<tr><td align='center' colspan='5' class='row1'><strong>No messages found</strong></td></tr>";
}
?>
</table>
</form>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>