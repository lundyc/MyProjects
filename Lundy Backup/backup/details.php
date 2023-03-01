<?php
$DB_NAME = 'subwayir_cash';
$DB_HOST = 'localhost';
$DB_USER = 'subwayir_cash';
$DB_PASS = 'piperhill67';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
$("td.details").live('click', function(){
$(this).closest('tr').next('tr').toggle();
});
   
//
</script>

<style>
.more { 
display: none;
}
</style>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td>Date</td>
    <td><p>[Date Selector ]</p></td>
    <td align="right">Welcome $user (Change Password | Logout)</td>
  </tr>
</table>

<br />

<table width="100%" border="1" id="info">
  <tr>
    <td align="center">Time</td>
    <td align="center">Clerk</td>
    <td colspan="2" align="center">Cash</td>
    <td align="center">Bread</td>
    <td align="center">Flatbread</td>
  </tr>
  <?php
  $dates = array();
  
  $days = "  SELECT `CashID`, DATE(`Date`) as `Date2`, `Date`
FROM  `cash`
GROUP BY DAY(`Date`) ORDER BY `Date` DESC";

  $query1 = $mysqli->query($days);
  
  while ($row1 = $query1->fetch_assoc()) {
?>	  
    <tr>
    <td colspan="6" align="center"><?php echo $row1['Date2']; ?></td>
  </tr>
  
  
  <?php
  $q = "SELECT 
  `Date`, 
  DATE_FORMAT( DATE,  '%h:%i:%s' ) AS  `ftime` ,  
  DATE_FORMAT( DATE, '%H') AS `hour`, 
  `Staff_Name` , (
`fifty_pound` +  `twenty_pound` +  `ten_pound` +  `five_pound` +  `one_pound` +  `fifty_pence` +  `twenty_pence` +  `ten_pence` + `five_pence` +  `one_pence` +  `change`
) AS  `total` ,  `bread` ,  `flatbread` 
FROM  `cash` WHERE DATE(Date) = '".$row1['Date2']."'";
  $query = $mysqli->query($q);
  
  $row = 1;
  while ($row2 = $query->fetch_assoc()) { 
  
  $test = end($dates);
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
    <td align="center" class="details"><?php echo $row2['ftime']; ?></td>
    <td align="center" class="details"><?php echo $row2['Staff_Name']; ?></td>
    <td align="left" class="details">£</td>
    <td align="center" class="details" style="background-color: <?php echo $tbgolor; ?>"><?php echo number_format($row2['total'], 2, '.', ''); ?></td>
    <td align="center" class="details"><?php echo number_format($row2['bread'], 2, '.', ''); ?></td>
    <td align="center" class="details"><?php echo number_format($row2['flatbread'], 2, '.', ''); ?></td>
  </tr>
  
  <tr class="more">
    <td colspan="6" align="center"><table width="100%" border="1">
      <tr>
        <td align="center">£50</td>
        <td align="center">£20</td>
        <td align="center">£10</td>
        <td align="center">£5</td>
        <td align="center">£1</td>
        <td align="center">50p</td>
        <td align="center">20p</td>
        <td align="center">10p</td>
        <td align="center">5p</td>
        <td align="center">2p</td>
        <td align="center">1p</td>
        <td align="center">Change</td>
        <td align="center">Total</td>
        <td align="center">Bread</td>
        <td align="center">Flatbread</td>
        <td align="center">&nbsp;</td>
        </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">[Ed] [Del]</td>
        </tr>
    </table></td>
  </tr>
  <?php
  $row++;
  }
  }
  ?>
</table>
</body>
</html>