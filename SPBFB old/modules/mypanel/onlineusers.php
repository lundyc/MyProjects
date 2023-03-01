 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Online Users </h2>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2" bordercolor="#E1E1E1" class="mainpanel">

<?php
$columns = "4";
$rows = "0";

$ergebnis=mysql_query("SELECT * FROM `online_users` WHERE `userID` > 0 ORDER BY userID");
while ($ds=mysql_fetch_array($ergebnis)) {

$p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$ds['userID']."'"));

($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}

$picture = ((strlen($p['picture']) > 0) || (!file_exists("uploads/profiles/" . $p['picture']))) ? "uploads/profiles/" . $p['picture'] : "uploads/profiles/default.jpg";
$i++;
?>
<td align="center" bgcolor="#ffffff" style="border-collapse: collapse; border: 1px solid #808080" valign="top">
<a href="./?view=mypanel&action=profile&id=<?php echo $ds['userID']; ?>">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" /></a>
<br />
<?php 
echo (isonline($ds['userID']) == "offline") ? '<img src="images/misc/offline.png" alt="User Offline">' : '<img src="images/misc/online.png" alt="User Online">';
echo " " . $p['realname'];
//echo $r['customstatus'];	-- Leading Tip, Second ......
echo (CustomStatus($r['customstatus'])) ? "<br />".CustomStatus($r['customstatus']) : '';
?>
</td>
<?php
}
unset($i);
?>

</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>