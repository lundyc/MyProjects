<?php
if (level($_SESSION['uid']) < 2) {
system_error("Sorry, but you do not have access to this page. Please contact a admin if you think your right.", 0);
}

if (empty($_GET['name'])) {
// time to select a album
?>
<div class='tableborder'>
<div class='tableheaderalt'>Upload Photo</div>
<table width='100%' cellpadding='4' cellspacing='0'>

<?php
$columns = "3";
$rows = "0";
$i = 0;

$query = mysql_query("SELECT * FROM `gallery_categories` ORDER BY cid DESC");
while ($r = mysql_fetch_array($query)) {
($i % $columns) ? $row = FALSE : $row = TRUE;
if ($i && $row) {echo '</tr></tr>';}
$i++;
?>
<td align="center" style="padding: 5px;">
<img src="../uploads/gallery/thumbs/<?php echo $r['thumb']; ?>" style="border: 1px solid black"/>
<br />
<?php echo $r['title']; ?><br />


<form method="post" action="./?manager=gallery&action=upload&name=<?php echo $r['cid']; ?>">
  <input type="submit" value="Select"/>
</form>
<br />

</td>
<?php
}
?>
</table>
<?php
} else {
$query = mysql_query("SELECT * FROM `gallery_categories` WHERE cid = '".addslashes($_GET['name'])."' LIMIT 1");
$r = mysql_fetch_array($query);
$album = $r['title']; 
?>

<link href="css/default.css" rel="stylesheet" type="text/css" />
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="scripts/swfobject.js"></script>
<script type="text/javascript" src="scripts/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader'       : 'scripts/uploadify.swf',
		'script'         : 'scripts/uploadify.php',

		'cancelImg'      : 'cancel.png',
		'folder'         : 'uploads/gallery/tmp',
		'queueID'        : 'fileQueue',
		'auto'           : true,
		'multi'          : true,		
		
		'scriptData': {'CAT_ID': '<?php echo addslashes($_GET['name']); ?>'},
		'displayData': 'percentage',
      	'buttonText': 'Choose File(s)',
		
		'fileDesc' : 'jpeg files (*.jpg,*.jpeg); png files (*.png); gif files(*.gif)',
		'fileExt' : '*.jpg;*.jpeg;*.png;*.gif',
		
		'onComplete' : function(event, queueID, fileObj, response, data) {
			
			res = response.substr(0,5);
			
			if (res == "Error") {
				alert(response);
			} else {
				$('#filesUploaded').append('<div class="viewimg">'+response+'</div>');
				
		//	$('#filesUploaded').append('<div class="viewimg"><img src="../../uploads/thumbs/'+response+'"/></div>'); 
			}
			
		}
	});
});
</script>


<div class='tableborder'>
<div class='tableheaderalt'>Upload Photo</div>

<div style="text-align:center;">
<input type="file" name="uploadify" id="uploadify" />
</div>

<div id="fileQueue"></div>
<div id="filesUploaded"></div>
<?php
}
?>