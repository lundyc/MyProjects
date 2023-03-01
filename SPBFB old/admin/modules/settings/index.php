<?php
$ergebnis = safe_query("SELECT * FROM settings");
$ds	= mysql_fetch_array($ergebnis);
?>

<div class='homepage_pane_border'>
<div class='homepage_section'>System Settings</div>

<table width="100%">
<tr>
<td><strong>Site Title</strong></td>
<td><input type="text" name="title" id="title" value="<?php echo $ds['title']; ?>" style="width: 75%;" /></td>
</tr>

<tr>
<td><strong>Site Version</strong></td>
<td><input type="text" name="version" value="<?php echo $ds['version']; ?>" style="width: 10%;"/></td>
</tr>

<tr>
<td><strong>Debugging Mode</strong></td>
<td>
On <input style="background:none; border:0;" type="radio" name="debug" value="ON" <?php if ($ds['debug'] == "ON") { echo "checked"; }?> /> 
Off <input style="background:none; border:0;" type="radio" name="debug" value="OFF" <?php if ($ds['debug'] == "OFF") { echo "checked"; }?> /> 
  </td>
</tr>

<tr>
<td><strong>Site Closed</strong></td>
<td>
Yes <input style="background:none; border:0;" type="radio" name="closed" value="1" <?php if ($ds['closed'] == 1) { echo "checked"; }?> /> 
No <input style="background:none; border:0;" type="radio" name="closed" value="0" <?php if ($ds['closed'] == 0) { echo "checked"; }?> /> 
</td>
</tr>
</table>


</div>
