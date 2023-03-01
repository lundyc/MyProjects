<div class="module"><div class="mb"><h2>Shop</h2>

<?php
$productsPerRow = 2;
$productsPerPage = 4;

function getChildCategories($categories, $id, $recursive = true)
{

global $mysqli;
	if ($categories == NULL) {
	    $sql = "SELECT cat_id, cat_parent_id, cat_name, cat_image, cat_description
	        FROM tbl_category
			ORDER BY cat_id, cat_parent_id ";
    $result = $mysqli->query($sql);
    
    $cat = array();
    while ($row = $result->fetch_assoc()) {
        $cat[] = $row;
    }
	
	
		$categories = $cat;
	}
	
	$n     = count($categories);
	$child = array();
	for ($i = 0; $i < $n; $i++) {
		$catId    = $categories[$i]['cat_id'];
		$parentId = $categories[$i]['cat_parent_id'];
		if ($parentId == $id) {
			$child[] = $catId;
			if ($recursive) {
				$child   = array_merge($child, getChildCategories($categories, $catId));
			}	
		}
	}
	
	return $child;
}

function getPagingQuery($sql, $itemPerPage = 10)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$mysqli->real_escape_string($_GET['page']);
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
}

function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
{

global $sql, $mysqli;

	$result        = $mysqli->query($sql);
	$pagingLink    = '';
	$totalResults  = $result->num_rows;
	$totalPages    = ceil($totalResults / $itemPerPage);
	
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		//$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		$self = "/shop&action=category&".$strGet;

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
				$prev = ' <a href="'.$self.'&page='.$page.'/">[Prev]</a> ';
			} else {
				$prev = ' <a href="'.$self.'">[Prev]</a> ';
			}	
				
			$first = ' <a href="'.$self.'">[First]</a> ';
		} else {
			$prev  = ''; // we're on page one, don't show 'previous' link
			$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = ' <a href="'.$self.'&page='.$page.'">[Next]</a> ';
			$last = ' <a href="'.$self.'&page='.$totalPages.'">[Last]</a> ';
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
				$pagingLink[] = ' '. $page .' ';   // no need to create a link to current page
			} else {
				if ($page == 1) {
					$pagingLink[] = ' <a href="'.$self.'">'.$page.'</a> ';
				} else {	
					$pagingLink[] = ' <a href="'.$self.'&page='.$page.'">'.$page.'</a> ';
				}	
			}
	
		}
		
		$pagingLink = implode(' | ', $pagingLink);
		
		// return the page navigation link
		$pagingLink = $first . $prev . $pagingLink . $next . $last;
	}
	
	return $pagingLink;
}

//$productList    = getProductList($catId);
$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$children = array_merge(array($catId), getChildCategories(NULL, $catId));
$children = ' (' . implode(', ', $children) . ')';

$sql = "SELECT pd_id, pd_name, pd_price, pd_thumbnail, pd_qty, c.cat_id
		FROM tbl_product pd, tbl_category c
		WHERE pd.cat_id = c.cat_id AND pd.cat_id IN $children 
		ORDER BY pd_name";
$result     = $mysqli->query(getPagingQuery($sql, $productsPerPage));
$pagingLink = getPagingLink($sql, $productsPerPage, 'c='.$catId);
$numProduct = $result->num_rows;

// the product images are arranged in a table. to make sure
// each image gets equal space set the cell width here
$columnWidth = (int)(100 / $productsPerRow);
?>
<table id="shop">
<?php 
if ($numProduct > 0 ) {

	$i = 0;
	while ($row = $result->fetch_assoc()) {
	
		extract($row);
		if ($pd_thumbnail) {
			$pd_thumbnail = 'images/product/' . $pd_thumbnail;
		} else {
			$pd_thumbnail = 'images/no-image-small.png';
		}
	
		if ($i % $productsPerRow == 0) {
			echo '<tr>';
		}

		// format how we display the price
		$pd_price = "&pound; " . number_format($pd_price, 2);
		
		echo '<td style="width: '. $columnWidth .'%; text-align: center;">';
		echo '<a href="/shop?action=detail&amp;c='. $catId.'&amp;p='. $pd_id .'">';
		echo '<img src="'.$pd_thumbnail.'" alt="'.$pd_name.'">';
		echo '<br>';
		echo $pd_name;
		echo '</a><br>Price : '. $pd_price;

		// if the product is no longer in stock, tell the customer
		if ($pd_qty <= 0) {
			echo "<br>Out Of Stock";
		}
		
		echo "</td>\r\n";
	
		if ($i % $productsPerRow == $productsPerRow - 1) {
			echo '</tr>';
		}
		
		$i += 1;
	}
	
	if ($i % $productsPerRow > 0) {
		echo '<td colspan="' . ($productsPerRow - ($i % $productsPerRow)) . '">&nbsp;</td>';
	}
	
} else {
?>
	<tr><td style="width: 100%; text-align: center; vertical-align: center;">No products in this category</td></tr>
<?php	
}	
?>
</table>
<p style="text-align: center"><?php echo $pagingLink; ?></p>

  </div>
</div>
