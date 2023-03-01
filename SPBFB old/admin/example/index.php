<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Uploadify Example Script</title>
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
		'folder'         : 'uploads/tmp',
		'queueID'        : 'fileQueue',
		'auto'           : true,
		'multi'          : true,		
		'fileDesc' : 'jpeg files (*.jpg,*.jpeg); png files (*.png); gif files(*.gif)',
		'fileExt' : '*.jpg;*.jpeg;*.png;*.gif',
		
		'onComplete' : function(event, queueID, fileObj, response, data) {
			
			res = response.substr(0,5);
			
			if (res == "error") {
				alert(response);
			} else {
			$('#filesUploaded').append('<div class="viewimg"><img src="uploads/thumbs/'+response+'"/></div>'); 
			}
			
		}
	});
});
</script>
</head>

<body>

<input type="file" name="uploadify" id="uploadify" />
<div id="fileQueue"></div>

<div id="filesUploaded">
<?php
$dirname = "uploads/";
$images = scandir($dirname);
$ignore = Array(".", "..", "thumbs", "tmp");

foreach($images as $curimg){
if(!in_array($curimg, $ignore)) {
?>	
<div class="viewimg"><img src='uploads/thumbs/<?php echo $curimg; ?>' /></div>
<?php
}

}     
?>
</div>

</body>
</html>
