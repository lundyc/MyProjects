<?php

include("_mysql.php");
include("_functions.php");
include("_settings.php");
include_once("admin_functions.inc.php");

if(isset($_GET['action']) && $_GET['action'] == "write") {
$final = '--   SPB-FB.co.uk database backup
--   Code: Colin Lundy (lundy.me.uk)
--   Date Exported: '. date("l dS \of F Y h:i:s A").'
--
--
--   PHP version: '.phpversion().'
--   MySQL version: '.mysql_get_server_info().'
';

$result = mysql_list_tables($db);

	while ($table = mysql_fetch_row($result)) {

   $i = 0;
   $result2 = mysql_query("SHOW COLUMNS FROM $table[0]");
   $z = mysql_num_rows($result2);
  
 $final .= "\n--\n-- SPB-FB.co.uk - DB-Export: Table '".$table[0]."'\n--\n\n";
$final .= "CREATE TABLE `".$table[0]."` (\n";

while ($row2 = mysql_fetch_assoc($result2)) {
$i++;

  
$final .= "`".$row2['Field']."` ".$row2['Type']; // `EventID` int(11)
if($row2['Null'] != "YES") { $final .= " NOT NULL "; } // NOT NULL
if(!empty($row2['Extra'])) { $final .= $row2['Extra']; } else {
$final .= " default '".$row2['Default']."'";
}

if($i < $z) $final .= ",\n ";

if ($row2['Key']) { 
$key = "\nPRIMARY KEY  (`".$row2['Field']."`)";
}

	   }
$final .= $key;
$final .= "\n) ENGINE=MyISAM  DEFAULT CHARSET=latin1;\n";

    $inhaltq = mysql_query("SELECT * FROM $table[0]");

    while($inhalt = mysql_fetch_array($inhaltq,MYSQL_BOTH)) {

        $final .= "\nINSERT INTO `$table[0]` (";
        $names = array_keys($inhalt);
        $az = count($inhalt)/2; 

        for($i=0;$i<$az;$i++) {

           $final .= "`".$names[(2*$i+1)]."`"; 
           if(($i+1)<$az) $final .= ", ";

        }
        $final .= ") VALUES (";

        for($i=0;$i<$z;$i++) {

           $einschub = "'".str_replace("'","`", $inhalt[$i])."'";
           $final .= preg_replace('/\r\n|\r|\n/', '\r\n', $einschub);
           if(($i+1)<$z) $final .= ", ";

        }

        $final .= ");";

    }



    $final .= "\n";

	}

		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
  	header("Content-Description: File Transfer");

		if(is_integer(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "msie")) AND is_integer(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "win" ))) header("Content-Disposition: filename=backup.sql;");
		else header("Content-Disposition: attachment; filename=backup.sql;");
		header("Content-Transfer-Encoding: binary");
		echo nl2br($final);
}
?>