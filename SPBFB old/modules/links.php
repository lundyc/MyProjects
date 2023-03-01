<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="listing2_header">
<span class="style5">Band </span><span class="style6">Links</span>
</td>
</tr>
</table>
<br />

<table width="100%">
<tr>
<td width="33%" valign="top">
<table width="100%" cellpadding="5" cellspacing="0" style="border: 1px solid #7d91d0; border-bottom: 0px">
<tr>
<td width="33%" align="center" background="images/content/buttonBck.jpg" style="border-bottom: 1px solid #7d91d0">
<strong>Ulster Bands </strong>
</td>
</tr>
<?php
$query = mysql_query("SELECT * FROM `links` WHERE `location`='ulster' ORDER BY name ASC");
while ($u = mysql_fetch_array($query)) {
?>	
<tr>
<td style=\"border-bottom: 1px solid #7d91d0\">
<a href="http://<?php echo $u['url']; ?>" target="_blank"><B><?php echo $u['name']; ?></B><a>
</td>
</tr>
<?php
}
?>
</table>

</td>
<td width="33%" valign="top">
<table width="100%" cellpadding="5" cellspacing="0" style="border: 1px solid #7d91d0; border-bottom: 0px">
<tr>
<td width="33%" align="center" background="images/content/buttonBck.jpg" style="border-bottom: 1px solid #7d91d0">
<strong>English Bands </strong>
</td>
</tr>
<?php
$query = mysql_query("SELECT * FROM `links` WHERE `location`='england' ORDER BY name ASC");
while ($u = mysql_fetch_array($query)) {
?>	
<tr>
<td style=\"border-bottom: 1px solid #7d91d0\">
<a href="http://<?php echo $u['url']; ?>" target="_blank"><B><?php echo $u['name']; ?></B><a>
</td>
</tr>
<?php
}
?>
</table>

</td>
<td width="33%" valign="top">
<table width="100%" cellpadding="5" cellspacing="0" style="border: 1px solid #7d91d0; border-bottom: 0px">
<tr>
<td width="33%" align="center" background="images/content/buttonBck.jpg" style="border-bottom: 1px solid #7d91d0">
<strong>Scottish Bands </strong>
</td>
</tr>
<?php
$query = mysql_query("SELECT * FROM `links` WHERE `location`='scotland' ORDER BY name ASC");
while ($u = mysql_fetch_array($query)) {
?>	
<tr>
<td style=\"border-bottom: 1px solid #7d91d0\">
<a href="http://<?php echo $u['url']; ?>" target="_blank"><B><?php echo $u['name']; ?></B><a>
</td>
</tr>
<?php
}
?>
</table>
</td>
</tr>
</table>