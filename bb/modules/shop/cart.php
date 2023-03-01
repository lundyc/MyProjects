<div class="module"><div class="mb"><h2>Shop</h2>
<?php
$action2 = (isset($_GET['action2']) && $_GET['action2'] != '') ? $_GET['action2'] : 'view';

function deleteFromCart($cartId = 0)
{
global $mysqli;
	if (!$cartId && isset($_GET['cid']) && (int)$_GET['cid'] > 0) {
		$cartId = (int)$_GET['cid'];
	}

	if ($cartId) {	
		$sql  = "DELETE FROM tbl_cart
				 WHERE ct_id = $cartId";

		$result = $mysqli->query($sql);
	}
	
	//header('Location: cart.php');	
}

switch ($action2) {
	case 'add' :
	// make sure the product id exist
	if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
		$productId = (int)$_GET['p'];
	} else {
echo "bug";
	
	echo "<script>location.";
	//	redirect("index.php?view=shop");
	}
	
	// does the product exist ?
	$sql = "SELECT pd_id, pd_qty
	        FROM tbl_product
			WHERE pd_id = $productId";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows != 1) {
		// the product doesn't exist
//	redirect("./?view=shop&action=cart");
	} else {
		// how many of this product we
		// have in stock
		$row = $result->fetch_assoc();
		$currentStock = $row['pd_qty'];

		if ($currentStock == 0) {
			// we no longer have this product in stock
			// show the error message
		//	setError('The product you requested is no longer in stock');
			header('Location: cart.php');
			exit;
		}

	}		
	
	// current session id
	$sid = session_id();
	
	// check if the product is already
	// in cart table for this session
	$sql = "SELECT pd_id
	        FROM tbl_cart
			WHERE pd_id = $productId AND ct_session_id = '$sid'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows == 0) {
		// put the product in cart table
		$sql = "INSERT INTO tbl_cart (pd_id, ct_qty, ct_session_id, ct_date)
				VALUES ($productId, 1, '$sid', NOW())";
		$result = $mysqli->query($sql);
	} else {
		// update product quantity in cart table
		$sql = "UPDATE tbl_cart 
		        SET ct_qty = ct_qty + 1
				WHERE ct_session_id = '$sid' AND pd_id = $productId";		
				
		$result = $mysqli->query($sql);		
	}	
	
	// an extra job for us here is to remove abandoned carts.
	// right now the best option is to call this function here
	$yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	$sql = "DELETE FROM tbl_cart
	        WHERE ct_date < '$yesterday'";
	$mysqli->query($sql);
	
//redirect($_SESSION['shop_return_url']);				

		break;
	case 'update' :
	function updateCart()
{

global $mysqli;
	$cartId     = $_POST['hidCartId'];
	$productId  = $_POST['hidProductId'];
	$itemQty    = $_POST['txtQty'];
	$numItem    = count($itemQty);
	$numDeleted = 0;
	$notice     = '';
	
	for ($i = 0; $i < $numItem; $i++) {
		$newQty = (int)$itemQty[$i];
		if ($newQty < 1) {
			// remove this item from shopping cart
			deleteFromCart($cartId[$i]);	
			$numDeleted += 1;
		} else {
			// check current stock
			$sql = "SELECT pd_name, pd_qty
			        FROM tbl_product 
					WHERE pd_id = {$productId[$i]}";
			$result = $mysqli->query($sql);
			$row    = $result->fetch_assoc();
			
			if ($newQty > $row['pd_qty']) {
				// we only have this much in stock
				$newQty = $row['pd_qty'];

				// if the customer put more than
				// we have in stock, give a notice
				if ($row['pd_qty'] > 0) {
					setError('The quantity you have requested is more than we currently have in stock. The number available is indicated in the &quot;Quantity&quot; box. ');
				} else {
					// the product is no longer in stock
					setError('Sorry, but the product you want (' . $row['pd_name'] . ') is no longer in stock');

					// remove this item from shopping cart
					deleteFromCart($cartId[$i]);	
					$numDeleted += 1;					
				}
			} 
							
			// update product quantity
			$sql = "UPDATE tbl_cart
					SET ct_qty = $newQty
					WHERE ct_id = {$cartId[$i]}";
				
			$mysqli->query($sql);
		}
	}
	
	if ($numDeleted == $numItem) {
		// if all item deleted return to the last page that
		// the customer visited before going to shopping cart
		redirect($returnUrl. $_SESSION['shop_return_url']);
	} else {
	redirect("/shop&action=cart");
	}
	
	exit;
}
	
		updateCart();
		break;	
	case 'delete' :
		deleteFromCart();
		break;
	case 'view' :
}

	$cartContent = array();

	$sid = session_id();
	$sql = "SELECT ct_id, ct.pd_id, ct_qty, pd_name, pd_price, pd_thumbnail, pd.cat_id
			FROM tbl_cart ct, tbl_product pd, tbl_category cat
			WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND cat.cat_id = pd.cat_id";
	
	$result = $mysqli->query($sql);
	
	while ($row = $result->fetch_assoc()) {
		if ($row['pd_thumbnail']) {
			$row['pd_thumbnail'] = 'images/product/' . $row['pd_thumbnail'];
		} else {
			$row['pd_thumbnail'] = 'images/no-image-small.png';
		}
		$cartContent[] = $row;
	}

