<?PHP
$query = mysql_query("SELECT * FROM `memberstatus` ORDER BY displayorder");
while ($g = mysql_fetch_array($query)) {

$query2 = mysql_query("SELECT * FROM `members` WHERE `status` = '".$g['statusid']."' ORDER BY `id` ASC, `group` DESC");
$rows = mysql_num_rows($query2);
if ($rows > 0) {

?>

<div class='tableheaderalt'><?php echo $g['statusname']; ?></div>

<table cellpadding='4' cellspacing='0' width='100%'>
 <tr>
  <td width='35%' class='tablesubheader'>Username</td>
  <td class='tablesubheader'>Position</td>
 </tr>
 <?php

 while ($r = mysql_fetch_array($query2)) {
$p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$r['id']."'"));
 
$group = array('1', '2', '3');
$class = "tablerow";
$class2 = "tablerow1";

?>
 
 
<tr>
<td class='<?php echo $class . $r['group']; ?>'>
<strong><?php echo $p['realname'] . " (". $r['username'].")"; ?></strong>
</td>
<td class='<?php echo $class . $r['group']; ?>'>
<?php echo (empty($r['customstatus'])) ? '---' : $r['customstatus']; ?></td>
</tr>
<?php
}
?>

  
 </table>
 <br />

 <?php
 }
 
 }
 ?>