 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Shopping Cart</h2>
    <div class="featBanner">
<?php 
function getCartContent2()
{
global $mysqli;
	$cartContent = array();

	$sid = session_id();
	
	$sql = "SELECT ct_id, ct.pd_id, ct_qty, pd_name, pd_price, pd_thumbnail, pd_shipping, pd.cat_id
			FROM tbl_cart ct, tbl_product pd, tbl_category cat
			WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND cat.cat_id = pd.cat_id";
	
	$resultc = $mysqli->query($sql);

	if ($resultc) {
    while ($row = $resultc->fetch_assoc()) {
		if ($row['pd_thumbnail']) {
			$row['pd_thumbnail'] = 'images/products/' . $row['pd_thumbnail'];
		} else {
			$row['pd_thumbnail'] = 'images/products/no-image-small.png';
		}
		$cartContent[] = $row;
	}
	}
	
	return $cartContent;
}


$cartContent = getCartContent2();

$numItem = count($cartContent);	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" id="minicart">
 <?php
if ($numItem > 0) {
	$subTotal = 0;
	$shippingCost = 0;
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
		$pd_name = "$ct_qty x $pd_name";
		$url = "/shop?action=detail&c=$cat_id&p=$pd_id";

	$shippingCost += ($pd_shipping * $ct_qty);
		$subTotal += $pd_price * $ct_qty;
?>
 <tr>
   <td><a href="<?php echo $url; ?>"><?php echo $pd_name; ?></a></td>
   
  <td width="30%" align="right"><?php echo number_format($ct_qty * $pd_price,2); ?></td>
 </tr>
<?php
	} // end while
?>
  <tr><td align="right">Sub-total</td>
  <td width="30%" align="right"><?php echo number_format($subTotal,2); ?></td>
 </tr>
  <tr><td align="right">Shipping</td>
  <td width="30%" align="right"><?php echo number_format($shippingCost,2); ?></td>
 </tr>
  <tr><td align="right">Total</td>
  <td width="30%" align="right"><?php echo number_format($subTotal + $shippingCost,2); ?></td>
 </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
  <td colspan="2" align="center"><a href="/shop&action=cart"> Go To Shopping 
   Cart</a></td>
 </tr>  
<?php	
} else {
?>
  <tr><td colspan="2" align="center" valign="middle">Empty</td></tr>
<?php
}
?> 
</table>


	</div>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>

		
