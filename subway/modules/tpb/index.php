<style>
#league th { 
border-bottom: 1px solid #000;
}
</style>
<?php
$query = "SELECT `tpb_id`, `league_name` FROM `tpb_leage`;";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
while($r = $result->fetch_assoc()) {

$averageUpdate = "SELECT  `player_id` ,  `player_id` AS  `temp_id` ,  
`1_score` ,  `2_score` ,  `3_score` ,  `4_score` ,  `5_score` ,  `6_score` , 
`7_score` ,  `8_score` ,  `9_score` ,  `10_score` ,  `11_score` ,  `12_score` , 
(

SELECT SUM(  `1_score` +  `2_score` +  `3_score` +  `4_score` +  `5_score` +  `6_score` +  `7_score` +  `8_score` +  `9_score` +  `10_score` +  `11_score` +  `12_score` ) 
FROM  `tpb_player` 
WHERE  `player_id` =  `temp_id`
) AS  `total`

FROM  `tpb_player` 
WHERE  `league_id` = '".$r['tpb_id']."'; ";
$resultUpdate = $mysqli->query($averageUpdate) or die($mysqli->error.__LINE__);

while ($u = $resultUpdate->fetch_assoc()) {
	

$games = 0;
$totalAVERAGE = 0;

while ($games <= 12) {
if ($u[$games . '_score'] > 0) {
$totalAVERAGE++;
} 
$games++;
}

$average = ($u['total'] / $totalAVERAGE);
$mysqli->query("UPDATE  `tpb_player` SET  `average` =  '".$average."' WHERE  `player_id` ='". $u['player_id'] ."';");
}

/////////////////////////////
?>
<div class="module"><div class="mb" id='news'>
<h2>Ten Pin Bowling	-<?php echo $r['league_name']; ?></h2>
<table cellspacing="1" width="100%" id="league">
<tr>
<th width="1%" align="center">Pos</th>
<th width="10%">Name</th>
<th width="10%">Company</th>

<th width="4%" align="center" class="mobile_display">1</th>
<th width="4%" align="center" class="mobile_display">2</th>
<th width="4%" align="center" class="mobile_display">3</th>
<th width="4%" align="center" class="mobile_display">4</th>
<th width="4%" align="center" class="mobile_display">5</th>
<th width="4%" align="center" class="mobile_display">6</th>
<th width="4%" align="center" class="mobile_display">7</th>
<th width="4%" align="center" class="mobile_display">8</th>
<th width="4%" align="center" class="mobile_display">9</th>
<th width="4%" align="center" class="mobile_display">10</th>
<th width="4%" align="center" class="mobile_display">11</th>
<th width="4%" align="center" class="mobile_display">12</th>

<th width="4%" align="center">Total</th>
<th width="4%" align="center">Average</th>
</tr>
<?php
$query2 = "SELECT  `player_id` ,  `player_id` AS  `temp_id` ,  
`1_score` ,  `2_score` ,  `3_score` ,  `4_score` ,  `5_score` ,  `6_score` , 
`7_score` ,  `8_score` ,  `9_score` ,  `10_score` ,  `11_score` ,  `12_score` , 
`average`,
(
SELECT  `profile`.`realname` 
FROM  `profile` 
WHERE  `profile`.`mid` =  `tpb_player`.`player_id`
) AS  `real_name` , (
SELECT  `profile`.`company_id` 
FROM  `profile` 
WHERE  `profile`.`mid` =  `tpb_player`.`player_id`
) AS  `company_id` , (
SELECT  `company`.`Name` 
FROM  `company` 
WHERE  `company`.`CompanyID` =  `company_id`
) AS  `company_name` , (
SELECT SUM(  `1_score` +  `2_score` +  `3_score` +  `4_score` +  `5_score` +  `6_score` +  `7_score` +  `8_score` +  `9_score` +  `10_score` +  `11_score` +  `12_score` ) 
FROM  `tpb_player` 
WHERE  `player_id` =  `temp_id`
) AS  `total`
FROM  `tpb_player` 
WHERE  `league_id` = '".$r['tpb_id']."' ORDER BY `average` DESC; ";
$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
$position = '1';
while ($p = $result2->fetch_assoc()) {
?>
<tr>
<td align="center"><?php echo $position; ?></td>
<td><?php echo $p['real_name']; ?></td>
<td widtd="4%"><?php echo $p['company_name']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['1_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['2_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['3_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['4_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['5_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['6_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['7_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['8_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['9_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['10_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['11_score']; ?></td>
<td align="center" class="mobile_display"><?php echo $p['12_score']; ?></td>

<td align="center"><?php echo $p['total']; ?></td>
<td align="center"><?php echo round($p['average'], 2); ?></td>
</tr>
<?php
$position++;
}
?>
</table>
</div></div>
<?php
} 
?>