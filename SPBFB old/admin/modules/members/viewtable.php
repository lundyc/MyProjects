<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {color: #33CC33}
-->
</style>
<h2>Admin Levels</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#F0F0F0">&nbsp;</td>
    <td align="center" bgcolor="#F0F0F0"><strong>Band Member (1)</strong></td>
    <td align="center" bgcolor="#F0F0F0"><strong>Band Committee (2)</strong></td>
    <td align="center" bgcolor="#F0F0F0"><strong>Administrator (3)</strong></td>
    <td align="center" bgcolor="#F0F0F0"><strong>Root Admin (4)</strong></td>
    <td align="center" bgcolor="#F0F0F0"><strong>Webmaster (5)</strong></td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>News Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style2">Yes</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>Parades Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style2">Yes</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>Gallery Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style2">Yes</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>Media Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style2">Yes</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>Guestbook Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  <tr>
    <td bgcolor="#F0F0F0"><strong>Information Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
    <tr>
    <td bgcolor="#F0F0F0"><strong>Members Admin</strong></td>
    <td align="center" bgcolor="#F0F0F0"><span class="style1">No</span></td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style1">No</td>
    <td align="center" bgcolor="#F0F0F0" class="style2">Yes</td>
  </tr>
  
</table>



<?PHP
/*
include("../../_mysql.php");
mysql_connect($host, $user, $pwd) or system_error('ERROR: Can not connect to MySQL-Server');
mysql_select_db($db) or system_error('ERROR: Can not connect to database "'.$db.'"');

$query = mysql_query("SELECT * FROM `permissions`");
$a = mysql_fetch_array($query);
?><style type="text/css">
<!--
body,td,th {
	color: #000000;
}
body {
	background-color: #EAEAEA;
}
.access {
padding-left: 4px;
background-color:#FFCC99;
}

.td {
padding: 2px;
}

.values {
background-color: #FFFFCC;
text-align:center;
}
-->
</style>

<h1>Access Groups</h1>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top">
<table width="100%" border="0" cellpadding="2" cellspacing="2" class="td">
<?php
foreach ($a as $key => $value) {
if (!is_numeric($key)) {

$key = str_replace(array("can","view", "admin", "edit", "delete", "add", "move", "permission", "cat"), array("can ", "view ", "admin panel ", "edit ", "delete ", "add ", "move ", " permission ", " category "), $key);

echo 	"<tr>\n"
		."<td class='access'>".ucwords($key)."</td>\n"
		."</tr>\n";
}
}
?>
</table>

</td>

<?php
$q = mysql_query("SELECT * FROM `permissions` ORDER BY pid ASC");
while ($r = mysql_fetch_array($q)) {
?>
<td valign="top">
<table width="100%" border="0" cellpadding="2" cellspacing="2" class="td">
<?php
foreach ($r as $key2 => $value2) {
if (!is_numeric($key2)) {

if ($key2 != "pid") {
$value2 = str_replace(array("0", "1"), array("No","Yes"), $value2);
}

echo 	"<tr>\n"
		."<td class='values'>".$value2."</td>\n"
		."</tr>\n";
}
}
?>
</table></td>
<?php
}
?>
</tr>

</table>
  */
  ?>  