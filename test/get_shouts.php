<?php
include("_mysqli.php");
/*
if (!isset($_SESSION['userID'])) } 
die("your dead"); 
}
*/
header("Cache-Control: no-cache, must-revalidate", true); 
header("Expires: Sat, 1 Jan 2005 00:00:00 GMT");
header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
//header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

function clickable($url){
        $in=array(
        '`((?:https?|ftp)://\S+[[:alnum:]]/?)`si',
        '`((?<!//)(www\.\S+[[:alnum:]]/?))`si'
        );
        $out=array(
        '<a href="$1" rel="nofollow" target="_blank">(LINK)</a> ',
        '<a href="http://$1" rel="nofollow" target="_blank">(LINK)</a>'
        );
        return preg_replace($in,$out,$url);
}

$testData = array();
$query_shoutbox = "SELECT `shoutbox`.`id`, `shoutbox`.`message`, `shoutbox`.`date`, `shoutbox`.`UserID`, (SELECT `nickname` FROM `profile` WHERE `mid` = `shoutbox`.`UserID`) AS `nick_name` FROM `shoutbox` WHERE date > ".$_GET['time']." ORDER BY `shoutbox`.`date` DESC LIMIT 50;";
$res = $mysqli->query($query_shoutbox);

while($row = $res->fetch_assoc()){

$dateformat = date("d-m-y", $row['date']);

if ($dateformat == date("d-m-y", mktime(0, 0, 0, date("m"), date("d"), date("Y")))) {
$date = date("g:i a", $row['date']); 
} else if ($dateformat == date("d-m-y", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")))) {
$date = "Yesterday, ". date("g:i a", $row['date']); 
} else {
$date = date("M j Y, g:i A", $row['date']);
}

$row['date_posted'] = $date;
($row['UserID'] == $_SESSION['userID']) ? $row['nick_color'] = "color: #06C; " : '';

$row['message'] = clickable(nl2br($row['message']));
$row['nick_name'] = $row['nick_name'];

$testData[] = $row;
}

echo json_encode($testData);
//mysql_close($link);



usleep(100000);
?>