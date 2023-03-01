<div class="module"><div class="mb"><h2>Shop</h2>

<?php
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$thisFile = str_replace('\\', '/', __FILE__);
$webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
$srvRoot  = str_replace('library/config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);
$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $mysqli->real_escape_string($_GET['c']) : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $mysqli->real_escape_string($_GET['p']) : 0;

	$sql = "SELECT cat_id, cat_name, cat_image
	        FROM tbl_category
			WHERE cat_parent_id = 0
			ORDER BY cat_name";
$result = $mysqli->query($sql) or die($mysqli->error.__LINE__);
    
    $cat = array();
    while ($row = $result->fetch_assoc()) {
		extract($row);
		
		if ($cat_image) {
			$cat_image = 'images/category/' . $cat_image;
		} else {
			$cat_image = 'images/no-image-small.png';
		}
		
		$cat[] = array('url'   => '/shop?action=category&amp;c=' . $cat_id,
		               'image' => $cat_image,
					   'name'  => $cat_name);

    }
	

$categoryList    = $cat;
$categoriesPerRow = 4;
$numCategory     = count($categoryList);
$columnWidth    = (int)(100 / $categoriesPerRow);
?>
<table id="shop">
<?php 
if ($numCategory > 0) {
	$i = 0;
	for ($i; $i < $numCategory; $i++) {
		if ($i % $categoriesPerRow == 0) {
			echo '<tr>';
		}
		
		// we have $url, $image, $name, $price
		extract ($categoryList[$i]);
		
		echo '<td style="width: '. $columnWidth .'%; text-align: center">';
		echo '<a href="'. $url .'">';
		echo '<img src="'. $image .'" alt="' . $name . '">';
		echo '<br>';
		echo $name;
		echo '</a>';
		echo '</td>'. "\r\n";
	
	
		if ($i % $categoriesPerRow == $categoriesPerRow - 1) {
			echo '</tr>';
		}
		
	}
	
	if ($i % $categoriesPerRow > 0) {
		echo '<td colspan="' . ($categoriesPerRow - ($i % $categoriesPerRow)) . '">&nbsp;</td>';
	}
} else {
?>
	<tr><td width="100%" align="center" valign="center">No categories yet</td></tr>
<?php	
}	
?>
</table>

</div></div>

