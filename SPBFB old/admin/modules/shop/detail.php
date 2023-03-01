<?php
if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	header('Location: index.php');
}

$orderId = (int)$_GET['oid'];

    
if (isset($_GET['status'])) {	
$sql = "UPDATE tbl_order SET od_status = '{$_GET['status']}', od_last_update = NOW() WHERE od_id = $orderId";
$result = mysql_query($sql);
}

// get ordered items
$sql = "SELECT pd_name, pd_price, od_qty
	    FROM tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
		ORDER BY od_id ASC";

$result = mysql_query($sql);
$orderedItem = array();
while ($row = mysql_fetch_assoc($result)) {
	$orderedItem[] = $row;
}


// get order information
$sql = "SELECT od_date, od_last_update, od_status, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
               od_shipping_address2, od_shipping_phone, od_shipping_state, od_shipping_city, od_shipping_postal_code, od_shipping_cost, 
			   od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2, od_payment_phone,
			   od_payment_state, od_payment_city , od_payment_postal_code,
			   od_memo,
			   
			   DATE_FORMAT(`od_date`, '%W, %D %M %Y @ %r') as `order_date`,
			   DATE_FORMAT(`od_last_update`, '%W, %D %M %Y @ %r') as `last_order_date`
			   
	    FROM tbl_order 
		WHERE od_id = $orderId";

$result = mysql_query($sql);
extract(mysql_fetch_assoc($result));

$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $status) {
	$orderOption .= "<option value=\"$status\"";
	if ($status == $od_status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$status</option>\r\n";
}

if (empty($od_memo)) {
$od_memo = 'no memo left';
}
?>

<script language="javascript" src="scripts/shop.js"></script>
<div class='tableborder'>
 <div class='tableheaderalt'>Order Detail</div>



<form action="" method="get" name="frmOrder" id="frmOrder">
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr> 
<td width="150" class='tablerow1'>Order Number</td>
<td class='tablerow2'><?php echo $orderId; ?></td>
</tr>

<tr> 
<td width="150" class='tablerow1'>Order Date</td>
<td class='tablerow2'><?php echo $order_date; ?></td>
</tr>

<tr> 
<td width="150" class='tablerow1'>Last Update</td>
<td class='tablerow2'><?php echo $last_order_date; ?></td>
</tr>
<tr> 
<td class='tablerow1'>Status</td>
<td class='tablerow2'>
<select name="cboOrderStatus" id="cboOrderStatus" class="box">
<?php echo $orderOption; ?> 
</select> 
<input name="btnModify" type="button" id="btnModify" value="Modify Status" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);">
</td>
</tr>
</table>
</div>

<br>

<div class='tableborder'>
 <div class='tableheaderalt'>Ordered Item(s)</div>
 
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
    <tr align="center"> 
        <td class='tablerow1'>Item</td>
        <td class='tablerow1'>Unit Price</td>
        <td class='tablerow1'>Total</td>
    </tr>
    <?php
$numItem  = count($orderedItem);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($orderedItem[$i]);
	$subTotal += $pd_price * $od_qty;
?>
<tr> 
<td class='tablerow2'><?php echo "$od_qty X $pd_name"; ?></td>
<td class='tablerow2' align="right"><?php echo displayAmount($pd_price); ?></td>
<td class='tablerow2' align="right"><?php echo displayAmount($od_qty * $pd_price); ?></td>
    </tr>
    <?php
}
?>
    <tr class='tablerow2'> 
        <td colspan="2" align="right">Sub-total</td>
        <td align="right"><?php echo displayAmount($subTotal); ?></td>
    </tr>
    <tr class='tablerow2'> 
        <td colspan="2" align="right">Shipping</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost); ?></td>
    </tr>
    <tr class='tablerow2'> 
        <td colspan="2" align="right">Total</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost + $subTotal); ?></td>
    </tr>
</table>
</div>
<br>

<div class='tableborder'>
 <div class='tableheaderalt'>Shipping Information</div>
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
    <tr> 
        <td width="150" class='tablerow1'>First Name</td>
        <td class='tablerow2'><?php echo $od_shipping_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Last Name</td>
        <td class='tablerow2'><?php echo $od_shipping_last_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Address1</td>
        <td class='tablerow2'><?php echo $od_shipping_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Address2</td>
        <td class='tablerow2'><?php echo $od_shipping_address2; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Phone Number</td>
        <td class='tablerow2'><?php echo $od_shipping_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Province / State</td>
        <td class='tablerow2'><?php echo $od_shipping_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>City</td>
        <td class='tablerow2'><?php echo $od_shipping_city; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Postal Code</td>
        <td class='tablerow2'><?php echo $od_shipping_postal_code; ?> </td>
    </tr>
</table>
</div>
<br>

<div class='tableborder'>
 <div class='tableheaderalt'>Payment Information</div>
 
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
    <tr> 
        <td width="150" class='tablerow1'>First Name</td>
        <td class='tablerow2'><?php echo $od_payment_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Last Name</td>
        <td class='tablerow2'><?php echo $od_payment_last_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Address1</td>
        <td class='tablerow2'><?php echo $od_payment_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Address2</td>
        <td class='tablerow2'><?php echo $od_payment_address2; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Phone Number</td>
        <td class='tablerow2'><?php echo $od_payment_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Province / State</td>
        <td class='tablerow2'><?php echo $od_payment_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>City</td>
        <td class='tablerow2'><?php echo $od_payment_city; ?> </td>
    </tr>
    <tr> 
        <td width="150" class='tablerow1'>Postal Code</td>
        <td class='tablerow2'><?php echo $od_payment_postal_code; ?> </td>
    </tr>
</table>
</div>
<br>

<div class='tableborder'>
 <div class='tableheaderalt'>Buyer's Memo</div>
 
<table width='100%' cellspacing='0' cellpadding='5' align='center' border='0'>
    <tr> 
        <td colspan="2" class='tablerow1'><?php echo nl2br($od_memo); ?> </td>
    </tr>
</table>

</form>
</div>

<p align="center"> 
    <input name="btnBack" type="button" id="btnBack" value="Back" class="box" onClick="window.history.back();">
</p>
