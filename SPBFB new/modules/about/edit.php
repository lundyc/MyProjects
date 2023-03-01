<?php
if (isset($_SESSION['userID'])) {

$isadmin = $mysqli->query("SELECT `admin` FROM `members` WHERE `id` = '".$_SESSION['userID']."';");
$level = $isadmin->fetch_assoc();

if ($level['admin'] == 1) {

if (isset($_GET['memberID'])) {

include_once("editmember.php");
} else {
include_once("editabout.php");
}

} else {
die("YOU CANNOT EDIT THIS SECTION"); 
}

} else {
die("YOU CANNOT EDIT THIS SECTION");
}

?>