<?php
require 'lib/password.php';

$password = $_GET['p'];
$hash = password_hash($_GET['p'], PASSWORD_BCRYPT);

echo htmlentities($_GET['p']) ."<br>";
echo $hash;

/*$password = "johnmckee";

if (password_verify($password, $hash)) {
echo "ok";
} else {
echo "no";
}
*/
?>