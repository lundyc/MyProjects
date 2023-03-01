 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Browse Members</h2>

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
//-->
</script>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td class='subtitle' onclick="javascript:ReverseDisplay('officers')" onmouseover="style.cursor='pointer'">
Office-Bearers
  </td>
</tr>

<tr>
<td style="padding: 0px; margin: 0px; display: block" id="officers" >

<table width="100%" cellpadding="0" cellspacing="0">

<?php
$officers = mysql_query("SELECT `orderid`, 
`position`, `member_id`,
(SELECT `realname` FROM `profile` WHERE `mid` = `office`.`member_id`) AS `real_name`
FROM `office` ORDER BY `orderid`");
while ($o = mysql_fetch_assoc($officers)) {

echo '<tr>';
echo '<td class="tablerow1"  style="width: 50%;">';
echo '<a href="./?view=mypanel&action=profile&id='. $o['member_id'].'">';
echo $o['real_name'];
echo '</a>';
echo '</td>';
echo '<td class="tablerow1"  style="width: 50%;">';
echo $o['position'];
echo '</td>';
echo '</tr>';
}
?>

</table>
</td>
</tr>

<?php
$query = mysql_query("SELECT * FROM `role` ORDER BY displayID");
while ($r = mysql_fetch_array($query)) {

$q2 = "SELECT
`profile`.`realname`,
`members`.`id`,
`members`.`rank2`,

(SELECT `displayorder` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `display_order`,
(SELECT `statusname` FROM `memberstatus` WHERE `statusid` = `members`.`rank2`) AS `name`

FROM `members`, `profile` WHERE `members`.`section2` = '".$r['roleID']."' AND `members`.`id` = `profile`.`mid` ORDER BY `display_order`, `members`.`id`;";

$query2 = mysql_query($q2);


?>
 <tr>
  <td class='subtitle' onclick="javascript:ReverseDisplay('<?php echo $r['name']; ?>')" onmouseover="style.cursor='pointer'">
  <?php echo $r['name']; ?>
  </td>
</tr>

<tr>
<td style="padding: 0px; margin: 0px; display: block" id="<?php echo $r['name']; ?>" >

<table width="100%" cellpadding="0" cellspacing="0">
<tr>



<?php
for($i = 0; $m = mysql_fetch_array($query2); ++$i) {
	if($i % 2 == 0 && $i != 0)  {
        echo "</tr><tr>";
    }

	$rank = '';
	
	if (strlen($m['name']) > 0 && $m['name'] != "Learner") {
	$rank = '<span style="font-size: 16px;">'. $m['name'] . '</span><br>';
	}
	if ($m['name'] == "Learner") {
	$rank = '<span style="float: left; font-family: arial, Helvetica,sans-serif; color: red; font-weight: bold; font-size: 16px; padding: 2px; margin: 2px; border: 1px solid #CCCCCC">L</span>';
	}
?>

<td class="tablerow1"  style='width: 50%; vertical-align: middle;'>
<?php  
echo $rank; 
echo '<a href="./?view=mypanel&action=profile&id='. $m['id'].'">';
echo $m['realname'];
echo '</a>';
?>
</td>
<?php
}
?>
</tr>
</table>
</td>
</tr>

<?php
}
?>
</table>


  </div>
  <div class="bb"><div><div></div></div></div>
</div>