<?php
include_once ("_config.php");

$username = $_POST['username'];
$password = $_POST['password'];
$md5pass = md5($password);

$query = "SELECT `teamID` FROM `teams` WHERE `username` = '" . $username . "' AND `password` = '" . $md5pass . "';";
$res = $mysqli->query($query);
if ($res->num_rows == 0)
{
    echo "Bad";
}
else
{
    $row = $res->fetch_array();
    $_SESSION['teamID'] = $row['teamID'];
    header("Location: /quiz/index.php");
}
?>