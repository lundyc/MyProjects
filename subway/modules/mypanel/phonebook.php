<?php
if (!isset($_SESSION['uid'])) {
	header("location: index.php");
}

?>

 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Bands Phonebook</h2>

<table width="100%" cellpadding="0" cellspacing="0">

<tr>
<td width="20%"><strong>Full Name</strong></td>
<td width="20%"><strong>Phone Number</strong></td>
<td width="20%"><strong>Email</strong></td>
</tr>
<?php
function format_phone($phone)
{
	$phone = preg_replace("/[^0-9]/", "", $phone);

	if(strlen($phone) == 7)
		return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	elseif(strlen($phone) == 10)
		return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
	else
		return $phone;
}

$q = "SELECT 
`members`.`id`, 
`members`.`email`,

(SELECT `realname` FROM `profile` WHERE `mid` = `members`.`id`) AS `real_name`,
(SELECT `phone_number` FROM `profile` WHERE `mid` = `members`.`id`) AS `phone_num`

FROM `members`";

$query = mysql_query($q);
while($m = mysql_fetch_array($query)) {
?>
<tr>
<td class="tablerow1"><?php  echo $m['real_name']; ?></td>
<td class="tablerow1"><?php 
if (empty($m['phone_num'])) {
	echo "--";
} else {
echo format_phone($m['phone_num']);
}
?></td>
<td class="tablerow1"><?php 
$r = explode(" ", $m['real_name']);
$email = strtolower($r['0']) ."@". strtolower($r['1']).".com";

if ($m['email'] == $email) {
	echo "--";
} else {
	echo "<a href='matio:".strtolower($m['email'])."'>".strtolower($m['email'])."</a>"; 
}
?></td>
</tr>
<?php
}
?>
</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
