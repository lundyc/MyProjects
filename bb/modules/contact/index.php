<style>
#officers, #companies {
	width: 100%;
	padding: 3px;
	margin: 2px;
}

#officers td, #companies td {

}
</style>

<div class="module"><div class="mb"><h2>Office Bearers</h2>	  

<?php
echo '<table id="officers">';

$query2 = "SELECT `id`, `position`, `name`, `telephone`, `email` FROM  `office_bearers`";
$result = $mysqli->query($query2) or die($mysqli->error.__LINE__);
while ($r = mysqli_fetch_array($result)) {

echo '<tr>';
echo '<td width="40%"><strong>'. $r['position'] .'</strong></td>';
echo '<td width="35%">'. $r['name'] .'</td>';
echo '<td width="23%">'. $r['telephone'] .'</td>';
echo '<td width="2%" align="right"><a href="?page=contact&action=email&OID='. $r['id'].'">Email</a></td>';
echo '</tr>';
}

echo '</table>';
?>
</div></div>

<div class="module"><div class="mb"><h2>Companies</h2>	  
<table id="companies">
<?php
$query2 = "SELECT `BridgeID`, `CompanyID`, `MemberID`, 
		(SELECT `Name` FROM `company` WHERE `company_bridge`.`CompanyID` = `company`.`CompanyID`) as `Company_Name`,
		(SELECT `realname` FROM `profile` WHERE `company_bridge`.`MemberID` = `profile`.`mid`) as `Realname`, 
		(SELECT `telephone` FROM `profile` WHERE `company_bridge`.`MemberID` = `profile`.`mid`) as `Phone_Number`
		FROM `company_bridge`";
$result = $mysqli->query($query2) or die($mysqli->error.__LINE__);
while ($r = mysqli_fetch_array($result)) {
?>
<tr>
<td width="40%"><strong><?php echo $r['Company_Name']; ?></strong></td>
<td width="35%"><?php echo $r['Realname']; ?></td>
<td width="23%"><?php echo $r['Phone_Number']; ?></td>
<td width="2%" align="right""><a href="?page=contact&action=email&ID=<?php echo $r['CompanyID']; ?>">Email</a></td>
</tr>
<?php	
}	
?>

</table>
</div></div>