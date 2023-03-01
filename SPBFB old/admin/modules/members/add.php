<?php
if (level($_SESSION['uid']) > 4) {

if (isset($_POST['action']) && $_POST['action'] == "doadd") {

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

if ($error == 0) {

$names = '';
$values = '';


if (empty($_POST['members']['password'])) {
$_POST['members']['password'] = md5("changeme"); 
$pw = "changeme";
} else {
$pw = $_POST['members']['password'];
$_POST['members']['password'] = md5($_POST['members']['password']);

}

$_POST['members']['username'] = strtolower($_POST['members']['username']);


while (list($settingname, $settingvalue) = each($_POST['members'])) {
$names .= "`". $settingname."`, ";
$values .= "'".$settingvalue."', ";
}

$names2 = '';
$values2 = '';
while (list($settingname2, $settingvalue2) = each($_POST['profile'])) {
$names2 .= "`". $settingname2."`, ";
$values2 .= "'".$settingvalue2."', ";
}

$names = substr($names,0,strlen($names) - 2);
$values = substr($values,0,strlen($values) - 2);
$names2 = substr($names2,0,strlen($names2) - 2);
$values2 = substr($values2,0,strlen($values2) - 2);

mysql_query("INSERT INTO `members` ($names) VALUES ($values)") or die(mysql_error());
mysql_query("INSERT INTO `profile` ($names2) VALUES ($values2)") or die(mysql_error());

$to = mysql_insert_id();
mysql_query("INSERT INTO `msgs` (`to`,`from`,`subject`,`content`,`date`,`status`) VALUES ('".$to."', '1', 'Welcome', 'Welcome to the SPB-FB.co.uk website :)\n\nPlease note that Lundy is still working on the website so some functions may not work at times.\nIf you find a error or would like something added to the wesbite then feel free to send him a message.', '".time()."', 'unread');");


?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
 <h2>Administrator Message</h2>
 <p>
This user has been added to the database. Please take down a copy of there details as the e-mailer hasn't been setup yet.....<br /><br />
Username: <?php echo $_POST['members']['username']; ?><br />
Password: <?php echo $pw; ?><br />
Email: <?php echo $_POST['members']['email']; ?><br />
 </p>
</div>
<br>
<?php
unset($_SESSION['error']);
//redirect("index.php?manager=members", 30);

} else {
?>
<div class='information-box'>
 <img src='images/tabs_main/global-infoicon.gif' alt='information' />
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


<body onLoad="loader('<?php echo $r['section1']; ?>', '<?php echo $r['section2']; ?>')">
<SCRIPT TYPE="TEXT/JAVASCRIPT">
function loader(ans, ans2) {
setup(ans);
setup2(ans2);
}


function setup(ans) {
  lit = ''
  if (ans == '1') {
    lit = ''
    lit = lit + '<SELECT NAME="members[rank1]">'
    lit = lit + '<OPTION VALUE="0">- Please select -</OPTION>'
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE statusid < 6");
while ($z = mysql_fetch_array($q)) {
?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>"><?php echo $z['statusname']; ?></OPTION>'
	<?php
	}
	?>	
    lit = lit + '</SELECT>'
  }

  document.getElementById('rep').innerHTML=lit
}


function setup2(ans) {
lit = ''
lit = lit + '<SELECT NAME="members[rank2]">'
lit = lit + '<OPTION VALUE="0">- Please select -</OPTION>'

if (ans == '5' || ans == '6' || ans == '2' || ans == '3' || ans == '7') {
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE statusid = 8");
while ($z = mysql_fetch_array($q)) {
?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>"><?php echo $z['statusname']; ?></OPTION>'
<?php
}
?>		

}
  
if (ans == '4') {
<?php
$q = mysql_query("SELECT * FROM `memberstatus` WHERE `statusid` = '6' OR `statusid` = '7' OR `statusid` = '8'");
while ($z = mysql_fetch_array($q)) {
?>	
lit = lit + '<OPTION VALUE="<?php echo $z['statusid']; ?>"><?php echo $z['statusname']; ?></OPTION>'
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
<div class='tableheaderalt'>Add Member</div>
<form method="post" name="post" action="index.php?manager=members&action=add">
<input type="hidden" name="action" value="doadd">
<input type="hidden" name="members[joined]" value="<?php echo time(); ?>">
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<td class='tablerow4' colspan="3"><strong>Members Details</strong></td>
</tr>

<tr>
<td width='40%' class='tablerow1'><strong>Username</strong><div style='color:gray'>Must be lower case</div></td>
<td width='60%' class='tablerow2'><input type='text' name='members[username]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'><strong>Real Name</strong></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[realname]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'><strong>Nick Name</strong></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[nickname]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'>
<strong>Password</strong> 
<div style='color:gray'>leave blank for random password</div></td>
<td width='60%' class='tablerow2'><input type='text' name='members[password]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'><strong>Date of Birth</strong></td>
<td width='60%' class='tablerow2' colspan="2">
<select name="profile[bday_day]" style="width: 12%;">
<?php
echo "<option value='0'>--</option>\n";

$day2 = 1;
while ($day2 < 32) {
echo "<option value=\"" . $day2 . "\">" . $day2 . "</option>\n";
$day2++;
} 
?>
  </select>
/
<select name="profile[bday_month]" class="shoutbox">
<?php
echo "<option value='0'>--</option>\n";

$month2 = 1;
while ($month2 < 13) {
echo "<option value=\"" . $month2 . "\">" . date("F", mktime(0,0,0, $month2, 1,0)) . "</option>\n";
$month2++;
} 
?>
</select>
/
<select name="profile[bday_year]" class="shoutbox">
<?php
echo "<option value='0'>----</option>\n";

$year2 = 1900;
$lastyear = date("Y") + 1;

while ($year2 < $lastyear) {
echo "<option value=\"" . $year2 . "\">" . $year2 . "</option>\n";
$year2++;
} 
?>
</select></td>
</tr>

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

foreach($levels as $key => $level)
echo '<option value="'.$key.'">'. $level . '</option>';

?>
</select>
</td>
</tr>



<tr>
<td width='40%' class='tablerow1'>
Office-Bearer</td>
<td width='60%' class='tablerow2'>
<SELECT id="section1" name="members[section1]" ONCHANGE="setup(getElementById('section1').value)">
<OPTION VALUE="0" >- Please select -</OPTION>
<OPTION VALUE="0">No</OPTION>
<OPTION VALUE="1">Yes</OPTION>
</SELECT>
<SPAN ID="rep"></SPAN></td>
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

echo '<OPTION VALUE="' .$role['roleID']. '">' . $role['name'] . '</option>';
}
?>	
</SELECT>
<SPAN ID="rep2"></SPAN></td>
</tr>




<tr>
<td class='tablerow4' colspan="3"><strong>Contact Information</strong></td>
</tr>



<tr>
<td width='40%' class='tablerow1'><strong>Email Address</strong></td>
<td width='60%' class='tablerow2'><input type='text' name='members[email]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td width='40%' class='tablerow1'><strong>Phone Number</strong></td>
<td width='60%' class='tablerow2'><input type='text' name='profile[phone_number]' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Save Changes' class='realbutton' accesskey='s'></td>
</tr>
</table>
</form>

</div>

<?php
}

} else {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}
?>