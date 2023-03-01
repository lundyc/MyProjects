<?php
if (isset($_GET['catId']) && (int)$_GET['catId'] >= 0) {
	$catId = (int)$_GET['catId'];
	$queryString = "&catId=$catId";
} else {
	$catId = 0;
	$queryString = '';
}
	
// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = 'SELECT cat_id, cat_parent_id, cat_name, cat_description, cat_image
        FROM tbl_category
		WHERE cat_parent_id = '.$catId.'
		ORDER BY cat_name';
$result     = mysql_query(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
?>
<div class='help-box' style="display:" id="fo_content_mem_">
 <img src='images/tabs_main/icon_help.png' alt='help' />
  <h2>
  	<div>Manage Site Shop Categories/div>
  </h2>
 <p>
 	<br />
insert description here
 	<br />
 	&nbsp; </p>
</div>
<br >


<div class='tableheaderalt'>Category List</div>
<form action="processCategory.php?action=addCategory" method="post"  name="frmListCategory" id="frmListCategory">



<table cellpadding='4' cellspacing='0' width='100%'>
  <tr> 
   <td width="60" class='tablesubheader' align="center">Image</td> 
   <td class='tablesubheader'>Name</td>
   <td class='tablesubheader'>Description</td>
   <td width="150" class='tablesubheader'>Modify</td>
   <td width="70" class='tablesubheader'>Delete</td>
  </tr>
  <?php
$cat_parent_id = 0;
if (mysql_num_rows($result) > 0) {
	$i = 0;
	
	while($row = mysql_fetch_assoc($result)) {
		extract($row);
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
		
		if ($cat_parent_id == 0) {
			$cat_name = '<a href="index.php?manager=shop&action=category&catId='. $cat_id.'">'. $cat_name .'</a>'; 
		}
		
		if ($cat_image) {
			$cat_image = '../images/category/' . $cat_image;
		} else {
			$cat_image = '../images/no-image-small.png';
		}		
?>
  <tr class="<?php echo $class; ?>"> 
   <td width="75" align="center"><img src="<?php echo $cat_image; ?>" width="35" height="35"></td>
  <td><?php echo $cat_name; ?></td>
   <td><?php echo nl2br($cat_description); ?></td>
   <td width="75" align="center"><a href="javascript:modifyCategory(<?php echo $cat_id; ?>);">Modify</a></td>
   <td width="75" align="center"><a href="javascript:deleteCategory(<?php echo $cat_id; ?>);">Delete</a></td>
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
   <td colspan="5" align="center">No Categories Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"> <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" class="box" onClick="addCategory(<?php echo $catId; ?>)"> 
   </td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>