$numItem = count($cartContent);

// show the error message ( if we have any )
//displayError();

if ($numItem > 0 ) {
?>
<form action="/shop?action=cart&action2=update" method="post" name="frmCart" id="frmCart">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr class="entryTableHeader"> 
   <td colspan="2" align="center">Item</td>
   <td align="center">Unit Price</td>
   <td width="75" align="center">Quantity</td>
   <td align="center">Total</td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
 <?php
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$productUrl = "/shop?action=detail&c=$cat_id&p=$pd_id";
	$subTotal += $pd_price * $ct_qty;
?>
 <tr class="content"> 
  <td width="80" align="center"><a href="<?php echo $productUrl; ?>"><img src="<?php echo $pd_thumbnail; ?>" border="0"></a></td>
  <td><a href="<?php echo $productUrl; ?>"><?php echo $pd_name; ?></a></td>
   <td align="right"><?php echo "&pound;" . number_format($pd_price,2); ?></td>
  <td width="75"><input name="txtQty[]" type="text" id="txtQty[]" size="5" value="<?php echo $ct_qty; ?>" class="box" onKeyUp="checkNumber(this);">
  <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
  <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
  </td>
  <td align="right"><?php echo "&pound;" . number_format($pd_price * $ct_qty, 2); ?></td>
  <td width="75" align="center"> <input name="btnDelete" type="button" id="btnDelete" value="Delete" onClick="window.location.href='/shop?action=cart&action2=delete&cid=<?PHP echo $ct_id; ?>';" class="box"> 
  </td>
 </tr>
 <?php
}
?>
 <tr class="content"> 
  <td colspan="4" align="right">Sub-total</td>
  <td align="right"><?php echo number_format($subTotal, 2); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Shipping </td>
  <td align="right"><?php echo number_format($shopConfig['shippingCost'], 2); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
<tr class="content"> 
   <td colspan="4" align="right">Total </td>
  <td align="right"><?php echo number_format($subTotal + $shopConfig['shippingCost'], 2); ?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>  
 <tr class="content"> 
  <td colspan="5" align="right">&nbsp;</td>
  <td width="75" align="center">
<input name="btnUpdate" type="submit" id="btnUpdate" value="Update Cart" class="box"></td>
 </tr>
</table>
</form>
<?php
} else {
	
?>
<p>&nbsp;</p><table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr>
  <td><p align="center">You shopping cart is empty</p>
   <p>If you find you are unable to add anything to your cart, please ensure that 
    your internet browser has cookies enabled and that any other security software 
    is not blocking your shopping session.</p></td>
 </tr>
</table>
<?php
}

$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
?>
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr align="center"> 
  <td><input name="btnContinue" type="button" id="btnContinue" value="&lt;&lt; Continue Shopping" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';" class="box"></td>
<?php 
if ($numItem > 0) {
?>  
  <td><input name="btnCheckout" type="button" id="btnCheckout" value="Proceed To Checkout &gt;&gt;" onClick="window.location.href='/shop?action=checkout&step=1';" class="box"></td>
<?php
}
?>  
 </tr>
</table>
  </div>
</div>
