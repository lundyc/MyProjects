<?php
include "header.php";

session_start();
if (($_SESSION['perm'] < "5"))  {
echo "<font color='#$col_text'>"; die ('You are not authorised to access this section');
}

$squad_id = $_GET['squad_id'];

$query="SELECT * FROM match_squad WHERE squad_id = '$squad_id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {

$name = $row["playername"];
$match_id = $row["match_id"];
							}


$query="UPDATE users SET selected='no' WHERE displayname='$name'"; 
@mysql_select_db($db_name) or die( "Unable to select database");
mysql_query($query); 


mysql_query("DELETE FROM match_squad WHERE playername = '$name' AND squad_id = '$squad_id' ")
or die(mysql_error());


?>

<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=selectsquad.php<?php echo "?fileId="; echo "$match_id";?>">
">


<HTML>
<HEAD>
<TITLE>Delete Member</TITLE>
</HEAD>
<BODY>

</BODY> 
</HTML>

