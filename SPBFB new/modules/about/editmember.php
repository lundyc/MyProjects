<?PHP
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {

$check = 0;
if ($_POST['action'] == "doeditmember") {

if (empty($_POST['profile']['realname'])) {
	$check = 1;
	$error = "Please enter their Real Name";
}

if (empty($_POST['members']['email'])) {
	$check = 1;
	$error = "Please enter their E-Mail address";
}

if ($check == 0) {

if ((isset($_POST['remove_photo'])) && ($_POST['profile']['picture'] != "default.jpg")) {

		$oldpicture = "userfiles/profiles/". $_POST['profile']['picture'];
		$oldthumb = "userfiles/profiles/thumbs/". $_POST['profile']['picture'];
	
		if (file_exists($oldpicture)) {
			@unlink($oldpicture);
			@unlink($oldthumb);
		}	
		
		$_POST['profile']['picture'] = "default.jpg";
	} 

$updatestring = '';
$updatestring2 = '';

while (list($settingname, $settingvalue) = each($_POST['members'])) {
$updatestring .= "`".$settingname."` = '".$settingvalue."', ";
}

while (list($settingname2, $settingvalue2) = each($_POST['profile'])) {
$updatestring2 .= $settingname2."='".$settingvalue2."',";
}

$updatestring = substr($updatestring,0,strlen($updatestring) - 2);
$updatestring2 = substr($updatestring2,0,strlen($updatestring2) - 1);

$mysqli->query("UPDATE `members` SET $updatestring WHERE id =".$_GET['memberID']." LIMIT 1 ;");
$mysqli->query("UPDATE `profile` SET $updatestring2 WHERE `mid` =".$_GET['memberID']." LIMIT 1 ;");

?><script>
	window.setTimeout(function() {
    window.location.href = '/about?InfoID=5';
}, 200);
 </script>
<?php
}

}


$query = $mysqli->query("SELECT `id`, `email`, `admin`, `section2`, `rank2` FROM `members` WHERE `id` = '".$_GET['memberID']."';");
$r = $query->fetch_assoc();

$query2 = $mysqli->query("SELECT `realname`, `nickname`, `picture`, `bday_day`, `bday_month`, `bday_year`, `phone_number` FROM `profile` WHERE `mid` = '".$_GET['memberID']."';");
$p = $query2->fetch_assoc();
?>
<style>
#resetemail {
text-decoration: underline; 
}

#resetemail:hover {
	cursor: pointer;
	color: #5F6069;
}
</style>
<div class="module">
<div class="mb" id='news'>
<h2>Edit Member
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
</h2>

<?php
if ($check == 1) {

if (isset($error)) {
	echo '<div style="border: 1px solid red; background-color: pink; padding: 3px; margin: 3px;"><b>Error:</b> '.$error.'</div>';
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
$selected = ($z['statusid'] == $r['rank2']) ? "checked" : '';

$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input <?php echo $selected; ?> type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></td>'

<?php
}
?>		
}
  
if (ans == '4') {
// side drum
<?php
$q = $mysqli->query("SELECT * FROM `memberstatus` WHERE `statusid` = '6' OR `statusid` = '7' OR `statusid` = '9' OR `statusid` = '8' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = $q->fetch_array()) {
$selected = ($z['statusid'] == $r['rank2']) ? "checked" : '';

$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input <?php echo $selected; ?> type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></td>'

	<?php
	}
	?>		

  }
  
  if (ans == '5') {
  // flute
<?php
$q = $mysqli->query("SELECT * FROM `memberstatus` WHERE `statusid` = '1' OR `statusid` = '2' OR `statusid` = '9' OR `statusid` = '8' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = $q->fetch_array()) {
$selected = ($z['statusid'] == $r['rank2']) ? "checked" : '';

$z['statusname'] = ($z['statusid'] == 8) ? 'Normal Member' : $z['statusname'];
?>	
lit = lit + '<td align="center"><img src="images/control/user.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>'
lit = lit + '<input <?php echo $selected; ?> type="radio" name="members[rank2]" value="<?php echo $z['statusid']; ?>"> <?php echo $z['statusname']; ?></td>'

	<?php
	}
	?>		

  }

  lit = lit + '</tr></table>'
  document.getElementById('rep2').innerHTML=lit
}

