<?php
$buffer = "15";
?>
<h2>Build To Chart</h2>

<table id="content">
<tr>
<th><b>Item</b></th>
<th><b>AVG<br>Wkly<br>Usage</b></th>
<th><b>+</b></th>
<th><b><?php echo $buffer; ?>%</b></th>
<th><b>-</b></th>
<th><b>Left</b></th>
<th><b>=</b></th>
<th><b>Order Amount</b></th>
<th><b>Order Cases</b></th>
<th><b>Packet Size</b></th>
<th><b>In Case</b></th>
<th><b>Case Size</b></th>
<th><b>Price</b></th>
<?php
$query_products = "SELECT `ProductID`, `Name`, `pack_size`, `incase`, `casesize`, `price` FROM `products`";
$res = $mysqli->query($query_products);

$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` DESC 
LIMIT 0 , 4";
$res2 = $mysqli->query($query_dates);

$dateA = array();
$d = 0;

while($da = $res2->fetch_assoc()){
	$dateA[$d] = $da['DateID'];
$d++;
}
?>
</tr>

<?php
while($row = $res->fetch_assoc()){
?>
<tr>
<td><b><?php echo $row['Name']; ?></b></td>

<?php
$last_date = reset($dateA);
for($i=0; $i<count($dateA); $i++) {	
	
$query_used = "SELECT `UsedID`, `DateID`, `amount`, `left` FROM `used` WHERE `DateID` = '". $dateA[$i]."' AND `ProductID` = '" . $row['ProductID']."'";
$used = $mysqli->query($query_used);
$usd = $used->fetch_assoc();

$query_left = "SELECT `left` FROM `used` WHERE `DateID` = '". $last_date."' AND `ProductID` = '" . $row['ProductID']."'";
$left = $mysqli->query($query_left);
$lft = $left->fetch_assoc();

if (!$usd['amount']) {
	$usd['amount'] = 0;
}
$average[$row['ProductID']] += $usd['amount'];

}
$avg = ($average[$row['ProductID']] / 4);
$percentage = ($buffer/100)*$avg;
$orderamt = ($avg + $percentage)-$lft['left'];
$orderamt = ($orderamt < 0) ? '0' : $orderamt;
?>

<td class="center"><?php echo number_format($avg, 2, '.', ''); ?></td>
<td></td>
<td class="center"><?php echo number_format($percentage, 2, '.', ''); ?>%</td>
<td></td> 
<td class="center"><?php echo $lft['left']; ?></td>
<td></td>
<td class="center"><?php echo number_format($orderamt, 2, '.', ''); ?></td>
<td class="center"><?php echo number_format($orderamt/$row['casesize']);?></td>
<td class="center"><?php echo $row['pack_size']; ?></td>
<td class="center"><?php echo $row['incase']; ?></td>
<td class="center"><?php echo $row['casesize']; ?></td>
<td class="center">&pound; <?php echo $row['price']; ?></td>
</tr>
<?php
}
?>

</table>