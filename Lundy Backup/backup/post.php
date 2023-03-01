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

$sql = "INSERT INTO `cash` (
`Date`, 
`Staff_Name`, 
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
`flatbread`) 
VALUES (
'".date('Y-m-d H:i:s')."', 
'".$_POST['staff_name']."', 
'".$_POST['50n']."', 
'".$_POST['20n']."', 
'".$_POST['10n']."', 
'".$_POST['5n']."', 
'".$_POST['1pound']."', 
'".$_POST['50p']."', 
'".$_POST['20p']."', 
'".$_POST['10p']."', 
'".$_POST['5p']."', 
'".$_POST['2p']."', 
'".$_POST['1p']."', 
'".$_POST['change']."', 
'".$_POST['bread']."', 
'".$_POST['flatbread']."');";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
?>