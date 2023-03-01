<?php
if (!$_SESSION['uid']) {
die(redirect("index.php",0));
}
?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>My Uploaded Pictures</h2>
      
      
      <div style="text-align: center">You have no uploaded any pictures yet.     
      </div>
      
      
<table width='100%' cellspacing='2' cellpadding='2'>
<tr>
<td width="23%" align="center" valign="middle">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" />
</td>
<td width="23%" align="center" valign="middle">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" />
</td>
<td width="23%" align="center" valign="middle">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" />
</td>
<td width="23%" align="center" valign="middle">
<img src="<?php echo $picture; ?>" width="90" height="90" border="0" style="border: 1px solid black;" />
</td>
</tr>
</table>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>