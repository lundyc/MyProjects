<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}
mysql_query("UPDATE `msgs` SET status='read' WHERE `parent`='".$_GET['id']."' AND `to`='".$_SESSION['uid']."'");

function clickable($url){
        $in=array(
        '`((?:https?|ftp)://\S+[[:alnum:]]/?)`si',
        '`((?<!//)(www\.\S+[[:alnum:]]/?))`si'
        );
        $out=array(
        '<a href="$1"  rel="nofollow" target="_blank">(LINK)</a> ',
        '<a href="http://$1" rel=\'nofollow\' target="_blank">(LINK)</a>'
        );
        return preg_replace($in,$out,$url);
}

$query1 = mysql_query("SELECT * FROM `msgs` WHERE `parent`='".$_GET['id']."'");
$t = mysql_fetch_array($query1);
?>
<script src="scripts/jquery/reply.js" type="text/javascript"></script>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Personal Message </h2>

<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td width="81" align="center">
<a href="./?view=inbox&delete=<?php echo $_GET['id']; ?>"><img src="themes/spbfb/images/inbox/delete.jpg" border="0" /><br />
  Delete</a></td>
    <td width="901" align="center"><big style='text-align: center; font-weight:800;'><?php echo $t['subject']; ?></big><br />
Between <?php echo idtoname($t['from']); ?> and <?php echo idtoname($t['to']); ?>
</td>
</tr>
</table>



<?php
$sendto_ID = ($_SESSION['uid'] == $t['from']) ? $t['to'] : $t['from'];

?>
<form method="POST">
<input type="hidden" id="senditto_hidden" name="senditto_hidden" value="<?php echo $sendto_ID; ?>">
<input type="hidden" id="msgid_hidden" name="msgid_hidden" value="<?php echo $_GET['id']; ?>">
<input type="hidden" id="subject_hidden" name="subject_hidden"  value="<?php echo (substr($t['subject'],0,3) != "RE:") ? "RE: ". $t['subject'] : $r['subject']; ?>"/>

<table width="100%" border="0"  cellpadding="5" cellspacing="2">
<tr>
<td colspan="2"><textarea id="msg_content" name="content" cols="60" rows="10" style="width: 99%; overflow:auto;"></textarea> </td>
</tr>

<tr>
<td colspan="2">
<input class='button' type="submit" name="submit" value="Send Message" tabindex="10" accesskey="s" id="submit_btn" /></td>
</tr>
</table>
</form>


<div id="new_msg"></div>
<?php
$query = mysql_query("SELECT * FROM `msgs` WHERE `parent`='".$_GET['id']."' ORDER BY `id` DESC");
while($r[$k] = mysql_fetch_object($query)){
$dateformat = date("d-m-y", $r[$k]->date);

if ($dateformat == date("d-m-y")) {
$date = "Today, ". date("g:i A", $r[$k]->date); 
} elseif ($dateformat == date("d-m-y", strtotime("-1 day"))) {
$date = "Yesterday, ". date("g:i A", $r[$k]->date); 
} else {
$date = date("M j Y, g:i A");
}
?>
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<TR>
<td style="width: 15%; vertical-align:top;">
<?php
echo ($r[$k]->from == 0) ? "<i>SPB Webmaster</i>" : "<a href='./?view=profile&id=".$r[$k]->from."'>".IDtoName($r[$k]->from)."</a>";
?>
<br />
<span style="font-size: 10px; color:#999999;"><?php echo $date; ?></span>
</td>

<td style="width: 85%; vertical-align:top; border-bottom: 1px solid #999999;">
<?php 
echo nl2br(wordwrap(clickable($r[$k]->content), 75, "\n", true)); ?></td>
</TR>
</table>

<?php
$k++;
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>


<?php
/*
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">

<tr>
<td width="21%">
<b>Title</b></td>
<td width="79%" >
<?php echo $r['subject']; ?></td>
</tr>


<tr>
<td width="21%"  >
<b>Sent</b></td>
<td width="79%" >
<?php echo $date; ?></td>
</tr>

<tr>
<td width="21%"  >
<b>Sender</b></td>
<td width="79%" >
<?php
if ($r['from'] == 0) {
echo "<i>SPB Webmaster</i>";
} else {
?>

<a href='./?view=profile&id=<?php echo $r['from']; ?>'><?php echo IDtoName($r['from']); ?></a>
<?php
}
?></td>
</tr>

<tr>
<td width="79%" colspan="2" >
<?php echo nl2br(wordwrap($r['content'], 75, "\n", true)); ?></td>
</tr>

</table>
*/
?>