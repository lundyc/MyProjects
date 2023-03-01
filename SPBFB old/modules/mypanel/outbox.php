<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}

/* 	This one is for if they POST there delete's */
if ($_POST['submit'] == "delete") {
$messageID = $_POST['messageID'];
foreach($messageID as $id) {
mysql_query("DELETE FROM `msgs` WHERE `id`='".$id."' AND `from`='".$_SESSION['uid']."';");
}

}
?>
<div id="listing2_header"><span>Message</span> Outbox</div>

<script type="text/javascript">
function SelectAll() {
	for(var x=0;x<document.form.elements.length;x++) {
		var y=document.form.elements[x];
		if(y.name!='ALL') y.checked=document.form.ALL.checked;
	}
}
</script>

<?php
$msgs = mysql_query("SELECT * FROM `msgs` WHERE `from`='".$_SESSION['uid']."' ORDER BY id DESC");
$rows = mysql_num_rows($msgs);
?>

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

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<th width="5%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080">&nbsp;</th>
<th width="35%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><b>Message Title</b></th>
<th width="30%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><b>To</b></th>
<th width="25%" bgcolor="#F5F5F5" style="border-collapse: collapse; border: 1px solid #808080"><b>Date</b></th>
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
<td align="center" bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<img src='images/inbox/<?php echo $r['status']; ?>.png' border='0'  alt='<?php echo ($r['status'] == "read") ? "Message Opened" : "Message Not Opened"; ?>' /></td>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<?php echo $r['subject']; ?>
</td>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<?php
if ($r['to'] == 0) {
echo "<i>SPB Welcome Message</i>";
} else {
?>

<a href='./?view=profile&id=<?php echo $r['to']; ?>'><?php echo IDtoName($r['to']); ?></a>
<?php
}
?>
</td>
<td bgcolor="#FFFFFF" style="border-collapse: collapse; border: 1px solid #808080">
<?php echo $date; ?></td>
</tr>
<?php
}

if ($rows == 0) {
echo "<tr><td align='center' colspan='5' class='row1'><strong>No messages found</strong></td></tr>";
}
?>
</table>
</form>