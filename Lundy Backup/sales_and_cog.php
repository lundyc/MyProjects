<style>
.red { background-color: #FF0033;}
.green { background-color: #99CC33;}
#mainthing td {border: 0px;}
#mainthing td: { vertical-align: top; width: 65% !important;}
</style>

<h2>Sales and Cost of Goods</h2>

<table width="100%" id="mainthing">
<tr>
<td width="50%" valign="top">
<table id="content">


<?php
$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` DESC LIMIT 0 , 4";
$date = $mysqli->query($query_dates);
while($dates = $date->fetch_assoc()){
	
	$query_sales = "SELECT `SalesID`, `DateID`, `FoodCost`, `NetSales` FROM `sales` WHERE `DateID` = '".$dates['DateID']."'; ";
	$sale = $mysqli->query($query_sales);
	$sal = $sale->fetch_assoc();
?>
<tr>
<th colspan="2" class="center"><b><?php echo $dates['date_format']; ?></b></th>
</tr>
<tr>
<td class="center"><b>Weekly Food Order</b></td>
<td>&pound; <?php echo number_format($sal['FoodCost'], '2', '.', ''); ?></td>
</tr>
<tr>
<td class="center"><b>Net Sales</b></td>
<td>&pound;  <?php echo number_format($sal['NetSales'], '2', '.', ''); ?></td>
</tr>
<?php
}
?>

</table>
</td>
<td id="right" valign="top">
<table id="content">
<tr>
<th colspan="4" class="center"><B>Combo Report COG</b></th>
</tr>

<tr>
<?php
$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` DESC LIMIT 0 , 4";
$date = $mysqli->query($query_dates);
while($dates = $date->fetch_assoc()){
?>
<th class="center"><b><?php echo $dates['date_format']; ?></b></th>
<?php
}
?>
</tr>
<tr>
<?php
$disAVG = 0;
$query_district = "SELECT `DisID`, `DateID`, `value` FROM `district` ORDER BY  `DateID` DESC LIMIT 0 , 4";
$district = $mysqli->query($query_district);
while($dis = $district->fetch_assoc()){
	$disAVG += $dis['value'];
?>
<td class="center"><?php echo $dis['value']; ?></td>
<?php
}
?>
</tr>
</table>

<br>

<table id="content">
<tr>
<th width="25%"></th>
<th width="25%">F/C %</th>
<th width="25%">Differ</th>
<th width="25%">DA Avg</th>
</tr>

<tr>
<td><b>Previous Month</b></td>
<td class="center">
<?php
$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` ASC LIMIT 0 , 1";
$date = $mysqli->query($query_dates);
$dates = $date->fetch_assoc();

$query_sales = "SELECT `SalesID`, `DateID`, `FoodCost`, `NetSales` FROM `sales` WHERE `DateID` = '".$dates['DateID']."'; ";
$sale = $mysqli->query($query_sales);
$sal = $sale->fetch_assoc();

$prevFoodCost = number_format(($sal['FoodCost'] / $sal['NetSales'] * 100), 2, '.', '');

echo $prevFoodCost ;
?> %
</td>
<td></td>
<td class="center"><?php $disAVG = $disAVG/4; echo number_format(($disAVG),'2', '.', ''); ?> %</td>
</tr>


<?php
$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` ASC LIMIT 0 , 4";
$date = $mysqli->query($query_dates);
while($dates = $date->fetch_assoc()){
	
	$query_sales = "SELECT `SalesID`, `DateID`, `FoodCost`, `NetSales` FROM `sales` WHERE `DateID` = '".$dates['DateID']."'; ";
	$sale = $mysqli->query($query_sales);
	$sal = $sale->fetch_assoc();
	
	// FC / Net Sales
	$foodCost = number_format(($sal['FoodCost'] / $sal['NetSales'] * 100), 2, '.', '');
?>
<td><b><?php echo $dates['date_format']; ?></b></td>
<td class="center"><?php echo $foodCost; ?> %</td>
<td class="<?php echo (($prevFoodCost - $foodCost) > 0) ? 'green' : 'red'; ?> center"><?php echo ($prevFoodCost - $foodCost);?> %</td>
<td class="<?php echo (($disAVG)-$foodCost > 0) ? 'green' : 'red'; ?> center"><?php echo ($disAVG)-$foodCost; ?></td>
</tr>
<?php
$prevFoodCost = $foodCost;
}
?>

</table>

<br>
<table id="content" width="100%">
<tr>
<th class="center">Average Sales</th>
<th class="center">Average COGs</th>
<th class="center">Average  F/C %</th>
<th class="center">Diff of COG to DA %</th>
</tr>

<tr>
<td class="center">
<?php
$averageNetSales = 0;
$averageFoodCost = 0;
$query_dates = "SELECT `DateID`, `date`, DATE_FORMAT(`date`, '%D %b %y') as `date_format` FROM `dates` ORDER BY  `DateID` DESC LIMIT 0 , 4";
$date = $mysqli->query($query_dates);
while($dates = $date->fetch_assoc()){
	
	$query_sales = "SELECT `SalesID`, `DateID`, `FoodCost`, `NetSales` FROM `sales` WHERE `DateID` = '".$dates['DateID']."'; ";
	$sale = $mysqli->query($query_sales);
	$sal = $sale->fetch_assoc();
	
	$averageNetSales += $sal['NetSales'];
	$averageFoodCost += $sal['FoodCost'];
}
$averageNetSales = $averageNetSales/4;
$averageFoodCost = $averageFoodCost/4;
echo "&pound; ". number_format($averageNetSales, 2, '.', '');
?>
</td>
<td class="center">&pound; <?php echo number_format($averageFoodCost, 2, '.', ''); ?></td>
<td class="center"><?php echo number_format((($averageFoodCost/$averageNetSales)*100), 2, '.', ''); ?> %</td>
<td class="center"><?php echo number_format((($averageFoodCost/$averageNetSales)*100-$disAVG), 2, '.', ''); ?></td>
</tr>

<tr>
<td colspan="3"></td>
<td class="center">&pound; <?php echo number_format(((($averageFoodCost/$averageNetSales)*100) - $disAVG) * $averageNetSales, 2, '.', ''); ?></td>
</tr>
</table>

</td>
</tr>
</table>
<?php
/*









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
*/
?>