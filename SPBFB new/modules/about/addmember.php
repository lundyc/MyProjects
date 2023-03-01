<style>
#resetemail {
text-decoration: underline; 
}

#resetemail:hover {
	cursor: pointer;
	color: #5F6069;
}
</style>
<div class="module"><div class="mb" id='news'>
<h2>Add Member
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
</h2>	

<?PHP
$check = 0;
$error = '';
if ($_POST['action'] == "addmember") {
require 'lib/password.php';

if (empty($_POST['profile']['realname'])) {
	$check = 1;
	$error .= "<b>Error:</b> Please enter their Real Name<br>";
}

if (empty($_POST['members']['email'])) {
	$check = 1;
	$error .= "<b>Error:</b> Please enter their E-Mail address<br>";
}

if (empty($_POST['members']['password'])) {
	$check = 1;
	$error .= "<b>Error:</b> Please enter their password<br>";
}

if (empty($_POST['members']['section2'])) {
	$check = 1;
	$error .= "<b>Error:</b> Please select what section they play in.<br>";
}

if (empty($_POST['members']['rank2'])) {
	$check = 1;
	$error .= "<b>Error:</b> Please select their position in the band.<br>";
}

if ($check == 0) {

$names = '';
$values = '';

$_POST['members']['email'] = strtolower($_POST['members']['email']);
$_POST['members']['password'] = password_hash($_POST['members']['password'], PASSWORD_BCRYPT);

while (list($settingname, $settingvalue) = each($_POST['members'])) {
$names .= "`". $settingname."`, ";
$values .= "'".$settingvalue."', ";
}

$names = substr($names,0,strlen($names) - 2);
$values = substr($values,0,strlen($values) - 2);

$names2 = '';
$values2 = '';
while (list($settingname2, $settingvalue2) = each($_POST['profile'])) {
$names2 .= "`". $settingname2."`, ";
$values2 .= "'".$settingvalue2."', ";
}

$names2 = substr($names2,0,strlen($names2) - 2);
$values2 = substr($values2,0,strlen($values2) - 2);

$mysqli->query("INSERT INTO `members` ($names) VALUES ($values)");
$mysqli->query("INSERT INTO `profile` ($names2) VALUES ($values2)");

//echo '<div style="border: 1px solid #B3B5B5; background-color: #E9E3D1; padding: 3px; margin: 3px;">';
	echo "<b>Congrats:</b> Member has been added.</p>";
//echo '</div>';
		?>
		<script>
	window.setTimeout(function() {
    window.location.href = '/about?InfoID=5';
}, 2000);
 </script>
<?PHP
}

} else {

if ($check == 1) {

if (isset($error)) {
	echo '<div style="border: 1px solid red; background-color: pink; padding: 3px; margin: 3px;">'.$error.'</div>';
}

}
?>

<body onLoad="setup2('<?php echo $r['section2']; ?>')">
<SCRIPT TYPE="TEXT/JAVASCRIPT">
function setup2(ans) {
lit = '<table width="100%"><tr>'

if (ans == '7' || ans == '3' || ans == '2' || ans == '6' || ans == '1') {
<?php
$q = $mysqli->query("SELECT `statusid`, `statusname` FROM `memberstatus` WHERE `statusid` = '8' OR `statusid` = '9' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = $q->fetch_assoc()) {

$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><label><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></label></td>'

<?php
}
?>		
}
  
if (ans == '4') {
// side drum
<?php
$q = $mysqli->query("SELECT `statusid`, `statusname` FROM `memberstatus` WHERE `statusid` = '6' OR `statusid` = '7' OR `statusid` = '9' OR `statusid` = '8' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = $q->fetch_array()) {


$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><label><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></label></td>'

	<?php
	}
	?>		

  }
  
  if (ans == '5') {
  // flute
<?php
$q = $mysqli->query("SELECT `statusid`, `statusname` FROM `memberstatus` WHERE `statusid` = '1' OR `statusid` = '2' OR `statusid` = '9' OR `statusid` = '8' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = $q->fetch_array()) {

$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><label><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></label></td>'

	<?php
	}
	?>		

  }

  lit = lit + '</tr></table>'
  document.getElementById('rep2').innerHTML=lit
}
</script>


<form method="post" name="quest" action="/about?action=addmember">
<input type="hidden" name="action" value="addmember">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>

<tr>
<td width='40%' class='tablerow1'>Real Name</td>
<td width='60%' class='tablerow2'>
<input type='text' id="realname" name='profile[realname]' value="<?php echo $_POST['profile']['realname']; ?>" size='30' class='textinput'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Nick Name</td>
<td width='60%' class='tablerow2'>
<input type='text' name='profile[nickname]' value="<?php echo $_POST['profile']['nickname']; ?>" size='30' class='textinput'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Email Address</td>
<td width='60%' class='tablerow2'><input type='text' id="email" name='members[email]' value="<?php echo $_POST['members']['email']; ?>" size='30' class='textinput'>

<span id="resetemail" />No Email</span>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Phone Number
<div style='color:gray'>Phone number will <strong>ONLY</strong> display to Band Members.</div></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[phone_number]' value="<?php echo $_POST['profile']['phone_number']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Password </td>
<td width='60%' class='tablerow2'><input type='text' name='members[password]' value="<?php echo $_POST['members']['password']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Administrator: </td>
<td width='60%' class='tablerow2'>
<input style="border: 0px; background:none;" type='checkbox' name='members[admin]' value='1'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Date of Birth</td>
<td width='60%' class='tablerow2'>
<select name="profile[bday_day]" class="shoutbox">
<?php
echo "<option value='0'>--</option>\n";

for($day2=1; $day2<32; $day2++){
echo '<option value="'.$day2.'" />' . $day2 . '</option>';
} 
?>
  </select>
/

<select name="profile[bday_month]" class="shoutbox">
<?php
$months = array(null, 'January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); 
unset($months[0]); 

echo "<option value='0'>--</option>\n";

foreach($months as $key => $month){ 
echo '<option value="'.$key.'" ';
echo ' >'. $month . '</option>';
} 

?>
</select>
/
<select name="profile[bday_year]" class="shoutbox">
<?php
if ($p['bday_year'] == 0) 
echo "<option value='0'>----</option>\n";

for($year2=1930; $year2<date("Y"); $year2++){
echo '<option value="'.$year2.'" ';
echo " />" . $year2 . "</option>\n";
} 
?>
</select></td>
</tr>

</table>
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow4' colspan="3"><strong>Playing Position</strong></td>
</tr>


<tr>
<td colspan="3" class='tablerow2'>
<table width="100%" cellpadding="2" cellspacing="1" border="0">
<tr>
<?php
$q = $mysqli->query("SELECT `roleID`, `name`, `displayID` FROM `role` ORDER BY displayID");
while ($role = $q->fetch_array()) {
echo '<td>';
echo '<label><img src="images/'.$role['roleID'].'.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>';
echo '<input onclick="setup2('.$role['roleID'].');" type="radio" name="members[section2]" value="'.$role['roleID'].'" ';
echo '> ' .$role['name'];
echo '</label></td>';
}
?>
</tr>

<tr>
<td>

</td>
</tr>
</table>
<SPAN ID="rep2"></SPAN></td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='3' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td>
</tr>
</table>

</td>
</tr>

</table>
<script type="text/javascript">
$(document).ready(function() {
	$( "#resetemail" ).click(function() {
		var realname = $('#realname').val();
		
		if (realname == '') {
			alert("Please enter their Real Name");
		} else {
			var name = realname.replace(/\s/, '');
			button1 = document.getElementById("email");
			button1.value = name + '@noemail.com';
		}
	});

});
</script>
<?php
}
?>
</div>
</div>
