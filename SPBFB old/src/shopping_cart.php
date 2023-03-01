 <div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb">
      <h2>Shopping Cart</h2>
    <div class="featBanner">
<?php 
$cartContent = getCartContent();

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
		$url = "./?view=shop&c=$cat_id&p=$pd_id";

	$shippingCost += ($pd_shipping * $ct_qty);
		$subTotal += $pd_price * $ct_qty;
?>
 <tr>
   <td><a href="<?php echo $url; ?>"><?php echo $pd_name; ?></a></td>
   
  <td width="30%" align="right"><?php echo displayAmount($ct_qty * $pd_price); ?></td>
 </tr>
<?php
	} // end while
?>
  <tr><td align="right">Sub-total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal); ?></td>
 </tr>
  <tr><td align="right">Shipping</td>
  <td width="30%" align="right"><?php echo displayAmount($shippingCost); ?></td>
 </tr>
  <tr><td align="right">Total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal + $shippingCost); ?></td>
 </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
  <td colspan="2" align="center"><a href="./?view=cart&action=view"> Go To Shopping 
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

		
