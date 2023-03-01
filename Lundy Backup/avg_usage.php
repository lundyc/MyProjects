<h2>Average Usage Chart</h2>

<table id="content">
<tr>
<th><b>Item</b></th>

<?php
$query_products = "SELECT `ProductID`, `Name` FROM `products`";
$res = $mysqli->query($query_products);

$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` DESC 
LIMIT 0 , 4";
$res2 = $mysqli->query($query_dates);

$dateA = array();
$d = 0;

while($da = $res2->fetch_assoc()){
	$dateA[$d] = $da['DateID'];
?>
<th><?php echo $da['date_format']; ?></th>
<?php
$d++;
}
?>
<th>AVG Weekly Usage</th>
</tr>

<?php
while($row = $res->fetch_assoc()){
?>
<tr>
<td><b><?php echo $row['Name']; ?></b></td>

<?php
for($i=0; $i<count($dateA); $i++) {
	
	$query_used = "SELECT `UsedID`, `DateID`, `amount` FROM `used` WHERE `DateID` = '". $dateA[$i]."' AND `ProductID` = '" . $row['ProductID']."'";
$used = $mysqli->query($query_used);
$usd = $used->fetch_assoc();

if (!$usd['amount']) {
	$usd['amount'] = 0;
}
$average[$row['ProductID']] += $usd['amount'];
//array_push($average[$row['ProductID']], $usd['amount']);
?>
<td class="center"><?php echo $usd['amount']; ?></td>
<?php
}
?>

<td class="center"><?php echo number_format(($average[$row['ProductID']] / 4), 2, '.', ''); ?></td>
</tr>
<?php
}
?>

</table>