var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable=0'
win = window.open(mypage,myname,settings)
}

</script>


<form method="post" name="quest" action="/about?action=edit&memberID=<?php echo $_GET['memberID']; ?>">
<input type="hidden" name="action" value="doeditmember">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>

<tr>
<td width='1%' class='tablerow1' valign="top" rowspan="8">
<div style='border:1px solid #000;background:#FFF;width:150px; padding:5px'>
 <?php
if (strlen($p['picture']) > 0) {
echo '<img src="userfiles/profiles/';
echo (file_exists("userfiles/profiles/".$p['picture'])) ? $p['picture'] : "default.jpg";
echo '" width="150" height="150" />';
}
?>
</div>
<div style='color:gray'><input style="border: 0px; background:none;" type='checkbox' name='remove_photo' value='1' > tick box to remove picture</div>
<input type='hidden' name='profile[picture]' value="<?php echo $p['picture']; ?>"></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Real Name</td>
<td width='60%' class='tablerow2'>
<input type='text' name='profile[realname]' value="<?php echo $p['realname']; ?>" size='30' class='textinput'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Nick Name</td>
<td width='60%' class='tablerow2'>
<input type='text' name='profile[nickname]' value="<?php echo $p['nickname']; ?>" size='30' class='textinput'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Email Address</td>
<td width='60%' class='tablerow2'><input type='text' id="email" name='members[email]' value="<?php echo $r['email']; ?>" size='30' class='textinput'>

<span id="resetemail"  />Reset</span>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Phone Number
<div style='color:gray'>Phone number will <strong>ONLY</strong> display to Band Members.</div></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[phone_number]' value="<?php echo $p['phone_number']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Password </td>
<td width='60%' class='tablerow2'>
<a href="modules/about/password.php?id=<?php echo $r['id']; ?>" onClick="NewWindow(this.href,'password','400','300','yes');return false">Change Password</a></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Administrator: </td>
<td width='60%' class='tablerow2'>
<input style="border: 0px; background:none;" type='checkbox' name='members[admin]' value='1' <?php echo ($r['admin'] == 1) ? 'checked' : ''; ?> >
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Date of Birth</td>
<td width='60%' class='tablerow2'>
<select name="profile[bday_day]" class="shoutbox">
<?php
if ($p['bday_day'] == 0) {
echo "<option value='0'>--</option>\n";
} 

for($day2=1; $day2<32; $day2++){
echo '<option value="'.$day2.'" ';
echo ($day2 == $p['bday_day']) ? 'selected="selected"' : '';
echo " />" . $day2 . "</option>\n";
} 
?>
  </select>
/

<select name="profile[bday_month]" class="shoutbox">
<?php
$months = array(null, 'January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); 
unset($months[0]); 

if ($p['bday_month'] == 0) 
echo "<option value='0'>--</option>\n";


foreach($months as $key => $month){ 
echo '<option value="'.$key.'" ';
echo ($key == $p['bday_month']) ? 'selected="selected" ' : '';
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
echo ($year2 == $p['bday_year']) ? 'selected="selected"' : '';
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
echo '<img src="images/'.$role['roleID'].'.png" border="0" width="50" height="50" style="display: block; margin-left: auto;  margin-right: auto"/>';
echo '<input onclick="setup2('.$role['roleID'].');" type="radio" name="members[section2]" value="'.$role['roleID'].'" ';
echo ($role['roleID'] == $r['section2']) ? 'checked' : '';
echo '> ' .$role['name'];
echo '</td>';
}
?>
</tr>

<tr>
<td>

</td>
</tr>
</table>


<?php


$selected = ($role['roleID'] == $r['section2']) ? 'selected' : '';

?>	
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

<?php
$na = explode(' ', $p['realname']);
$email = strtolower($na['0']) ."@". strtolower($na['1']).".com";
?>
<script type="text/javascript">
$(document).ready(function() {
		$( "#resetemail" ).click(function() {
			button1 = document.getElementById("email");
			button1.value = '<?php echo $email; ?>';
		});

	
});
</script>

</div>
</div>
<?php
}
}
?>