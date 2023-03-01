<?php
include_once("mysqli.php");
error_reporting(E_ALL);

setlocale(LC_MONETARY, 'en_GB');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Piperhill Ltd - Cash-in Reports</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
$("td.details").live('click', function(){
$(this).closest('tr').next('tr').toggle();
});
   
//
</script>

<style>
thead td { 
  padding-top: 1px;
  padding-right: 1px;
  padding-left: 1px;
  mso-ignore: padding;
  mso-font-charset: 0;
  mso-number-format: General;
  text-align: center;
  vertical-align: middle;
  background: #DDEBF7;
  mso-pattern: #DDEBF7 none;
  white-space: nowrap;
  height: 43;
 border-bottom: 1px dashed #999999;
 font-weight: bold;
}

#info td { 
border-bottom: 1px dashed #999999;
}

.more { 
display: none; 
}

h2 { 
border-bottom: 1px solid black; 
}

</style>
</head>

<body>
  <?php
  $dates = array();
  
$days = "SELECT 
`CashID`, 
DATE(`Date`) as `Date2`, 
 DATE_FORMAT( DATE,  '%a, %D %b %Y' ) AS  `Date_header` ,  
`Date` FROM  `cash` GROUP BY DAY(`Date`) ORDER BY `Date` DESC;";
 $query1 = $mysqli->query($days) or die($mysqli->error);
  while ($row1 = $query1->fetch_assoc()) {

echo "<h2>".$row1['Date_header']."</h2>";
?>	

<table width="100%" id="info" cellpadding="0" cellspacing="0">
<thead>
  <tr>
	<td height="43" align="center">ID</td>
    <td align="center">Time</td>
    <td align="center">Clerk</td>
    <td align="center">Cash</td>
    <td align="center">Bread</td>
    <td align="center">Flatbread</td>
  </tr>
  </thead>
  <?php
  $q = "SELECT 
  `CashID`,
  `Date`, 
  DATE_FORMAT( DATE,  '%H:%i:%s' ) AS  `ftime` ,  
  DATE_FORMAT( DATE, '%H') AS `hour`, 
  `Staff_Name` , (
`fifty_pound` +  `twenty_pound` +  `ten_pound` +  `five_pound` +  `one_pound` +  `fifty_pence` +  `twenty_pence` +  `ten_pence` + `five_pence` + `two_pence` +  `one_pence` +  `change`
) AS  `total` , 
`fifty_pound`,
`twenty_pound`,
`ten_pound`,
`five_pound`,
`one_pound`,
`fifty_pence`,
`twenty_pence`,
`ten_pence`,
`five_pence`,
`two_pence`,
`one_pence`,
`change`,
`bread`,  
 `flatbread` 
FROM  `cash` WHERE DATE(Date) = '".$row1['Date2']."'";
  $query = $mysqli->query($q);
  
  $row = 1;
  while ($row2 = $query->fetch_assoc()) { 
  
  $test = end($dates);
  $tbgolor = '';
  if ($test['hour'] == $row2['hour']) {
  $tbgolor = ($test['total'] != $row2['total']) ? 'red' : '';
	
  /*
 echo "Last one: <br><pre>";
 print_r(end($dates));
 echo "<br>Database Row2:<br>";
 print_r($row2);
 echo "</pre>";
 */
  }
  
  $dates[] = $row2;
  ?>
  <tr>
	<td height="35" align="center" class="details"><?php echo $row2['CashID']; ?></td>
    <td align="center" class="details"><?php echo $row2['ftime']; ?></td>
    <td align="center" class="details"><?php echo $row2['Staff_Name']; ?></td>
    <td align="center" class="details"><?php echo '£ ' . number_format($row2['total'], 2, '.', ''); ?></td>
    <td align="center" class="details"><?php echo number_format($row2['bread'], 2, '.', ''); ?></td>
    <td align="center" class="details"><?php echo number_format($row2['flatbread'], 2, '.', ''); ?></td>
  </tr>
  
  <tr class="more">
    <td colspan="6" align="center"><table width="100%" cellpadding="3" cellspacing="0">
      <tr>
        <td width="16%" align="center" bgcolor="#DDEBF7">£50</td>
        <td width="16%" align="center" bgcolor="#DDEBF7">£20</td>
        <td width="16%" align="center" bgcolor="#DDEBF7">£10</td>
        <td width="16%" align="center" bgcolor="#DDEBF7">£5</td>
        <td width="16%" align="center" bgcolor="#DDEBF7">£1</td>
        <td width="16%" align="center" bgcolor="#DDEBF7">Change</td>
        </tr>
      <tr>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['fifty_pound'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['twenty_pound'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['ten_pound'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['five_pound'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['one_pound'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['change'], 2, '.', ',' ); ?></td>
        </tr>
      <tr>
        <td align="center" bgcolor="#DDEBF7">50p</td>
        <td align="center" bgcolor="#DDEBF7">20p</td>
        <td align="center" bgcolor="#DDEBF7">10p</td>
        <td align="center" bgcolor="#DDEBF7">5p</td>
        <td align="center" bgcolor="#DDEBF7">2p</td>
        <td align="center" bgcolor="#DDEBF7">1p</td>
        </tr>
      <tr>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['fifty_pence'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['twenty_pence'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['ten_pence'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['five_pence'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['two_pence'], 2, '.', ',' ); ?></td>
        <td align="center"><?php echo '£ ' . number_format( (float) $row2['one_pence'], 2, '.', ',' ); ?></td>
        </tr>
    </table></td>
  </tr>
  <?php
  $row++;
  }
  ?>
</table>

<?php
}
?>
</body>
</html>