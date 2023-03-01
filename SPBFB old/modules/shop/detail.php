<div class="module">
  <div class="tb"><div><div></div></div></div>
  <div class="mb2">
      <h2 class="about">Shop</h2>

<?php
$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;

function getProductDetail($pdId, $catId)
{
	
	$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];
	
	// get the product information from database
	$sql = "SELECT pd_name, pd_description, pd_price, pd_image, pd_qty
			FROM tbl_product
			WHERE pd_id = $pdId";
	
	$result = mysql_query($sql);
	$row    = mysql_fetch_assoc($result);
	extract($row);
	
	$row['pd_description'] = nl2br($row['pd_description']);
	
	if ($row['pd_image']) {
		$row['pd_image'] = 'images/product/' . $row['pd_image'];
	} else {
		$row['pd_image'] = 'images/no-image-large.png';
	}
	
	list($width, $height, $type, $attr)= getimagesize($row['pd_image']);

if ($width > 300) {
$row['width'] = $width/2;
$row['height'] = $height/2;
}	
	
	$row['cart_url'] = "./?view=shop&action=cart&action2=add&p=$pdId";
	
	return $row;			
}

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
?> 
<table id="shop_detials">
<tr>
<td>
<strong><?php echo $pd_name; ?></strong>
<br>
<?php echo $pd_description; ?>
</td>
</tr>

<tr>
<td style="width: 500;">
  <img src="<?php echo $pd_image; ?>" alt="<?php echo $pd_name; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
</td>

<td style="vertical-align: top">
Price : <?php echo "&pound; " . number_format($pd_price,2); ?>
<br>


<?php
if ($pd_qty > 0) {
echo "In Stock: " . $pd_qty . "<br>";
?>
<input type="button" name="btnAddToCart" value="Add To Cart &gt;" onClick="window.location.href='<?php echo $cart_url; ?>';" class="addToCartButton">
<?php
} else {
	echo 'Out Of Stock';
}
?>
</td>
</tr>
</table>

  </div>
  <div class="bb"><div><div></div></div></div>
</div>
