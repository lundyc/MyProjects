<?php
function level($uid) {
	$q = mysql_query("SELECT `level` FROM `members` WHERE id='$uid' LIMIT 1;");
	$res = mysql_fetch_array($q);
	return $res['0'];
}

function isactive() {
$timestamp = time();
$timeout = $timestamp-120;

mysql_query("REPLACE INTO `online_users` SET `UserID`='".$_SESSION['uid']."', `page` = '".$_SERVER['QUERY_STRING']."', `lastview` = '".$timestamp."', `ip` = '".ip2long(getip())."';");
//mysql_query("DELETE FROM `online_users` WHERE `lastview` < $timeout");

}

function checkquotes($input) {
return (!get_magic_quotes_gpc()) ? trim(addslashes(htmlentities($input, ENT_QUOTES))) : $input;
}

function freeRTE_Preload($content) {
	// Strip newline characters.
	$content = str_replace(chr(10), " ", $content);
	$content = str_replace(chr(13), " ", $content);
	// Replace single quotes.
	$content = str_replace(chr(145), chr(39), $content);
	$content = str_replace(chr(146), chr(39), $content);
	
	$content = str_replace(chr(39), "&#39", $content);
	// Return the result.
	return $content;
}

function redirect($url, $tps)
{
    $temps = $tps * 1000;

    echo "<script type=\"text/javascript\">\n"
    . "<!--\n"
    . "\n"
    . "function redirect() {\n"
    . "window.location='" . $url . "'\n"
    . "}\n"
    . "setTimeout('redirect()','" . $temps ."');\n"
    . "\n"
    . "// -->\n"
    . "</script>\n";
} 

// Added for the shop
function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	
	return mysql_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}

function displayAmount($amount) {
return "£" . number_format($amount, 2, '.', '');
}

function getPagingQuery($sql, $itemPerPage = 10)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
}

function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
{
	$result        = dbQuery($sql);
	$pagingLink    = '';
	$totalResults  = dbNumRows($result);
	$totalPages    = ceil($totalResults / $itemPerPage);
	
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		

		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			if ($page > 1) {
				$prev = " <a href=\"$self?page=$page&$strGet/\">[Prev]</a> ";
			} else {
				$prev = " <a href=\"$self?$strGet\">[Prev]</a> ";
			}	
				
			$first = " <a href=\"$self?$strGet\">[First]</a> ";
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\">[Next]</a> ";
			$last = " <a href=\"$self?page=$totalPages&$strGet\">[Last]</a> ";
		} else {
			$next = ''; // we're on the last page, don't show 'next' link
			$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
				$pagingLink[] = " $page ";   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = " <a href=\"$self?$strGet\">$page</a> ";
				} else {	
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";
				}	
			}
	
		}
		
		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
	}
	
	return $pagingLink;
}

function getShopConfig()
{
	// get current configuration
	$sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_order_email, cy_symbol 
			FROM tbl_shop_config sc, tbl_currency cy
			WHERE sc_currency = cy_id";
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);

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


?>
