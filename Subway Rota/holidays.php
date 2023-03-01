<?php
session_start();

if (!isset($_SESSION['userID'])) {
	header("location: login.php");
}

$link = mysqli_connect("localhost","lundy_subway","e039288466","lundy_subway") or die("Error " . mysqli_error($link));

$admin_query = "SELECT `admin` FROM  `staff` WHERE `StaffID` = '".$_SESSION['userID']."';";
$admin = $link->query($admin_query);
$adminr = mysqli_fetch_array($admin, MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src=""></script>

<link rel="stylesheet" href="css/main.css?v=1">
<link rel="stylesheet" href="css/print.css?v=1">

<title>Staff Portal - HOLIDAYS</title>
</head>

<body>
<div id="nav">
<ul>
<li><a href="/index.php">Home</a></li>
<li><a href="/holidays.php">Holidays</a></li>
<?php
if ($adminr['admin'] > 0) {
?>
<li><a id="print" href="#print">Print Rota</a></li>
<?php
}
?>
<li style="float: right;"><a href="/logout.php">Logout</a></li>
</ul>
</div>
   
   <div id="weekDate">
   My Holidays
   </div>
   
<table>
<tr>
<th width="20%">From</th>
<th width="20%">To</th>
<th width="5%">Days</th>
<th width="10%">Status</th>
<th width="45%">Note</th>
</tr>

<tr>
<td class="bg1"><input type="date" name="from"></td>
<td class="bg1"><input type="date" name="to"></td>
<td class="bg1"></td>
<td class="bg1"></td>
<td class="bg1"><input type="text" name="note" style="width: 90%; height: 100%;"></td>
</tr>
 
<?php
$query = "SELECT DATE_FORMAT(`from`, '%a, %D %b %Y') as `dfrom`, DATE_FORMAT(`to`, '%a, %D %b %Y') as `dto`, DATEDIFF(`to`, `from`) as `total`, `status`, `note` FROM  `holiday` WHERE `StaffID` = '".$_SESSION['userID']."';";
$result = $link->query($query);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$bgcolor = ($bgcolor == "bg2") ? 'bg1' : 'bg2';

echo '<tr>';
echo '<td class="'.$bgcolor.'">'. $row['dfrom'] .'</td>';
echo '<td class="'.$bgcolor.'">' . $row['dto'] .'</td>';
echo '<td class="'.$bgcolor.'" align="center" >' .$row['total'] .'</td>';
echo '<td class="'.$bgcolor.'" align="center">' . $row['status'] .'</td>';
echo '<td class="'.$bgcolor.'" align="center">'. $row['note'] .'</td>';
echo '</tr>';
}
?>

</table>
</body>
</html>