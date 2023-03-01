<?PHP
$check = 0;
if ($_POST['action'] == "contactpeerson") {

if (empty($_POST['name'])) {
	$check = 1;
	$error = "Please enter a Name";
}

if (empty($_POST['contact_email'])) {
	$check = 1;
	$error = "Please enter a E-Mail address";
}

if (empty($_POST['content'])) {
	$check = 1;
	$error = "Please enter something.";
}

if ($check == 0) {
	
	
$to      = 'colin@lundy.me.uk';
$subject = 'test email';
$message = 'here is the message content for the test email and to show that it works !!! ';
$headers = 'From: NoReply@spb-fb.co.uk' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message);

echo "SENT!!!";
}

}
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
<h2>Contact
<a style="float: right;" href="javascript:history.back(-1);">Back</a>
</h2>

<?php
if ($check == 1) {

if (isset($error)) {
	echo '<div style="border: 1px solid red; background-color: pink; padding: 3px; margin: 3px;"><b>Error:</b> '.$error.'</div>';
}

}
?>


<form method="post" name="contact_form" action="/?page=contact&action=email&ID=<?PHP echo (is_numeric($_GET['ID'])) ? $_GET['ID'] : 0; ?>">
<input type='hidden' name='action' value="contactpeerson">
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>

<tr>
<td width='40%' class='tablerow1'>Your Name</td>
<td width='60%' class='tablerow2'>
<input type='text' name='name' value="" size='30' class='textinput'>
</td>
</tr>

<tr>
<td>Your Email</td>
<td>
<input type='text' name='contact_email' value="" size='30' class='textinput'>
</td>
</tr>

<tr>
<td>Phone Number</td>
<td><input type='tel' name='phone_number' value="" size='30' class='textinput'></td>
</tr>

<tr>
<td colspan='2'>
<textarea rows="6" cols="50" name="content" id="content" style="width:100%">
</textarea>
</td>
</tr>

<tr>
<td align='center' class='tablesubheader' colspan='2' >
<input type='submit' value='Send Now' class='realbutton' accesskey='s'></td>
</tr>


</table>
</form>
</div>
</div>