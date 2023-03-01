<?php
if (isset($_POST['a']) && $_POST['a'] == "doadd") {
$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['name'])) {
$_SESSION['error'] .= "<li>Please enter a Title</li>\n";
$error = 1;
}

if ($error == 0) {

$updatestring = '';
$updatestring2 = '';

while (list($settingname, $settingvalue) = each($_POST)) {
if ($settingname != "a") {
$updatestring .= "`".$settingname."` = '".$settingvalue."', ";
}
}



$updatestring = substr($updatestring,0,strlen($updatestring) - 2);

//echo "UPDATE `permissions` SET $updatestring WHERE pid =".$_GET['id']." LIMIT 1 ;";
mysql_query("UPDATE `permissions` SET $updatestring WHERE pid =".$_GET['id']." LIMIT 1 ;");

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
The permissons have been updated.
 </p>
</div>
<br>
<?php
unset($_SESSION['error']);
redirect("index.php?manager=members&action=groups", 5);

} else {
?>
<div class='information-box'>
 <img src='http://www.spb-fb.co.uk/forum/skin_acp/IPB2_Standard/images/global-infoicon.gif' alt='information' />
 <h2>Administrator Error Message</h2>
 <p>
 	<br />
There was a error with your form submission. Please check the following errors.<br>
<br>
<?php echo $_SESSION['error'];?>
 </p>
</div>
<br>
<?php
}

} else {
?>

<div class='tableheaderalt'>User Group Management</div>


<form method="post" name="edit" action="">
<input type="hidden" name="a" value="doadd">
<table width='100%' cellpadding='4' cellspacing='0'>
<?php
$query = mysql_query("SELECT * FROM `permissions` WHERE `pid` = '".$_GET['id']."'");
$a = mysql_fetch_array($query);
foreach ($a as $key => $value) {
if (!is_numeric($key)) {

if ($key == "pid") {
continue;
}

$key2 = str_replace(array("can","view", "admin", "edit", "delete", "add", "move", "permission", "cat"), array("can ", "view ", "admin panel ", "edit ", "delete ", "add ", "move ", " permission ", " category "), $key);

echo 	"<tr>\n";
echo 	"<td class='tablerow1'>".ucwords($key2)."</td>\n";
echo "<td class='tablerow2'>\n";
if ($key == "name") {
echo "<input type='text' name='name' size='30' class='textinput' style=\"width: 85%\" value=\"".$value."\">";
} else {
$selectedNO = ($value == 0) ? "selected" : '';
$selectedYes = ($value == 1) ? "selected" : '';


echo "<select name=\"".$key."\">\n";
echo '<option value="0" '.$selectedNO.'>No</option>';
echo '<option value="1" '.$selectedYes.'>Yes</option>';
echo "</select>";
}

echo "</td>\n";
echo "<tr>\n";
}
}
?>


<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'>
</td>
</tr>
</table>
</form>
    
    <?php
	}
	?>