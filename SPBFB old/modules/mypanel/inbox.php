<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}

/* 	This one is for if they POST there delete's */
if ($_POST['submit'] == "delete") {
$messageID = $_POST['messageID'];

foreach($messageID as $id) {
mysql_query("DELETE FROM `msgs` WHERE `parent` = '".$id."';");
}

}

if (isset($_GET['delete'])) {
mysql_query("DELETE FROM `msgs` WHERE `parent` = '".$_GET['delete']."'");
}
?>
<style type="text/css">
<!--
.style1 {color: #575451}
-->
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Inbox </h2>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function select(a) {    
var theForm = document.myForm;    

for (i=0; i<theForm.elements.length; i++) {       
if (theForm.elements[i].name=='messageID[]')            
theForm.elements[i].checked = a;    
}
}
 
// End -->
</script> 



<?php
$msgs = mysql_query("SELECT * FROM `msgs` WHERE `to`='".$_SESSION['uid']."' ORDER BY id DESC");
$rows = mysql_num_rows($msgs);
$width = (int) $rows / 100 * 220;
?>
<form action="" id="myForm" name="myform" method="post">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">
<tr>
<td valign="middle" bgcolor="#D5E2F0">
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
<img src="images/inbox/nav_m_dark.gif" border="0" /> <strong><a href="./?view=mypanel&action=sendmessage">Compose New Message</a></strong>

<br />

<img src="images/inbox/nav_m_dark.gif" border="0" /> <a href="javascript:select(1)">Check All</a><br />
<img src="images/inbox/nav_m_dark.gif" border="0" /> <a href="javascript:select(0)">Uncheck All</a>

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



<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" align="left" style="padding-left: 16px;">
 <input type="submit" class='button' name="submit" value="delete" />

</td>
</tr>	
<?php
$msgs1 = mysql_query("SELECT * FROM (SELECT MAX( id ) AS id FROM msgs WHERE `to` = '{$_SESSION['uid']}' GROUP BY parent ) AS r JOIN `msgs` USING(id)");
while ($r = mysql_fetch_array($msgs1)) {

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
<td width="9%" align="left">
<img src='images/inbox/<?php echo $r['status']; ?>.png' border='0'  alt='<?php echo ($r['status'] == "read") ? "Message Opened" : "Message Not Opened"; ?>' /> <input class="input" type="checkbox" name="messageID[]" value="<?php echo $r['parent']; ?>"></td>
<td width="44%">
<?php
if ($r['from'] == 0) {
echo "<i>SPB Welcome Message</i>";
} else {
?>

<a href='./?view=mypanel&action=profile&id=<?php echo $r['from']; ?>'><?php echo IDtoName($r['from']); ?></a><br />
<?php 
echo $date; 
}
?></td>
<td width="47%">
<a href="./?view=mypanel&action=viewmsg&id=<?php echo $r['parent']; ?>"><?php echo (empty($r['subject'])) ? 'No Subject' : $r['subject']; ?></a>
<br />
<?php 
if (strlen($r['content']) > 30) { 
echo substr_replace($r['content'], '..', 30); 
} else {
echo $r['content']; 
}
?></td>
</tr>
<?php
}

if ($rows > 0) {
?>

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