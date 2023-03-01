<?php
if ($_GET['sign'] == 1) {

if ($_POST['action'] == "doadd") {

$CAPCLASS = new Captcha;

if(isset($_SESSION['uid'])){
$_POST['author'] = htmlentities(addslashes(trim($_POST['author'])));
$_POST['favband'] = htmlentities(addslashes(trim($_POST['favband'])));
$_POST['email'] = htmlentities(addslashes(trim($_POST['email'])));
$_POST['message'] = htmlentities(addslashes(trim($_POST['message'])));

if (!$_POST['author']) {
echo "Please enter your author";
} elseif (!$_POST['message']) {
echo "Please enter a message";
} else {

mysql_query("INSERT INTO `guestbook` (`status` , `date` , `favband`, `location` , `author` , `email` , `ip` , `message` ) VALUES ('".$_POST['status']."', '".date("Y-m-d")."', '".$_POST['favband']."', '".$_POST['location']."', '".ucwords($_POST['author'])."', '".$_POST['email']."', '".$_SERVER['REMOTE_ADDR']."', '".$_POST['message']."');");
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Visitors Guestbook</h2>
<p>Your entry was saved successfully !, The entry will be checked by the administrator.<br />
please wait as we send you back to the guest book, otherwise <a href='./?view=guestbook'>click here</a>
</p>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?view=guestbook">
<?php
} 

} else {

if (!$CAPCLASS->check_captcha($_POST['captcha'], $_POST['captcha_hash'])) {
echo 'The numbers you entered for the captcha didnt match'; 
} else {

$_POST['author'] = htmlentities(addslashes(trim($_POST['author'])));
$_POST['favband'] = htmlentities(addslashes(trim($_POST['favband'])));
$_POST['email'] = htmlentities(addslashes(trim($_POST['email'])));
$_POST['message'] = htmlentities(addslashes(trim($_POST['message'])));

if (!$_POST['author']) {
echo "Please enter your author";
} elseif (!$_POST['message']) {
echo "Please enter a message";
} else {

mysql_query("INSERT INTO `guestbook` (`status` , `date` , `favband`, `location` , `author` , `email` , `ip` , `message` ) VALUES ('".$_POST['status']."', '".date("Y-m-d")."', '".$_POST['favband']."', '".$_POST['location']."', '".ucwords($_POST['author'])."', '".$_POST['email']."', '".$_SERVER['REMOTE_ADDR']."', '".$_POST['message']."');");
?>
 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Visitors Guestbook</h2>

<p>Your entry was saved successfully !, The entry will be checked by the administrator.<br />
please wait as we send you back to the guest book, otherwise <a href='./?view=guestbook'>click here</a>
</p>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<META HTTP-EQUIV=Refresh CONTENT="3; URL=./?view=guestbook">
<?php
}

}
}

} else {
?>
<style type="text/css">
<!--
.red {color: #FF0000}
-->
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Visitors Guestbook</h2>

<form method="post" name="guestform">
<input type="hidden" name="action" value="doadd" />
<input name="status" type="hidden" value="<?php echo ($_SESSION['logged'] == true) ? '1' : '0'; ?>">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="2">

<tr>
<td width="29%"><strong>Name: <span class="red">*</span></strong></td>
<td width="71%">
<?php
if ($_SESSION['logged'] == true) {
?>
<input name="author" type="hidden" value="<?php echo idtoname($_SESSION['uid']); ?>">
<?php echo idtoname($_SESSION['uid']); 
} else {
?>
<input name="author" type="text" size="30" maxlength="30">
<?php
}
?></td>
</tr>
<tr> 
<td width="29%"><strong>Email:</strong></td>
<td width="71%"><?php if ($_SESSION['logged'] == true) {
?>
<input name="email" type="hidden" value="<?php echo idtoemail($_SESSION['uid']); ?>">
<?php echo idtoemail($_SESSION['uid']); 
} else {
?>
<input name="email" type="text" size="30" maxlength="50"> 
<span style="font-size:10px; font-style:italic; color:#999;">for admins to contact you</span>
<?php
}
?></td>
</tr>

<tr> 
<td width="29%"><strong>Favourite Band:</strong></td>
<td width="71%">
<?php
if ($_SESSION['logged'] == true) {
$query3 = mysql_query("SELECT favband FROM `profile` WHERE mid = '".$_SESSION['uid']."'");
$result = mysql_fetch_row($query3);
?>
<input name="favband" type="hidden" value="<?php echo $result['0']; ?>">
<?php echo $result['0']; 
} else {
?>
<input name="favband" type="text" size="30" maxlength="50">
<?php
}
?></td>
</tr>

<tr> 
<td width="29%" ><strong>Location:</strong></td>
<td width="71%">
<select name="location">
<?php
$q = mysql_query("SELECT * FROM `flags` ORDER BY name ASC");
while ($fl = mysql_fetch_array($q)) {

if ($fl['id'] == "33"){
$checked = "selected";
} else {
$checked = "";
}
?>
<option value="<?php echo $fl['id']; ?>" <?php echo $checked; ?> /><?php echo $fl['name']; ?></option><?php echo "\n"; ?>
<?php
}
?>
</select></td>
</tr>
<tr>
<td colspan="2">
<strong>Message <span class="red">*</span></strong>
<br />
<textarea name="message" rows="10" style="width: 100%; overflow:auto;"></textarea>
</td>
  </tr>

<?php
if ($_SESSION['logged'] ==  false) {
?>
<tr>
<td width="29%"><strong>Anti-Spam:</strong></td>
<td width="71%">
<?php
$CAPCLASS = new Captcha;
$captcha = $CAPCLASS->create_captcha();
$hash = $CAPCLASS->get_hash();
$CAPCLASS->clear_oldcaptcha();
echo $captcha;
echo ' <input type="text" name="captcha" size="5" maxlength="5">';
echo '<input name="captcha_hash" type="hidden" value="'.$hash.'"><br>';
?></td>
</tr>
<?php
}
?>


<tr> 
<td colspan="2" style="text-align:center">
<input name="submit" type="submit" value="Sign Guestbook"></td>
</tr>
</table>
</form>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php
}

} else {
?>
<style type="text/css">
<!--
.reply {
color: #000000;
border: 1px solid #333333;
background-color: #F2F2F2;
padding: 2px;
margin-top: 5px;
}
-->
</style>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Visitors Guestbook</h2>


<a href="./?view=guestbook&amp;sign=1" style="border: 1px solid #484848; padding: 10px; margin: 10px; margin-right: 25%; background-color: #F3F3F3; width: 200px; text-align:center; float:right; text-decoration: none; font-size:large;">Sign our guestbook</a>

<br />

<?php

$query = mysql_query("SELECT * FROM `guestbook` WHERE `status` ='1' ORDER by id DESC");
while ($r = mysql_fetch_array($query)) {

$query3 = mysql_query("SELECT * FROM `flags` WHERE `id` = '".$r['location']."' LIMIT 1;");
$results = mysql_fetch_array($query3);

$d = explode("-", $r['date']);
$day = date("D", mktime(0, 0, 0, $d['1'], $d['2'], $d['0']));
$r['date'] = date("D jS F", mktime(0, 0, 0, $d['1'], $d['2'], $d['0']));

if (!$r['favband']) {
$r['favband'] = "N/A";
}

if (!$r['email']) {
$r['email'] = "N/A";
}

?>

<div id='thread'>
<div style='clear: both'></div>
<div id='<?php echo $r['id']; ?>'>
<div class='threadheader'>
<div class='threadheaderleft'>
<?php
echo "(". $r['id']. ") " . $r['author'] . " ";
?>
</div>

<div class='threadheaderright'>
<?php
echo $r['date']; 
?>
</div>

</div>

<div id='threadcontent_<?php echo $r['id']; ?>' class='threadcontent'>

<?php
if ($_SESSION['logged']) { echo "<strong>E-Mail:</strong> " . $r['email'] . "<br />"; }
?>

<strong>Favourite Band:</strong> <?php echo $r['favband']; ?><br />
<strong>Location:</strong> <?php echo userflag($r['location']) . " " . $results['name']; ?>
<div class='padding'>
<?php 
echo stripslashes(nl2br(icon($r['message'])));
 
$query2 = mysql_query("SELECT * FROM `guestbook_reply` WHERE `replyto` = '".$r['id']."' ORDER BY id DESC");
if (mysql_num_rows($query2) > 0) { 
$re = mysql_fetch_array($query2);
	if ($r['id'] == $re['replyto']) {
	echo "<div class='reply'>Reply to comment # {$r[id]}<br />";
	echo "(". date("D jS F", strtotime($re['date'])) . ") Webmaster says: <br />";
	echo stripslashes($re['message']);
	echo "</div>";
	}
}	
?>


</div>
</div>

</div>
</div>

<?php
}
?>
  </div>
  <div class="bb"><div><div></div></div></div>
</div>
<?php

}
?>

