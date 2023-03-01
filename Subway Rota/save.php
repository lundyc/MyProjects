<?php
$link = mysqli_connect("localhost","lundy_subway","e039288466","lundy_subway") or die("Error " . mysqli_error($link));

$staffID = $_POST['StaffID1'];
$start_date = $_POST['date'];
$start_time = $_POST['stime'];
$end_date = $_POST['date'];
$end_time = $_POST['etime'];

if (isset($_POST['RotaID'])) {

if ($_POST['stime'] == "off" && $_POST['etime'] == "off") {
$stmt = $link->prepare("DELETE FROM `rota` WHERE RotaID = ?");
$stmt->bind_param('i', $_POST['RotaID']);
} else {
$stmt = $link->prepare("UPDATE `rota` SET `start_time` = ?, 
   `end_time` = ? 
   WHERE `RotaID` = ?");
$stmt->bind_param('ssi',
   $_POST['stime'],
   $_POST['etime'],
   $_POST['RotaID']);
   
  }
  
   } else {
  $stmt = $link->prepare("INSERT INTO `rota` (`StaffID` ,`start_date` ,`start_time` ,`end_date` ,`end_time`) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param('issss', $staffID ,$start_date, $start_time,$end_date,$end_time); 
}

$stmt->execute(); 
$stmt->close();
if ($_POST['stime'] == "off" && $_POST['etime'] == "off") {
echo "off";
} else {
printf(date("g", strtotime($start_time)) ." - " . date("g", strtotime($end_time)));
}

?>