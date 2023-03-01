<?php
if (level($_SESSION['uid']) > 4) {

if (isset($_GET['id'])) {

if (isset($_POST['action']) && $_POST['action'] == "doedit") {

$_SESSION['error'] = '';
$error = 0;

if (empty($_POST['members']['username'])) {
$_SESSION['error'] .= "<li>Please enter a Username</li>\n";
$error = 1;
}

if (empty($_POST['profile']['realname'])) {
$_SESSION['error'] .= "<li>Please enter their Real Name</li>\n";
$error = 1;
}

if (empty($_POST['profile']['nickname'])) {
$_SESSION['error'] .= "<li>Please enter their Nick Name</li>\n";
$error = 1;
}

if (empty($_POST['members']['email'])) {
$_SESSION['error'] .= "<li>Please enter a E-Mail</li>\n";
$error = 1;
}

if ((isset($_POST['remove_photo'])) && ($_POST['profile']['picture'] != "default.jpg")) {

		$oldpicture = "../uploads/profiles/". $_POST['profile']['picture'];
		$oldthumb = "../uploads/profiles/thumbs/". $_POST['profile']['picture'];
	
		if (file_exists($oldpicture)) {
			@unlink($oldpicture);
			@unlink($oldthumb);
		}	
		
		$_POST['profile']['picture'] = "default.jpg";
	} 

if ($error == 0) {

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

mysql_query("UPDATE `members` SET $updatestring WHERE id =".$_GET['id']." LIMIT 1 ;");
mysql_query("UPDATE `profile` SET $updatestring2 WHERE `mid` =".$_GET['id']." LIMIT 1 ;");

if (!empty($_POST['office'])) {
	mysql_query("UPDATE `office` SET  `member_id` =  '".$_GET['id']."' WHERE `officeid` = '".$_POST['office']."';");
}

?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
 	<br />
Your information has been edited.
 </p>
</div>
<br>
<?php
unset($_SESSION['error']);
redirect("index.php?manager=members", 5);

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

$query = mysql_query("SELECT * FROM `members` WHERE id = '".$_GET['id']."' LIMIT 1;");
$r = mysql_fetch_array($query);

if (!$r) {
die("This user isnt here");
}

$p = mysql_fetch_array(mysql_query("SELECT * FROM `profile` WHERE mid = '".$_GET['id']."' LIMIT 1;"));

$picture = ($p['picture'] != "default.jpg") ? "../uploads/profiles/". $p['picture'] : "../uploads/profiles/default.jpg";

?> 
<body onLoad="setup2('<?php echo $r['section2']; ?>')">
<SCRIPT TYPE="TEXT/JAVASCRIPT">
function setup2(ans) {
lit = ''
lit = lit + '<SELECT NAME="members[rank2]">'
lit = lit + '<OPTION VALUE="8">- Please select -</OPTION>'

if (ans == '7' || ans == '3' || ans == '2' || ans == '6') {
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE statusid = 9 ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = mysql_fetch_array($q)) {
$selected = ($z['statusid'] == $r['rank2']) ? "selected" : '';

?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>" <?php echo $selected; ?>><?php echo $z['statusname']; ?></OPTION>'
<?php
}
?>		
}
  
if (ans == '4') {
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE `statusid` = '6' OR `statusid` = '7' OR `statusid` = '9' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = mysql_fetch_array($q)) {
$selected = ($z['statusid'] == $r['rank2']) ? "selected" : '';

?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>" <?php echo $selected; ?>><?php echo $z['statusname']; ?></OPTION>'
	<?php
	}
	?>		

  }
  
  if (ans == '5') {
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE `statusid` = '1' OR `statusid` = '2' OR `statusid` = '9' ORDER BY  `memberstatus`.`statusid` ASC ");
while ($z = mysql_fetch_array($q)) {
$selected = ($z['statusid'] == $r['rank2']) ? "selected" : '';

?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>" <?php echo $selected; ?>><?php echo $z['statusname']; ?></OPTION>'
	<?php
	}
	?>		

  }

    lit = lit + '</SELECT>'
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




<div class='tableborder'>
 <div class='tableheaderalt'>Editing: <?php echo $p['realname'] ;?> (ID: <?php echo $r['id'] ;?>)</div>

<form method="post" name="quest" action="index.php?manager=members&action=edit&id=<?php echo $_GET['id']; ?>">
<input type="hidden" name="action" value="doedit">

<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow4' colspan="3"><strong>Members Details</strong></td>
</tr>

<tr>
<td width='1%' class='tablerow1' valign="top" rowspan="8">
<div style='border:1px solid #000;background:#FFF;width:150px; padding:5px'>
 <?php
if (strlen($p['picture']) > 0) {
echo '<img src="../uploads/profiles/';
echo (file_exists("../uploads/profiles/".$p['picture'])) ? $p['picture'] : "default.jpg";
echo '" width="150" height="150" />';
}
?>
</div>
<div style='color:gray'><input style="border: 0px; background:none;" type='checkbox' name='remove_photo' value='1' > tick box to remove picture</div>
<input type='hidden' name='profile[picture]' value="<?php echo $p['picture']; ?>"></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Username</td>
<td width='60%' class='tablerow2'>
<input type='text' name='members[username]' value="<?php echo $r['username']; ?>" size='30' class='textinput'>
</td>
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
<td width='40%' class='tablerow1'>Location</td>
<td width='60%' class='tablerow2'>
<input type='text' name='profile[location]' value="<?php echo $p['location']; ?>" size='30' class='textinput'>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Password </td>
<td width='60%' class='tablerow2'>
<a href="modules/members/password.php?id=<?php echo $r['id']; ?>" onClick="NewWindow(this.href,'password','400','300','yes');return false">Change Password</a></td>
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

<tr>
<td width='40%' class='tablerow1'>Favourite Band</td>
<td width='60%' class='tablerow2'>
<input type='text' name='profile[favband]' value="<?php echo $p['favband']; ?>" size='30' class='textinput'>
</td>
</tr>

</table>
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow4' colspan="3"><strong>User Status</strong></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Website Admin Level</td>
<td width='60%' class='tablerow2'>
<a style="float: right;" href="modules/members/viewtable.php" onClick="NewWindow(this.href,'name','800','600','yes');return false">View Levels Table</a>
<select name="members[level]" class="shoutbox">
<?php
$levels = array(null, "Band Member", "Band Committee", "Administrator", "Root Admin", "Webmaster");
unset($levels[0]); 

foreach($levels as $key => $month){ 
echo '<option value="'.$key.'" ';
echo ($key == $r['level']) ? 'selected="selected" ' : '';
echo ' >'. $month . '</option>';
} 

?>
</select>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
Office-Bearer</td>
<td width='60%' class='tablerow2'>
<select id="office" name="office">
<OPTION VALUE="" >No</OPTION>
<?php
$office_query = mysql_query("SELECT `officeid`, `orderid`, `position`, `member_id` FROM  `office` ORDER BY `orderid` ASC");
while ($o = mysql_fetch_array($office_query)) {
	$selected = ($_GET['id'] == $o['member_id']) ? 'selected' : '';
	echo '<option value="'. $o['officeid'].'" '.$selected.'>'. $o['position'] .'</option>';
}
?>
</select>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Playing Position</td>
<td width='60%' class='tablerow2'>
<SELECT id="section2" name="members[section2]" ONCHANGE="setup2(getElementById('section2').value)">
<OPTION VALUE="0">- Please select -</OPTION>
<?php
$q = mysql_query("SELECT * FROM `role` WHERE roleID > 1 ORDER BY displayID");
while ($role = mysql_fetch_array($q)) {

$selected = ($role['roleID'] == $r['section2']) ? 'selected' : '';

echo '<OPTION VALUE="' .$role['roleID']. '" ';
echo ($role['roleID'] == $r['section2']) ? 'selected="selected" ' : '';
echo '>' . $role['name'] . '</option>';
}
?>	
</SELECT>
<SPAN ID="rep2"></SPAN></td>
</tr>

<tr>
<td class='tablerow4' colspan="3"><strong>Contact Information</strong></td>
</tr>

<?php
$na = explode(' ', $p['realname']);
$email = strtolower($na['0']) ."@". strtolower($na['1']).".com";
?>
<script type="text/javascript">
function resetEmail()
  {
 button1 = document.getElementById("email");
 button1.value = '<?php echo $email; ?>';
  }
</script>

<tr>
<td width='40%' class='tablerow1'>Email Address</td>
<td width='60%' class='tablerow2'><input type='text' id="email" name='members[email]' value="<?php echo $r['email']; ?>" size='30' class='textinput'>


<a href="#" onclick="resetEmail()" />Reset</a>
</td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Phone Number
<div style='color:gray'>Phone number will <strong>ONLY</strong> display to Band Members.</div></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[phone_number]' value="<?php echo $p['phone_number']; ?>" size='30' class='textinput'></td>
</tr>


<tr>
<td width='40%' class='tablerow1'>MSN Messenger</td>
<td width='60%' class='tablerow2' colspan="2"><input type='text' name='profile[msn]' value="<?php echo $p['msn']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Yahoo Messenger</td>
<td width='60%' class='tablerow2' colspan="2"><input type='text' name='profile[yahoo]' value="<?php echo $p['yahoo']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>Bebo Username</td>
<td width='60%' class='tablerow2' colspan="2"><input type='text' name='profile[bebo]' value="<?php echo $p['bebo']; ?>" size='30' class='textinput'></td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='3' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td>
</tr>
</table>

</td>
</tr>

</table>



</div>
<?php
}

} else {
?>
We could not find the post you were looking for because the ID is not numeric. This has been logged and forwarded to a admin.
<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>