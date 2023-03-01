<?php

if (isset($_GET['status']) && $_GET['status'] != '') {
	$status = $_GET['status'];
	$sql2   = " AND od_status = '$status'";
	$queryString = "&status=$status";
} else {
	$status = '';
	$sql2   = '';
	$queryString = '';
}	

// for paging
// how many rows to show per page
$rowsPerPage = 10;

$sql = "SELECT o.od_id, o.od_shipping_first_name, od_shipping_last_name, od_date, od_status,
               SUM(pd_price * od_qty) + od_shipping_cost AS od_amount
	    FROM tbl_order o, tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and o.od_id = oi.od_id $sql2
		GROUP BY od_id
		ORDER BY od_id DESC";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $stat) {
	$orderOption .= "<option value=\"$stat\"";
	if ($stat == $status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$stat</option>\r\n";
}
?> 

<script language="javascript" src="scripts/shop.js"></script>
<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Site Shop Orders</div>
  </h2>
 <p>
 	<br />
insert description here
 	<br />
 	&nbsp; </p>
</div>
<br >
<form action="processOrder.php" method="post"  name="frmOrderList" id="frmOrderList">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
 <tr align="center"> 
  <td align="right">View</td>
  <td width="75"><select name="cboOrderStatus" class="box" id="cboOrderStatus" onChange="viewOrder();">
    <option value="" selected>All</option>
    <?php echo $orderOption; ?>
  </select></td>
  </tr>
</table>


<div class='tableheaderalt'>(still to be coded)</div>




<table cellpadding='4' cellspacing='0' width='100%'>
  <tr> 
   <td class='tablesubheader'>Order #</td>
   <td class='tablesubheader'>Customer Name</td>
   <td width="60" class='tablesubheader'>Amount</td>
   <td width="150" class='tablesubheader'>Order Time</td>
   <td width="70" class='tablesubheader'>Status</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		$name = $od_shipping_first_name . ' ' . $od_shipping_last_name;
		
		if ($i%2) {
			$class = 'tablerow1';
		} else {
			$class = 'tablerow2';
		}
		
		$i += 1;
?>
<tr class="<?php echo $class; ?>"> 
<td width="60">
<a href="index.php?manager=shop&action=detail&oid=<?php echo $od_id; ?>">
<?php echo $od_id; ?>
</a>
</td>

<td><?php echo $name ?></td>
   <td width="60"><?php echo displayAmount($od_amount); ?></td>
   <td width="150"><?php echo $od_date; ?></td>
   <td width="70"><?php echo $od_status; ?></td>
  </tr>
  <?php
	} // end while

?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
   echo $pagingLink;
   ?></td>
  </tr>
<?php
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Orders Found </td>
  </tr>
  <?php
}
?>

 </table>
 <p>&nbsp;</p>
</form>