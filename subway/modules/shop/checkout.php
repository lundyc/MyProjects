<div class="module"><div class="mb"><h2>Shop</h2>
<?php

function isCartEmpty()
{
global $mysqli;
	$isEmpty = false;
	
	$sid = session_id();
	$sql = "SELECT ct_id
			FROM tbl_cart ct
			WHERE ct_session_id = '$sid'";
	
	$result = $mysqli->query($sql);
	
	if ($result->num_rows == 0) {
		$isEmpty = true;
	}	
	
	return $isEmpty;
}

function checkRequiredPost($requiredField) {
	$numRequired = count($requiredField);
	$keys        = array_keys($_POST);
	
	$allFieldExist  = true;
	for ($i = 0; $i < $numRequired && $allFieldExist; $i++) {
		if (!in_array($requiredField[$i], $keys) || $_POST[$requiredField[$i]] == '') {
			$allFieldExist = false;
		}
	}
	
	return $allFieldExist;
}

function getCartContent()
{
	$cartContent = array();

	$sid = session_id();
	$sql = "SELECT ct_id, ct.pd_id, ct_qty, pd_name, pd_price, pd_thumbnail, pd.cat_id
			FROM tbl_cart ct, tbl_product pd, tbl_category cat
			WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND cat.cat_id = pd.cat_id";
	
	$result = $mysqli->query($sql);
	
	while ($row = $mysqli->fetch_assoc()) {
		if ($row['pd_thumbnail']) {
			$row['pd_thumbnail'] = 'images/product/' . $row['pd_thumbnail'];
		} else {
			$row['pd_thumbnail'] = 'images/no-image-small.png';
		}
		$cartContent[] = $row;
	}
	
	return $cartContent;
}

if (isCartEmpty()) {
	// the shopping cart is still empty
	// so checkout is not allowed
	redirect('./?view=shop&action=cart');
} else if (isset($_GET['step']) && (int)$_GET['step'] > 0 && (int)$_GET['step'] <= 3) {
	$step = (int)$_GET['step'];

	$includeFile = '';
	if ($step == 1) {
		$includeFile = 'shippingAndPaymentInfo.php';
		$pageTitle   = 'Checkout - Step 1 of 2';
	} else if ($step == 2) {
		$includeFile = 'checkoutConfirmation.php';
		$pageTitle   = 'Checkout - Step 2 of 2';
	} else if ($step == 3) {
	
	
	function saveOrder()
{ 
global $shopConfig;
	$orderId       = 0;
	$shippingCost  = $shopConfig['shippingCost'];
	$requiredField = array('hidShippingFirstName', 'hidShippingLastName', 'hidShippingAddress1', 'hidShippingCity', 'hidShippingPostalCode',
						   'hidPaymentFirstName', 'hidPaymentLastName', 'hidPaymentAddress1', 'hidPaymentCity', 'hidPaymentPostalCode');
						   
	if (checkRequiredPost($requiredField)) {
	    extract($_POST);
		
		// make sure the first character in the 
		// customer and city name are properly upper cased
		$hidShippingFirstName = ucwords($hidShippingFirstName);
		$hidShippingLastName  = ucwords($hidShippingLastName);
		$hidPaymentFirstName  = ucwords($hidPaymentFirstName);
		$hidPaymentLastName   = ucwords($hidPaymentLastName);
		$hidShippingCity      = ucwords($hidShippingCity);
		$hidPaymentCity       = ucwords($hidPaymentCity);
				
		$cartContent = getCartContent();
		$numItem     = count($cartContent);
		
		// save order & get order id
		$sql = "INSERT INTO tbl_order(od_date, od_last_update, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
		                              od_shipping_address2, od_shipping_phone, od_shipping_state, od_shipping_city, od_shipping_postal_code, od_shipping_cost,
                                      od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2, 
									  od_payment_phone, od_payment_state, od_payment_city, od_payment_postal_code)
                VALUES (NOW(), NOW(), '$hidShippingFirstName', '$hidShippingLastName', '$hidShippingAddress1', 
				        '$hidShippingAddress2', '$hidShippingPhone', '$hidShippingState', '$hidShippingCity', '$hidShippingPostalCode', '$shippingCost',
						'$hidPaymentFirstName', '$hidPaymentLastName', '$hidPaymentAddress1', 
						'$hidPaymentAddress2', '$hidPaymentPhone', '$hidPaymentState', '$hidPaymentCity', '$hidPaymentPostalCode')";
		$result = $mysql->query($sql);
		
		// get the order id
		$orderId = mysql_insert_id();
		
		if ($orderId) {
			// save order items
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "INSERT INTO tbl_order_item(od_id, pd_id, od_qty)
						VALUES ($orderId, {$cartContent[$i]['pd_id']}, {$cartContent[$i]['ct_qty']})";
				$result = $mysqli->query($sql);					
			}
		
			
			// update product stock
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "UPDATE tbl_product 
				        SET pd_qty = pd_qty - {$cartContent[$i]['ct_qty']}
						WHERE pd_id = {$cartContent[$i]['pd_id']}";
				$result = $mysqli->query($sql);					
			}
			
			
			// then remove the ordered items from cart
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "DELETE FROM tbl_cart
				        WHERE ct_id = {$cartContent[$i]['ct_id']}";
				$result = $mysql->query($sql);					
			}							
		}					
	}
	
	return $orderId;
}

function getOrderAmount($orderId)
{
	$orderAmount = 0;
	
	$sql = "SELECT SUM(pd_price * od_qty)
	        FROM tbl_order_item oi, tbl_product p 
		    WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
			
			UNION
			
			SELECT od_shipping_cost 
			FROM tbl_order
			WHERE od_id = $orderId";
	$result = $mysqli->query($sql);

	if ($result->num_rows == 2) {
		$row = $mysqli->fetch_row();
		$totalPurchase = $row[0];
		
		$row = $mysqli->fetch_row();
		$shippingCost = $row[0];
		
		$orderAmount = $totalPurchase + $shippingCost;
	}	
	
	return $orderAmount;	
}
	
	
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
		
		$_SESSION['orderId'] = $orderId;
		
		// our next action depends on the payment method
		// if the payment method is COD then show the 
		// success page but when paypal is selected
		// send the order details to paypal
		if ($_POST['hidPaymentMethod'] == 'cod') {
			redirect('/shop?action=success');
			exit;
		} else {
			$includeFile = 'paypal/payment.php';	
		}
	}
} else {
	// missing or invalid step number, just redirect
	redirect('index.php');
}
?>
<script language="JavaScript" type="text/javascript" src="/checkout.js"></script>
<?php
require_once "modules/shop/includes/$includeFile";
?>

  </div>
</div>
