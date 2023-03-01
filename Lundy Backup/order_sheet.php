<?php
$buffer = "15";
?>
<h2>Order Sheet</h2>

<table id="content">
<tr>
<th><b>Item</b></th>
<th><b>Order Cases</b></th>
<th><b>Price</b></th>
<th><b>Cost</b></th>
<th><b>Total Order</b></th>
<th><b><div id="total">0.00</div></b></th>

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

$total += $row['price']*(number_format($orderamt/$row['casesize']));

//if ($orderamt == 0) { continue; }
?>
<tr>
<td><b><?php echo $row['Name']; ?></b></td>
<td class="center"><?php echo number_format($orderamt/$row['casesize']);?></td>
<td class="center">&pound; <?php echo $row['price']; ?></td>
<td class="center">&pound; <?php echo $row['price']*(number_format($orderamt/$row['casesize'])); ?></td>
<td></td> 
<td></td>
</tr>
<?php
}
?>
</table>
<script>
document.getElementById('total').innerHTML = '&pound; <?php echo $total; ?>';
</script>