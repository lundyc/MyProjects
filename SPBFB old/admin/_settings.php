<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//

error_reporting(E_ALL); 	//0 = public mode, E_ALL = development-mode
$showchat = true;

session_name('spb_session');
session_start();

mysql_connect($host, $user, $pwd) or system_error('ERROR: Can not connect to MySQL-Server',0);
mysql_select_db($db) or system_error('ERROR: Can not connect to database "'.$db.'"',0);
mysql_query("UPDATE `events` SET `status` = '1' WHERE `start_time` < '".time()."' AND status='0'");

// styles
$ergebnis = safe_query("SELECT * FROM settings");
$ds=mysql_fetch_array($ergebnis);

define("PAGETITLE", $ds['title']);
define("DEBUG", $ds['debug']);
$closed = $ds['closed'];

$timeout = 2; 
$deltime = time()-60;
$wasdeltime = time()-86400;
$ip = getip();
//$site = $_GET['view'];
?>