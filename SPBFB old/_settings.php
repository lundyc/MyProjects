<?php
// -------------------------------------------------------------------------//
// Saltcoats Protestant Boys FB - PHP Portal                                                  //
// http://www.spb-fb.co.uk                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//

error_reporting(e_all); 	//0 = public mode, E_ALL = development-mode
$showchat = true;

session_name('spb_session');
session_start();

$link = mysql_connect($host, $user, $pwd);
mysql_select_db($db) or die('ERROR: Can not connect to database "'.$db.'"');
mysql_query("UPDATE `events` SET `status` = '1' WHERE `start_time` < '".time()."' AND status='0'");

// styles
$ergebnis = mysql_query("SELECT * FROM settings");
$ds=mysql_fetch_array($ergebnis);

define("PAGETITLE", $ds['title']);
define(DEBUG, $ds['debug']);
$closed = $ds['closed'];

$timeout = 2; 
$deltime = time()-60;
$wasdeltime = time()-86400;
$ip = getip();
$site = $_GET['view'];



//$shoutdeltime = time()-(2*24*60*60);

// Lets delete messages which are read and are older than 30 days
//mysql_query("DELETE FROM `shoutbox` WHERE date < $shoutdeltime");
$deltime = time()-120;
$wasdeltime = time()-86400;

mysql_query("DELETE FROM `online_users` WHERE time < $deltime");
mysql_query("DELETE FROM `who_was_online WHERE time < $wasdeltime"); 

if (isset($_SESSION['uid'])) {
// IS ONLINE

if(mysql_num_rows(mysql_query("SELECT userID FROM `online_users` WHERE `userID`='".$_SESSION['uid']."'")) > 0) {

mysql_query("UPDATE `online_users` SET `time`= '".time()."' WHERE `userID`='".$_SESSION['uid']."'");

}	
else mysql_query("INSERT INTO `online_users` (time, userID, nickname, query, ip) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."', '$site', '".$ip."')");
	
// WAS ONLINE
if(mysql_num_rows(mysql_query("SELECT userID FROM `who_was_online` WHERE userID='".$_SESSION['uid']."'")))  
mysql_query("UPDATE `who_was_online` SET time='".time()."', query='$site' WHERE userID='".$_SESSION['uid']."'");
else mysql_query("INSERT INTO `who_was_online` (time, userID, nickname, query) VALUES ('".time()."', '".$_SESSION['uid']."', '".idtoname($_SESSION['uid'])."', '$site')");
} else {
$anz = mysql_num_rows(mysql_query("SELECT `ip` FROM `online_users` WHERE `ip`='".$ip."'"));

if($anz) mysql_query("UPDATE `online_users` SET time='".time()."', query='$site' WHERE ip='".$ip."'");
else mysql_query("INSERT INTO `online_users` (time, ip, query) VALUES ('".time()."','".$ip."', '$site')");
}

function getShopConfig()
{
	// get current configuration
	$sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_order_email, cy_symbol 
			FROM tbl_shop_config sc, tbl_currency cy
			WHERE sc_currency = cy_id";
	$result = mysql_query($sql);
	$row    = mysql_fetch_assoc($result);

    if ($row) {
        extract($row);
	
        $shopConfig = array('name'           => $sc_name,
                            'address'        => $sc_address,
                            'phone'          => $sc_phone,
                            'email'          => $sc_email,
				    'sendOrderEmail' => $sc_order_email,
                            'shippingCost'   => $sc_shipping_cost,
                            'currency'       => $cy_symbol);
    } else {
        $shopConfig = array('name'           => '',
                            'address'        => '',
                            'phone'          => '',
                            'email'          => '',
				    'sendOrderEmail' => '',
                            'shippingCost'   => '',
                            'currency'       => '');    
    }

	return $shopConfig;						
}

$shopConfig = getShopConfig();

?>